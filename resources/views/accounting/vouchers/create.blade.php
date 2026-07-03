@extends('layouts.admin')

@section('title', 'New Voucher Entry')

@section('content')
<!-- Sub Navigation Tabs -->
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.dashboard') }}">
                    <i class="fas fa-chart-line me-2"></i>Financial Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.ledgers.index') }}">
                    <i class="fas fa-list-ul me-2"></i>Chart of Accounts
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('accounting.vouchers.index') }}">
                    <i class="fas fa-book me-2"></i>Voucher Book
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('expenses.index') }}">
                    <i class="fas fa-receipt me-2"></i>Expense Ledger
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('accounting.gst.reports') }}">
                    <i class="fas fa-file-invoice me-2"></i>GST Statements
                </a>
            </li>
        </ul>
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger rounded-4 border-danger-subtle shadow-sm mb-4">
        <i class="fas fa-exclamation-circle me-2"></i>{{ $errors->first() }}
    </div>
@endif

<div class="card border-0 shadow-sm" style="border-radius: 16px;">
    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
        <h6 class="fw-medium text-dark mb-0"><i class="fas fa-file-invoice-dollar me-2 text-primary"></i>Post a New Voucher</h6>
        <p class="text-muted small mb-0">Double-entry bookkeeping: total debits must equal total credits.</p>
    </div>
    <div class="card-body px-4 pb-4">
        <form action="{{ route('accounting.vouchers.store') }}" method="POST" id="voucher-form">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-4">
                    <label class="form-label text-muted small fw-semibold">Voucher Type</label>
                    <select name="type" class="form-select" required>
                        <option value="">-- Select Type --</option>
                        <option value="receipt" {{ old('type') === 'receipt' ? 'selected' : '' }}>Receipt (Money In)</option>
                        <option value="payment" {{ old('type') === 'payment' ? 'selected' : '' }}>Payment (Money Out)</option>
                        <option value="journal" {{ old('type') === 'journal' ? 'selected' : '' }}>Journal (Adjustment)</option>
                    </select>
                </div>
                <div class="col-12 col-sm-4">
                    <label class="form-label text-muted small fw-semibold">Date</label>
                    <input type="date" name="date" class="form-control" value="{{ old('date', \Carbon\Carbon::today()->format('Y-m-d')) }}" required>
                </div>
                <div class="col-12 col-sm-4">
                    <label class="form-label text-muted small fw-semibold">Narration</label>
                    <input type="text" name="narration" class="form-control" placeholder="e.g. Cash deposited to bank" value="{{ old('narration') }}">
                </div>
            </div>

            <h6 class="fw-medium text-dark text-sm mb-2">Ledger Splits</h6>
            <div class="table-responsive mb-2">
                <table class="table align-middle mb-0" id="lines-table">
                    <thead class="table-light">
                        <tr style="font-size:.78rem;color:#475569;">
                            <th>Ledger Account</th>
                            <th class="text-end" style="width:160px;">Debit</th>
                            <th class="text-end" style="width:160px;">Credit</th>
                            <th style="width:50px;"></th>
                        </tr>
                    </thead>
                    <tbody id="lines-body">
                        @for($i = 0; $i < 2; $i++)
                            <tr class="line-row">
                                <td>
                                    <select name="lines[{{ $i }}][ledger_id]" class="form-select form-select-sm" required>
                                        <option value="">-- Select Ledger --</option>
                                        @foreach($ledgers as $ledger)
                                            <option value="{{ $ledger->id }}">{{ $ledger->name }} ({{ ucfirst($ledger->type) }})</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" step="0.01" min="0" name="lines[{{ $i }}][debit]" class="form-control form-control-sm text-end debit-input">
                                </td>
                                <td>
                                    <input type="number" step="0.01" min="0" name="lines[{{ $i }}][credit]" class="form-control form-control-sm text-end credit-input">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-line-btn" title="Remove line"><i class="fas fa-times"></i></button>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td class="text-muted small">Totals</td>
                            <td class="text-end fw-medium" id="total-debit">0.00</td>
                            <td class="text-end fw-medium" id="total-credit">0.00</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3" id="add-line-btn">
                    <i class="fas fa-plus me-1"></i>Add Line
                </button>
                <span class="badge rounded-pill px-3 py-2" id="balance-badge">Not Balanced</span>
            </div>

            <button type="submit" class="btn btn-primary rounded-pill px-4 py-2.5">
                <i class="fas fa-save me-2"></i>Post Voucher
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const linesBody = document.getElementById('lines-body');
    const addLineBtn = document.getElementById('add-line-btn');
    const totalDebitEl = document.getElementById('total-debit');
    const totalCreditEl = document.getElementById('total-credit');
    const balanceBadge = document.getElementById('balance-badge');
    let lineIndex = linesBody.querySelectorAll('.line-row').length;

    const ledgerOptionsHtml = document.querySelector('.line-row select').innerHTML;

    function recalcTotals() {
        let debitSum = 0;
        let creditSum = 0;
        linesBody.querySelectorAll('.debit-input').forEach(el => debitSum += parseFloat(el.value) || 0);
        linesBody.querySelectorAll('.credit-input').forEach(el => creditSum += parseFloat(el.value) || 0);

        totalDebitEl.textContent = debitSum.toFixed(2);
        totalCreditEl.textContent = creditSum.toFixed(2);

        const balanced = debitSum > 0 && Math.abs(debitSum - creditSum) < 0.005;
        balanceBadge.textContent = balanced ? 'Balanced' : 'Not Balanced';
        balanceBadge.className = 'badge rounded-pill px-3 py-2 ' + (balanced ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger');
    }

    function bindRow(row) {
        row.querySelectorAll('.debit-input, .credit-input').forEach(el => {
            el.addEventListener('input', recalcTotals);
        });
        const removeBtn = row.querySelector('.remove-line-btn');
        removeBtn.addEventListener('click', function() {
            if (linesBody.querySelectorAll('.line-row').length <= 2) {
                alert('A voucher requires at least 2 ledger lines.');
                return;
            }
            row.remove();
            recalcTotals();
        });
    }

    linesBody.querySelectorAll('.line-row').forEach(bindRow);

    addLineBtn.addEventListener('click', function() {
        const row = document.createElement('tr');
        row.className = 'line-row';
        row.innerHTML = `
            <td>
                <select name="lines[${lineIndex}][ledger_id]" class="form-select form-select-sm" required>${ledgerOptionsHtml}</select>
            </td>
            <td><input type="number" step="0.01" min="0" name="lines[${lineIndex}][debit]" class="form-control form-control-sm text-end debit-input"></td>
            <td><input type="number" step="0.01" min="0" name="lines[${lineIndex}][credit]" class="form-control form-control-sm text-end credit-input"></td>
            <td class="text-center"><button type="button" class="btn btn-sm btn-outline-danger remove-line-btn" title="Remove line"><i class="fas fa-times"></i></button></td>
        `;
        linesBody.appendChild(row);
        bindRow(row);
        lineIndex++;
    });

    recalcTotals();
});
</script>
@endsection
