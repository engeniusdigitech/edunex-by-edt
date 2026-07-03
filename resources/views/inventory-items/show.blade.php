@extends('layouts.admin')
@section('title', 'Item Details & Stock Logs')
@section('content')
<style>
.f-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.f-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.detail-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;margin-bottom:24px;}
.log-card{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.badge-in{background:#ECFDF5;color:#059669;border:1px solid #A7F3D0;}
.badge-out{background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;}
</style>

<div class="f-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">{{ $inventoryItem->name }}</h2>
    </div>
    <div style="position:relative;z-index:2;display:flex;gap:12px;">
        <a href="{{ route('inventory-items.edit', $inventoryItem) }}" class="btn btn-primary rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-edit me-2"></i> Adjust / Edit</a>
        <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-arrow-left me-2"></i> Back to Inventory</a>
    </div>
</div>

<div class="row">
    <!-- Item info panel -->
    <div class="col-lg-4">
        <div class="detail-card">
            <div class="p-4 border-bottom" style="background:#F8FAFC;border-color:#F1F5F9!important;">
                <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Stock Specifications</h5>
            </div>
            <div class="p-4">
                <div class="mb-4">
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">SKU / Item Code</span>
                    <span class="font-monospace text-dark fw-medium" style="font-size:.9rem;">{{ $inventoryItem->sku ?: '— No SKU assigned —' }}</span>
                </div>
                
                <div class="mb-4">
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">Inventory Category</span>
                    <span class="text-dark fw-medium" style="font-size:.9rem;">{{ $inventoryItem->category->name }}</span>
                </div>

                <div class="mb-4">
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">Unit of Measure</span>
                    <span class="text-dark" style="font-size:.9rem;">{{ $inventoryItem->unit }}</span>
                </div>

                <div class="mb-4">
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">Unit Price / Value</span>
                    <span class="text-dark fw-medium" style="font-size:.9rem;">{{ currencySymbol() }}{{ number_format($inventoryItem->unit_price, 2) }}</span>
                </div>

                <div class="mb-4">
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">Current Quantity Available</span>
                    @if($inventoryItem->available_qty <= $inventoryItem->min_qty_warning)
                        <span class="badge bg-danger text-white rounded-pill px-3 py-1.5 mt-1" style="font-size:.78rem;">{{ $inventoryItem->available_qty }} {{ $inventoryItem->unit }} (Low stock!)</span>
                    @else
                        <span class="badge bg-success text-white rounded-pill px-3 py-1.5 mt-1" style="font-size:.78rem;">{{ $inventoryItem->available_qty }} {{ $inventoryItem->unit }}</span>
                    @endif
                </div>

                <div>
                    <span class="text-muted small d-block uppercase fw-medium" style="font-size:.7rem;">Min Alert Threshold</span>
                    <span class="text-muted" style="font-size:.85rem;">{{ $inventoryItem->min_qty_warning }} {{ $inventoryItem->unit }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock logs list -->
    <div class="col-lg-8">
        <div class="log-card">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center" style="background:#F8FAFC;border-color:#F1F5F9!important;">
                <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Stock Flow &amp; Transaction Logs</h5>
                <span class="badge bg-secondary-subtle text-secondary rounded-pill" style="font-size:.7rem;padding:4px 10px;">{{ $inventoryItem->stockLogs->count() }} Entries</span>
            </div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr style="font-size:.78rem;color:#475569;">
                            <th class="ps-4">Date &amp; Time</th>
                            <th>Action Type</th>
                            <th class="text-center">Quantity</th>
                            <th>Log Reference / Reason</th>
                            <th class="pe-4 text-end">User</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inventoryItem->stockLogs as $log)
                            <tr>
                                <td class="ps-4" style="font-size:.82rem;color:#475569;">
                                    {{ $log->created_at->format('M d, Y H:i A') }}
                                </td>
                                <td>
                                    @if($log->type === 'stock_in')
                                        <span class="badge badge-in rounded-pill px-2.5 py-1" style="font-size:.68rem;"><i class="fas fa-plus-circle me-1"></i> Stock In</span>
                                    @else
                                        <span class="badge badge-out rounded-pill px-2.5 py-1" style="font-size:.68rem;"><i class="fas fa-minus-circle me-1"></i> Stock Out</span>
                                    @endif
                                </td>
                                <td class="text-center fw-medium text-dark" style="font-size:.85rem;">
                                    {{ $log->quantity }}
                                </td>
                                <td style="font-size:.82rem;color:#334155;max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    {{ $log->reference }}
                                </td>
                                <td class="pe-4 text-end text-muted small" style="font-size:.8rem;">
                                    {{ $log->user->name ?? 'System' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-history fs-3 mb-2" style="color:#CBD5E1;"></i>
                                    <div class="fw-medium">No Stock Logs Found</div>
                                    <div class="small">Stock level updates will appear here automatically.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
