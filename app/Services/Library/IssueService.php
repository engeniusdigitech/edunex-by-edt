<?php

namespace App\Services\Library;

use App\Models\Library\Book;
use App\Models\Library\BookIssue;
use App\Models\Library\Setting;
use App\Models\Student;
use App\Models\User;
use App\Notifications\Library\BookIssuedNotification;

class IssueService
{
    protected FineService $fineService;
    protected ReservationService $reservationService;

    public function __construct(FineService $fineService, ReservationService $reservationService)
    {
        $this->fineService = $fineService;
        $this->reservationService = $reservationService;
    }

    /**
     * Issue a book to a member.
     *
     * @throws \Exception
     */
    public function issueBook(array $data): BookIssue
    {
        $book = Book::findOrFail($data['book_id']);

        // 1. Check available copies
        if ($book->available_copies <= 0) {
            throw new \Exception('No copies of this book are currently available.');
        }

        // 2. Resolve member
        $member = $this->resolveMember($data['member_id'], $data['member_type']);
        $memberTypeClass = $data['member_type'] === 'student'
            ? Student::class
            : User::class;

        // 3. Check member borrowing limit
        [$allowed, $current, $max] = $this->checkMemberLimit($data['member_id'], $memberTypeClass);
        if (!$allowed) {
            throw new \Exception("Borrowing limit reached. Currently issued: {$current}/{$max}.");
        }

        // 4. Check duplicate issue (same member + same book, still issued)
        if ($this->checkDuplicateIssue($data['member_id'], $memberTypeClass, $book->id)) {
            throw new \Exception('This member already has an active issue for this book.');
        }

        // 5. Create the BookIssue record
        $issue = BookIssue::create([
            'book_id'     => $book->id,
            'member_id'   => $data['member_id'],
            'member_type' => $memberTypeClass,
            'issue_date'  => $data['issue_date'],
            'due_date'    => $data['due_date'],
            'status'      => 'issued',
            'remarks'     => $data['remarks'] ?? null,
            'issued_by'   => auth()->id(),
        ]);

        // 6. Decrement available copies
        $book->decrement('available_copies');

        // 7. Send notification to the member
        try {
            $member->notify(new BookIssuedNotification($issue));
        } catch (\Throwable $e) {
            // Notification failure should not block the issue
        }

        // 8. Log audit
        AuditService::log('book_issued', $issue, null, $issue->toArray());

        // 9. Return the issue
        return $issue;
    }

    /**
     * Return an issued book.
     */
    public function returnBook(BookIssue $issue, array $data): BookIssue
    {
        $oldValues = $issue->toArray();

        // 1. Update issue record
        $issue->update([
            'return_date' => $data['return_date'],
            'status'      => 'returned',
            'returned_by' => auth()->id(),
            'remarks'     => $data['remarks'] ?? $issue->remarks,
        ]);

        // 2. Increment available copies on the book
        $issue->book->increment('available_copies');

        // 3. Calculate and create fine if overdue
        $fineAmount = $this->fineService->calculateFine($issue);
        if ($fineAmount > 0) {
            $this->fineService->createFine(
                $issue,
                $fineAmount,
                'Overdue return – ' . $issue->days_overdue . ' day(s) late'
            );
        }

        // 4. Check and fulfill pending reservations for this book
        $this->reservationService->checkAndNotifyAvailable($issue->book);

        // 5. Log audit
        AuditService::log('book_returned', $issue, $oldValues, $issue->fresh()->toArray());

        return $issue;
    }

    /**
     * Check if a member has reached their borrowing limit.
     *
     * @return array [bool $allowed, int $current, int $max]
     */
    public function checkMemberLimit($memberId, $memberType): array
    {
        $settings = Setting::forInstitute();

        $isStudent = $memberType === Student::class;
        $max = $isStudent
            ? ($settings->max_books_student ?? 3)
            : ($settings->max_books_staff ?? 5);

        $current = BookIssue::where('member_id', $memberId)
            ->where('member_type', $memberType)
            ->where('status', 'issued')
            ->count();

        return [$current < $max, $current, $max];
    }

    /**
     * Check if a member already has an active issue for the given book.
     */
    public function checkDuplicateIssue($memberId, $memberType, $bookId): bool
    {
        return BookIssue::where('member_id', $memberId)
            ->where('member_type', $memberType)
            ->where('book_id', $bookId)
            ->where('status', 'issued')
            ->exists();
    }

    /**
     * Resolve member model from ID and type.
     *
     * @throws \Exception
     */
    protected function resolveMember($memberId, $memberType)
    {
        if ($memberType === 'student') {
            $member = Student::find($memberId);
        } else {
            $member = User::find($memberId);
        }

        if (!$member) {
            throw new \Exception('Member not found.');
        }

        return $member;
    }
}
