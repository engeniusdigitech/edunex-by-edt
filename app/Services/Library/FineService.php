<?php

namespace App\Services\Library;

use App\Models\Library\BookIssue;
use App\Models\Library\Fine;
use App\Models\Library\Setting;
use App\Notifications\Library\FineGeneratedNotification;
use Carbon\Carbon;

class FineService
{
    /**
     * Calculate the fine amount for a book issue based on overdue days.
     */
    public function calculateFine(BookIssue $issue): float
    {
        $returnDate = $issue->return_date ?? Carbon::today();
        $dueDate = $issue->due_date;

        if ($returnDate->lte($dueDate)) {
            return 0.0;
        }

        $daysOverdue = (int) $returnDate->diffInDays($dueDate);
        $settings = Setting::forInstitute();
        $finePerDay = $settings ? (float) $settings->fine_per_day : 0.0;

        return $daysOverdue * $finePerDay;
    }

    /**
     * Create a fine record, log audit, and send notification to the member.
     */
    public function createFine(BookIssue $issue, float $amount, string $reason): Fine
    {
        $fine = Fine::create([
            'book_issue_id'  => $issue->id,
            'fine_amount'    => $amount,
            'fine_reason'    => $reason,
            'payment_status' => 'unpaid',
        ]);

        AuditService::log('fine_created', $fine, null, $fine->toArray());

        // Send notification to the member
        try {
            $member = $issue->member;
            if ($member) {
                $member->notify(new FineGeneratedNotification($fine));
            }
        } catch (\Throwable $e) {
            // Notification failure should not block fine creation
        }

        return $fine;
    }

    /**
     * Collect (pay) a fine.
     */
    public function collectFine(Fine $fine): Fine
    {
        $oldValues = $fine->toArray();

        $fine->update([
            'payment_status' => 'paid',
            'payment_date'   => Carbon::today(),
        ]);

        AuditService::log('fine_collected', $fine, $oldValues, $fine->fresh()->toArray());

        return $fine;
    }

    /**
     * Get all unpaid fines for a specific member (through book issues).
     */
    public function getUnpaidFines($memberId, $memberType)
    {
        return Fine::unpaid()
            ->whereHas('bookIssue', function ($query) use ($memberId, $memberType) {
                $query->where('member_id', $memberId)
                      ->where('member_type', $memberType);
            })
            ->with('bookIssue.book')
            ->latest()
            ->get();
    }

    /**
     * Auto-generate fines for all overdue issues that don't have existing fines.
     *
     * @return int Number of fines generated
     */
    public function autoGenerateFines(): int
    {
        $overdueIssues = BookIssue::overdue()
            ->whereDoesntHave('fines')
            ->with('book', 'member')
            ->get();

        $count = 0;
        foreach ($overdueIssues as $issue) {
            $amount = $this->calculateFine($issue);

            if ($amount > 0) {
                $this->createFine(
                    $issue,
                    $amount,
                    'Auto-generated – ' . $issue->days_overdue . ' day(s) overdue'
                );
                $count++;
            }
        }

        return $count;
    }
}
