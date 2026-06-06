<?php

namespace App\Http\Controllers;

use App\Models\AccountingLedger;
use App\Models\AccountingVoucher;
use App\Models\AccountingJournalEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class AccountingController extends Controller
{
    /**
     * Get or create a default system ledger
     */
    public static function getSystemLedger($name, $type, $code = null)
    {
        $instituteId = Auth::user() ? Auth::user()->institute_id : 1;
        
        return AccountingLedger::firstOrCreate(
            [
                'institute_id' => $instituteId,
                'name' => $name,
            ],
            [
                'type' => $type,
                'code' => $code,
                'is_system' => true,
            ]
        );
    }

    public function dashboard()
    {
        // Seed default system ledgers if they don't exist
        $cashLedger = self::getSystemLedger('Cash-in-Hand', 'asset', '1001');
        $bankLedger = self::getSystemLedger('Bank Account', 'asset', '1002');
        $receivableLedger = self::getSystemLedger('Tuition Fee Receivable', 'asset', '1003');
        $feeRevenueLedger = self::getSystemLedger('Tuition Fee Revenue', 'revenue', '3001');
        $gstPayableLedger = self::getSystemLedger('GST Collected (Liability)', 'liability', '2001');
        $gstInputLedger = self::getSystemLedger('GST Input tax (Asset)', 'asset', '1004');

        // Balances calculation based on Debits and Credits
        $cashBalance = $this->getLedgerBalance($cashLedger->id);
        $bankBalance = $this->getLedgerBalance($bankLedger->id);
        $gstCollected = $this->getLedgerBalance($gstPayableLedger->id);
        $gstPaid = $this->getLedgerBalance($gstInputLedger->id);
        $totalReceivable = $this->getLedgerBalance($receivableLedger->id);

        $totalRevenue = AccountingJournalEntry::whereHas('ledger', function ($q) {
            $q->where('type', 'revenue');
        })->sum('amount');

        $totalExpenses = AccountingJournalEntry::whereHas('ledger', function ($q) {
            $q->where('type', 'expense');
        })->sum('amount');

        $recentVouchers = AccountingVoucher::with('journalEntries.ledger')
            ->latest()
            ->limit(10)
            ->get();

        return view('accounting.dashboard', compact(
            'cashBalance',
            'bankBalance',
            'gstCollected',
            'gstPaid',
            'totalReceivable',
            'totalRevenue',
            'totalExpenses',
            'recentVouchers'
        ));
    }

    private function getLedgerBalance($ledgerId)
    {
        $debits = AccountingJournalEntry::where('accounting_ledger_id', $ledgerId)
            ->where('entry_type', 'debit')
            ->sum('amount');

        $credits = AccountingJournalEntry::where('accounting_ledger_id', $ledgerId)
            ->where('entry_type', 'credit')
            ->sum('amount');

        return $debits - $credits;
    }

    public function ledgers(Request $request)
    {
        $query = AccountingLedger::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $ledgers = $query->orderBy('name')->paginate(20);

        return view('accounting.ledgers', compact('ledgers'));
    }

    public function storeLedger(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:asset,liability,equity,revenue,expense',
            'code' => 'nullable|string|max:50',
        ]);

        // Verify if ledger already exists
        $exists = AccountingLedger::where('name', $request->name)->first();
        if ($exists) {
            return back()->withErrors(['name' => 'A ledger with this name already exists.']);
        }

        AccountingLedger::create([
            'institute_id' => Auth::user()->institute_id,
            'name' => $request->name,
            'type' => $request->type,
            'code' => $request->code,
            'is_system' => false,
        ]);

        return redirect()->route('accounting.ledgers.index')->with('success', 'Accounting ledger account created successfully.');
    }

    public function gstReports(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::today()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::today()->format('Y-m-d'));

        // GST Collected from Student Fees (Assumed 18% slab on payments logged)
        $gstPayableLedger = self::getSystemLedger('GST Collected (Liability)', 'liability', '2001');
        $collectedEntries = AccountingJournalEntry::where('accounting_ledger_id', $gstPayableLedger->id)
            ->whereHas('voucher', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('date', [$startDate, $endDate]);
            })->with('voucher')->get();

        // GST Paid on Corporate Expenses
        $gstInputLedger = self::getSystemLedger('GST Input tax (Asset)', 'asset', '1004');
        $paidEntries = AccountingJournalEntry::where('accounting_ledger_id', $gstInputLedger->id)
            ->whereHas('voucher', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('date', [$startDate, $endDate]);
            })->with('voucher')->get();

        $totalCollected = $collectedEntries->sum('amount');
        $totalPaid = $paidEntries->sum('amount');
        $netPayable = $totalCollected - $totalPaid;

        return view('accounting.gst-reports', compact(
            'collectedEntries',
            'paidEntries',
            'totalCollected',
            'totalPaid',
            'netPayable',
            'startDate',
            'endDate'
        ));
    }

    public function tallyExport(Request $request)
    {
        $startDate = $request->get('start_date', Carbon::today()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->get('end_date', Carbon::today()->format('Y-m-d'));

        $vouchers = AccountingVoucher::with('journalEntries.ledger')
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $companyName = Auth::user()->institute->name ?? 'EduNex ERP Institute';

        // Build Tally compliant XML
        $xml = '<?xml version="1.0"?>' . "\n";
        $xml .= '<ENVELOPE>' . "\n";
        $xml .= '  <HEADER>' . "\n";
        $xml .= '    <TALLYREQUEST>Import Data</TALLYREQUEST>' . "\n";
        $xml .= '  </HEADER>' . "\n";
        $xml .= '  <BODY>' . "\n";
        $xml .= '    <IMPORTDATA>' . "\n";
        $xml .= '      <REQUESTDESC>' . "\n";
        $xml .= '        <REPORTNAME>Vouchers</REPORTNAME>' . "\n";
        $xml .= '        <STATICVARIABLES>' . "\n";
        $xml .= '          <SVCURRENTCOMPANY>' . htmlspecialchars($companyName) . '</SVCURRENTCOMPANY>' . "\n";
        $xml .= '        </STATICVARIABLES>' . "\n";
        $xml .= '      </REQUESTDESC>' . "\n";
        $xml .= '      <REQUESTDATA>' . "\n";

        foreach ($vouchers as $vch) {
            $tallyDate = Carbon::parse($vch->date)->format('Ymd');
            $vchType = $vch->type === 'receipt' ? 'Receipt' : ($vch->type === 'payment' ? 'Payment' : 'Journal');
            
            $xml .= '        <TALLYMESSAGE xmlns:UDF="TallyUDF">' . "\n";
            $xml .= '          <VOUCHER VCHTYPE="' . $vchType . '" ACTION="Create">' . "\n";
            $xml .= '            <DATE>' . $tallyDate . '</DATE>' . "\n";
            $xml .= '            <VOUCHERNUMBER>' . htmlspecialchars($vch->voucher_number) . '</VOUCHERNUMBER>' . "\n";
            
            // Set Narration
            if ($vch->narration) {
                $xml .= '            <NARRATION>' . htmlspecialchars($vch->narration) . '</NARRATION>' . "\n";
            }
            
            // List ledger splits
            foreach ($vch->journalEntries as $entry) {
                $xml .= '            <ALLLEDGERENTRIES.LIST>' . "\n";
                $xml .= '              <LEDGERNAME>' . htmlspecialchars($entry->ledger->name) . '</LEDGERNAME>' . "\n";
                
                // Tally amounts: debit is negative, credit is positive
                $isDebit = $entry->entry_type === 'debit';
                $xml .= '              <ISDEEMEDPOSITIVE>' . ($isDebit ? 'Yes' : 'No') . '</ISDEEMEDPOSITIVE>' . "\n";
                $tallyAmt = $isDebit ? ($entry->amount * -1) : $entry->amount;
                $xml .= '              <AMOUNT>' . number_format($tallyAmt, 2, '.', '') . '</AMOUNT>' . "\n";
                
                $xml .= '            </ALLLEDGERENTRIES.LIST>' . "\n";
            }

            $xml .= '          </VOUCHER>' . "\n";
            $xml .= '        </TALLYMESSAGE>' . "\n";
        }

        $xml .= '      </REQUESTDATA>' . "\n";
        $xml .= '    </IMPORTDATA>' . "\n";
        $xml .= '  </BODY>' . "\n";
        $xml .= '</ENVELOPE>' . "\n";

        $filename = "TallySync_" . $startDate . "_to_" . $endDate . ".xml";

        return Response::make($xml, 200, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }
}
