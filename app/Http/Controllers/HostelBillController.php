<?php

namespace App\Http\Controllers;

use App\Models\HostelBill;
use Illuminate\Http\Request;

class HostelBillController extends Controller
{
    public function index(Request $request)
    {
        $query = HostelBill::with('student');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bills = $query->latest('billing_month')->paginate(15);
        return view('hostel-bills.index', compact('bills'));
    }

    public function update(Request $request, HostelBill $hostelBill)
    {
        // Simple mock collection: mark as paid
        $hostelBill->update([
            'paid_amount' => $hostelBill->amount,
            'due_amount'  => 0,
            'status'      => 'paid',
        ]);

        return redirect()->route('hostel-bills.index')->with('success', 'Bill marked as paid successfully.');
    }
}
