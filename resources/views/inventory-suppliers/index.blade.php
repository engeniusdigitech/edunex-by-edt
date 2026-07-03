@extends('layouts.admin')
@section('title', 'Suppliers & Vendors')
@section('content')
<style>
.s-hdr{background:linear-gradient(135deg,#0F172A,#1E293B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.s-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.card-sec{background:#fff;border:1px solid #E2E8F0;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.02);overflow:hidden;}
.card-header-sec{padding:20px 24px;border-bottom:1px solid #F1F5F9;background:#fff;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:500;display:inline-flex;align-items:center;gap:8px;box-shadow:0 4px 15px rgba(79,70,229,.35);transition:all .2s;text-decoration:none;cursor:pointer;}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);color:#fff;}
.btn-action{width:34px;height:34px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
</style>

<div class="s-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:500;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-boxes me-1"></i> Store &amp; Logistics</span>
        <h2 style="font-size:1.5rem;font-weight:500;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Suppliers &amp; Vendors</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('inventory-items.index') }}" class="btn btn-outline-light rounded-4 px-4 py-2" style="font-size:.85rem;font-weight:600;"><i class="fas fa-boxes me-2"></i> Inventory Items</a>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill gap-1">
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory.dashboard') }}">
                    <i class="fas fa-chart-pie me-2"></i>Overview
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('inventory-items.index') }}">
                    <i class="fas fa-cubes me-2"></i>Stock Items
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 active" href="{{ route('inventory-suppliers.index') }}">
                    <i class="fas fa-truck-loading me-2"></i>Suppliers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link rounded-pill py-2.5 px-3 text-secondary" href="{{ route('purchase-orders.index') }}">
                    <i class="fas fa-file-invoice-dollar me-2"></i>Purchase Orders
                </a>
            </li>
        </ul>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger rounded-4 border-danger-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ $errors->first() }}
    </div>
@endif

<div class="row g-4">
    <!-- Register Supplier Form -->
    <div class="col-lg-4">
        <div class="card-sec">
            <div class="card-header-sec">
                <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Register Supplier</h5>
                <p class="text-muted small mb-0 mt-1">Add a vendor details to start ordering stock items.</p>
            </div>
            <div class="p-4">
                <form action="{{ route('inventory-suppliers.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-medium text-dark" style="font-size:.8rem;">Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="e.g. Paramount Book Stall" required>
                    </div>

                    <div class="mb-3">
                        <label for="contact_person" class="form-label fw-medium text-dark" style="font-size:.8rem;">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="e.g. John Doe">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label fw-medium text-dark" style="font-size:.8rem;">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="+123456789">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium text-dark" style="font-size:.8rem;">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control rounded-3 py-2.5 shadow-none" placeholder="vendor@example.com">
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label fw-medium text-dark" style="font-size:.8rem;">Office Address</label>
                        <textarea name="address" id="address" class="form-control rounded-3 py-2.5 shadow-none" rows="3" placeholder="e.g. Suite 4B, Commercial Ave"></textarea>
                    </div>

                    <button type="submit" class="btn-save w-100 justify-content-center"><i class="fas fa-plus-circle"></i> Save Supplier</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Suppliers List Table -->
    <div class="col-lg-8">
        <div class="card-sec">
            <div class="card-header-sec d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="fw-medium mb-0 text-dark" style="font-size:1.05rem;">Active Vendors Directory</h5>
                    <p class="text-muted small mb-0 mt-1">Vendor information for purchase requisition.</p>
                </div>
                <form action="{{ route('inventory-suppliers.index') }}" method="GET" class="d-flex gap-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-light shadow-none py-1.5" style="font-size:.8rem;max-width:200px;" placeholder="Search vendor name...">
                    <button type="submit" class="btn btn-sm btn-primary px-3 rounded-3"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr style="font-size:.78rem;color:#475569;">
                            <th class="ps-4">Supplier Name</th>
                            <th>Contact Person</th>
                            <th>Email &amp; Phone</th>
                            <th>Address</th>
                            <th class="pe-4 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($suppliers as $supplier)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-medium text-dark" style="font-size:.85rem;">{{ $supplier->name }}</div>
                                </td>
                                <td style="font-size:.82rem;color:#334155;">
                                    {{ $supplier->contact_person ?: '—' }}
                                </td>
                                <td>
                                    <div style="font-size:.82rem;color:#334155;">{{ $supplier->email ?: 'No Email' }}</div>
                                    <div class="text-muted small" style="font-size:.78rem;">{{ $supplier->phone ?: 'No Phone' }}</div>
                                </td>
                                <td style="font-size:.82rem;color:#64748B;max-width:200px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;" title="{{ $supplier->address }}">
                                    {{ $supplier->address ?: '—' }}
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <button type="button" class="btn-action" onclick="openEditModal({{ json_encode($supplier) }})" title="Edit Details"><i class="fas fa-edit"></i></button>
                                        
                                        <form action="{{ route('inventory-suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?');" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action" style="color:#EF4444;" title="Delete"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-truck-loading fs-3 mb-2" style="color:#CBD5E1;"></i>
                                    <div class="fw-medium">No Suppliers Registered</div>
                                    <div class="small">Add a supplier on the left to start sending purchase orders.</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-bottom-0 p-4">
                <h5 class="modal-title fw-medium text-dark" id="editModalLabel" style="font-size:1.1rem;">Update Supplier Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 pb-4 pt-0">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="edit_name" class="form-label fw-medium text-dark" style="font-size:.8rem;">Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control rounded-3 py-2.5 shadow-none" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_contact_person" class="form-label fw-medium text-dark" style="font-size:.8rem;">Contact Person</label>
                        <input type="text" name="contact_person" id="edit_contact_person" class="form-control rounded-3 py-2.5 shadow-none">
                    </div>

                    <div class="mb-3">
                        <label for="edit_phone" class="form-label fw-medium text-dark" style="font-size:.8rem;">Phone Number</label>
                        <input type="text" name="phone" id="edit_phone" class="form-control rounded-3 py-2.5 shadow-none">
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label fw-medium text-dark" style="font-size:.8rem;">Email Address</label>
                        <input type="email" name="email" id="edit_email" class="form-control rounded-3 py-2.5 shadow-none">
                    </div>

                    <div class="mb-4">
                        <label for="edit_address" class="form-label fw-medium text-dark" style="font-size:.8rem;">Office Address</label>
                        <textarea name="address" id="edit_address" class="form-control rounded-3 py-2.5 shadow-none" rows="3"></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-outline-secondary px-4 rounded-3" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn-save px-4"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openEditModal(supplier) {
    // Set form action dynamically
    document.getElementById('editForm').action = "/inventory-suppliers/" + supplier.id;
    
    // Set values
    document.getElementById('edit_name').value = supplier.name;
    document.getElementById('edit_contact_person').value = supplier.contact_person || '';
    document.getElementById('edit_phone').value = supplier.phone || '';
    document.getElementById('edit_email').value = supplier.email || '';
    document.getElementById('edit_address').value = supplier.address || '';
    
    // Show modal
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();
}
</script>
@endsection
