<?php

namespace App\Services\Library;

use App\Models\Library\Book;
use App\Models\Library\Reservation;
use App\Models\Library\Setting;
use App\Models\Student;
use App\Models\User;
use App\Notifications\Library\ReservationAvailableNotification;
use Carbon\Carbon;

class ReservationService
{
    /**
     * Create a book reservation for a member.
     *
     * @throws \Exception
     */
    public function reserve($memberId, $memberType, $bookId): Reservation
    {
        $book = Book::findOrFail($bookId);

        // 1. Check book exists and is active
        if (!$book->status) {
            throw new \Exception('This book is currently inactive and cannot be reserved.');
        }

        // 2. Resolve member type class
        $memberTypeClass = $memberType === 'student' ? Student::class : User::class;

        // 3. Check for duplicate pending reservation
        $existingReservation = Reservation::where('book_id', $bookId)
            ->where('member_id', $memberId)
            ->where('member_type', $memberTypeClass)
            ->where('status', 'pending')
            ->exists();

        if ($existingReservation) {
            throw new \Exception('A pending reservation already exists for this book.');
        }

        // 4. Get reservation expiry days from settings
        $settings = Setting::forInstitute();
        $expiryDays = $settings ? $settings->reservation_expiry_days : 3;

        // 5. Create the reservation
        $reservation = Reservation::create([
            'book_id'          => $bookId,
            'member_id'        => $memberId,
            'member_type'      => $memberTypeClass,
            'reservation_date' => Carbon::today(),
            'expiry_date'      => Carbon::today()->addDays($expiryDays),
            'status'           => 'pending',
        ]);

        AuditService::log('reservation_created', $reservation, null, $reservation->toArray());

        return $reservation;
    }

    /**
     * Cancel a reservation.
     */
    public function cancel(Reservation $reservation): Reservation
    {
        $oldValues = $reservation->toArray();

        $reservation->update(['status' => 'cancelled']);

        AuditService::log('reservation_cancelled', $reservation, $oldValues, $reservation->fresh()->toArray());

        return $reservation;
    }

    /**
     * Expire all pending reservations past their expiry date.
     *
     * @return int Number of reservations expired
     */
    public function expireReservations(): int
    {
        return Reservation::where('status', 'pending')
            ->where('expiry_date', '<', Carbon::today())
            ->update(['status' => 'expired']);
    }

    /**
     * Fulfill a reservation (mark as fulfilled when book is issued).
     */
    public function fulfillReservation(Reservation $reservation): Reservation
    {
        $oldValues = $reservation->toArray();

        $reservation->update(['status' => 'fulfilled']);

        AuditService::log('reservation_fulfilled', $reservation, $oldValues, $reservation->fresh()->toArray());

        return $reservation;
    }

    /**
     * Check for pending reservations on a book and notify the first waiting member.
     */
    public function checkAndNotifyAvailable(Book $book): void
    {
        $reservation = Reservation::where('book_id', $book->id)
            ->where('status', 'pending')
            ->orderBy('reservation_date')
            ->orderBy('id')
            ->first();

        if (!$reservation) {
            return;
        }

        // Fulfill the reservation
        $this->fulfillReservation($reservation);

        // Notify the member
        try {
            $member = $reservation->member;
            if ($member) {
                $member->notify(new ReservationAvailableNotification($reservation));
            }
        } catch (\Throwable $e) {
            // Notification failure should not block reservation fulfillment
        }
    }
}
