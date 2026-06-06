<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\AccountingLedger;
use App\Models\AccountingVoucher;
use App\Models\AccountingJournalEntry;
use App\Models\InventorySupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::with(['ledger', 'supplier']);

        if ($request->filled('search')) {
            $query->where('reference_no', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('ledger_id')) {
            $query->where('accounting_ledger_id', $request->ledger_id);
        }

        $expenses = $query->latest('expense_date')->paginate(15);
        $expenseLedgers = AccountingLedger::where('type', 'expense')->get();

        return view('expenses.index', compact('expenses', 'expenseLedgers'));
    }

    public function create()
    {
        $expenseLedgers = AccountingLedger::where('type', 'expense')->get();
        $suppliers = InventorySupplier::all();
        
        return view('expenses.create', compact('expenseLedgers', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'accounting_ledger_id' => 'required|exists:accounting_ledgers,id',
            'supplier_id' => 'nullable|exists:inventory_suppliers,id',
            'expense_date' => 'required|date',
            'net_amount' => 'required|numeric|min:0',
            'gst_rate' => 'required|in:0,5,12,18,28',
            'gst_type' => 'required|in:cgst_sgst,igst,none',
            'payment_method' => 'required|in:Cash,Bank,Card',
            'reference_no' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $netAmt = $request->net_amount;
        $rate = $request->gst_rate;
        $gstAmt = 0.00;
        
        if ($rate > 0 && $request->gst_type !== 'none') {
            $gstAmt = ($netAmt * $rate) / 100;
        }
        
        $totalAmt = $netAmt + $gstAmt;

        DB::transaction(function () use ($request, $netAmt, $gstAmt, $totalAmt) {
            $expense = Expense::create([
                'institute_id' => Auth::user()->institute_id,
                'accounting_ledger_id' => $request->accounting_ledger_id,
                'supplier_id' => $request->supplier_id,
                'expense_date' => $request->expense_date,
                'net_amount' => $netAmt,
                'gst_rate' => $request->gst_rate,
                'gst_type' => $request->gst_type,
                'gst_amount' => $gstAmt,
                'total_amount' => $totalAmt,
                'payment_method' => $request->payment_method,
                'reference_no' => $request->reference_no,
                'description' => $request->description,
            ]);

            // Post journal vouchers
            $vchNo = 'EXP-' . Carbon::parse($request->expense_date)->format('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
            
            $voucher = AccountingVoucher::create([
                'institute_id' => Auth::user()->institute_id,
                'voucher_number' => $vchNo,
                'type' => 'payment',
                'date' => $request->expense_date,
                'narration' => $request->description ?: 'Payment logged for office expense.',
                'amount' => $totalAmt,
                'reference_id' => $expense->id,
                'reference_type' => Expense::class,
            ]);

            // Debits:
            // 1. Debit the expense category ledger
            AccountingJournalEntry::create([
                'accounting_voucher_id' => $voucher->id,
                'accounting_ledger_id' => $request->accounting_ledger_id,
                'entry_type' => 'debit',
                'amount' => $netAmt,
            ]);

            // 2. Debit the GST input tax ledger (if tax applies)
            if ($gstAmt > 0) {
                $gstInputLedger = AccountingController::getSystemLedger('GST Input tax (Asset)', 'asset', '1004');
                AccountingJournalEntry::create([
                    'accounting_voucher_id' => $voucher->id,
                    'accounting_ledger_id' => $gstInputLedger->id,
                    'entry_type' => 'debit',
                    'amount' => $gstAmt,
                ]);
            }

            // Credits:
            // 1. Credit Cash-in-Hand or Bank account
            $creditLedgerName = $request->payment_method === 'Cash' ? 'Cash-in-Hand' : 'Bank Account';
            $creditLedgerType = 'asset';
            $creditLedgerCode = $request->payment_method === 'Cash' ? '1001' : '1002';
            
            $paymentAssetLedger = AccountingController::getSystemLedger($creditLedgerName, $creditLedgerType, $creditLedgerCode);
            
            AccountingJournalEntry::create([
                'accounting_voucher_id' => $voucher->id,
                'accounting_ledger_id' => $paymentAssetLedger->id,
                'entry_type' => 'credit',
                'amount' => $totalAmt,
            ]);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense logged successfully and transaction posted to journal ledgers.');
    }

    public function edit(Expense $expense)
    {
        $expenseLedgers = AccountingLedger::where('type', 'expense')->get();
        $suppliers = InventorySupplier::all();
        
        return view('expenses.edit', compact('expense', 'expenseLedgers', 'suppliers'));
    }

    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'accounting_ledger_id' => 'required|exists:accounting_ledgers,id',
            'supplier_id' => 'nullable|exists:inventory_suppliers,id',
            'expense_date' => 'required|date',
            'net_amount' => 'required|numeric|min:0',
            'gst_rate' => 'required|in:0,5,12,18,28',
            'gst_type' => 'required|in:cgst_sgst,igst,none',
            'payment_method' => 'required|in:Cash,Bank,Card',
            'reference_no' => 'nullable|string|max:100',
            'description' => 'nullable|string|max:500',
        ]);

        $netAmt = $request->net_amount;
        $rate = $request->gst_rate;
        $gstAmt = 0.00;
        
        if ($rate > 0 && $request->gst_type !== 'none') {
            $gstAmt = ($netAmt * $rate) / 100;
        }
        
        $totalAmt = $netAmt + $gstAmt;

        DB::transaction(function () use ($request, $expense, $netAmt, $gstAmt, $totalAmt) {
            // Delete previous associated vouchers
            if ($expense->voucher) {
                $expense->voucher->delete();
            }

            $expense->update([
                'accounting_ledger_id' => $request->accounting_ledger_id,
                'supplier_id' => $request->supplier_id,
                'expense_date' => $request->expense_date,
                'net_amount' => $netAmt,
                'gst_rate' => $request->gst_rate,
                'gst_type' => $request->gst_type,
                'gst_amount' => $gstAmt,
                'total_amount' => $totalAmt,
                'payment_method' => $request->payment_method,
                'reference_no' => $request->reference_no,
                'description' => $request->description,
            ]);

            // Re-post voucher
            $vchNo = 'EXP-' . Carbon::parse($request->expense_date)->format('Ymd') . '-' . strtoupper(bin2hex(random_bytes(2)));
            
            $voucher = AccountingVoucher::create([
                'institute_id' => Auth::user()->institute_id,
                'voucher_number' => $vchNo,
                'type' => 'payment',
                'date' => $request->expense_date,
                'narration' => $request->description ?: 'Payment logged for office expense.',
                'amount' => $totalAmt,
                'reference_id' => $expense->id,
                'reference_type' => Expense::class,
            ]);

            // Debits:
            AccountingJournalEntry::create([
                'accounting_voucher_id' => $voucher->id,
                'accounting_ledger_id' => $request->accounting_ledger_id,
                'entry_type' => 'debit',
                'amount' => $netAmt,
            ]);

            if ($gstAmt > 0) {
                $gstInputLedger = AccountingController::getSystemLedger('GST Input tax (Asset)', 'asset', '1004');
                AccountingJournalEntry::create([
                    'accounting_voucher_id' => $voucher->id,
                    'accounting_ledger_id' => $gstInputLedger->id,
                    'entry_type' => 'debit',
                    'amount' => $gstAmt,
                ]);
            }

            // Credits:
            $creditLedgerName = $request->payment_method === 'Cash' ? 'Cash-in-Hand' : 'Bank Account';
            $creditLedgerType = 'asset';
            $creditLedgerCode = $request->payment_method === 'Cash' ? '1001' : '1002';
            
            $paymentAssetLedger = AccountingController::getSystemLedger($creditLedgerName, $creditLedgerType, $creditLedgerCode);
            
            AccountingJournalEntry::create([
                'accounting_voucher_id' => $voucher->id,
                'accounting_ledger_id' => $paymentAssetLedger->id,
                'entry_type' => 'credit',
                'amount' => $totalAmt,
            ]);
        });

        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully and transaction re-posted.');
    }

    public function destroy(Expense $expense)
    {
        DB::transaction(function () use ($expense) {
            if ($expense->voucher) {
                $expense->voucher->delete(); // cascade deletes splits
            }
            $expense->delete();
        });

        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully and ledger postings reverted.');
    }
}
