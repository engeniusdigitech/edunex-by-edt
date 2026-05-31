<?php

namespace App\Http\Controllers\Library;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\StoreReservationRequest;
use App\Models\Library\Reservation;
use App\Services\Library\ReservationService;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    protected ReservationService $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index(Request $request)
    {
        $query = Reservation::with(['book', 'member']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('from_date')) {
            $query->whereDate('reserved_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('reserved_at', '<=', $request->to_date);
        }

        $reservations = $query->latest()->paginate(15);

        return view('library.reservations.index', compact('reservations'));
    }

    public function store(StoreReservationRequest $request)
    {
        try {
            $this->reservationService->reserve($request->validated());
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->route('library.reservations.index')->with('success', 'Reservation created successfully.');
    }

    public function cancel(Reservation $reservation)
    {
        try {
            $this->reservationService->cancel($reservation);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('library.reservations.index')->with('success', 'Reservation cancelled successfully.');
    }

    public function fulfill(Reservation $reservation)
    {
        try {
            $this->reservationService->fulfillReservation($reservation);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('library.reservations.index')->with('success', 'Reservation fulfilled successfully.');
    }
}
