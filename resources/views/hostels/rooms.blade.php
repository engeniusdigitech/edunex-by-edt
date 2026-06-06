@extends('layouts.admin')
@section('title', 'Rooms — ' . $hostel->name)
@section('content')
<style>
.r-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.r-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.r-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;}
.r-sec-hdr{padding:16px 28px;border-bottom:1px solid #F1F5F9;background:#FAFAFA;font-size:.78rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.8px;display:flex;align-items:center;gap:10px;}
.r-body{padding:28px;}
.form-label-custom{display:block;font-size:.7rem;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.7px;margin-bottom:7px;}
.form-control-custom,.form-select-custom{border:1.5px solid #E2E8F0;border-radius:12px;padding:10px 14px;font-size:.85rem;color:#1E293B;transition:all .2s;background:#fff;}
.form-control-custom:focus,.form-select-custom:focus{border-color:#4F46E5;box-shadow:0 0 0 3px rgba(79,70,229,.08);outline:none;}
.btn-save{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:700;display:inline-flex;align-items:center;gap:9px;cursor:pointer;transition:all .2s;}
.btn-action{width:32px;height:32px;border-radius:8px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;transition:all .2s;}
.btn-action:hover{color:#EF4444;border-color:#FCA5A5;background:#FEF2F2;}
</style>

<div class="r-hdr">
    <div style="position:relative;z-index:2;display:flex;align-items:center;gap:14px;">
        <a href="{{ route('hostels.index') }}" style="width:42px;height:42px;border-radius:12px;background:rgba(255,255,255,.08);border:1.5px solid rgba(255,255,255,.15);display:flex;align-items:center;justify-content:center;color:#fff;text-decoration:none;flex-shrink:0;"><i class="fas fa-arrow-left"></i></a>
        <div>
            <div style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px;"><i class="fas fa-hotel me-1"></i> Rooms</div>
            <h2 style="font-size:1.4rem;font-weight:800;color:#fff;margin:0;letter-spacing:-.5px;">{{ $hostel->name }}</h2>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="row g-4">
    <!-- Add Room Form Panel -->
    <div class="col-lg-4">
        <div class="r-card">
            <div class="r-sec-hdr"><i class="fas fa-plus text-primary"></i> Add Room</div>
            <div class="r-body">
                <form action="{{ route('hostels.rooms.store', $hostel) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label-custom">Room Number <span class="text-danger">*</span></label>
                        <input type="text" name="room_number" class="form-control form-control-custom @error('room_number') is-invalid @enderror" value="{{ old('room_number') }}" placeholder="e.g. A-101" required>
                        @error('room_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Room Type <span class="text-danger">*</span></label>
                        <select name="room_type" class="form-select form-select-custom" required>
                            <option value="Single">Single (1 Bed)</option>
                            <option value="Double" selected>Double (2 Beds)</option>
                            <option value="Triple">Triple (3 Beds)</option>
                            <option value="4-Sharing">4-Sharing (4 Beds)</option>
                            <option value="Dormitory">Dormitory</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label-custom">Bed Capacity <span class="text-danger">*</span></label>
                        <input type="number" name="capacity" class="form-control form-control-custom" value="{{ old('capacity', 2) }}" min="1" max="20" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-custom">Cost / Month ({{ currencySymbol() }}) <span class="text-danger">*</span></label>
                        <input type="number" name="cost_per_month" class="form-control form-control-custom" value="{{ old('cost_per_month', 1500) }}" min="0" step="any" required>
                    </div>

                    <button type="submit" class="btn-save w-100"><i class="fas fa-save"></i> Save Room</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Rooms List Panel -->
    <div class="col-lg-8">
        <div class="r-card">
            <div class="r-sec-hdr"><i class="fas fa-door-open text-primary"></i> Rooms List</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="font-size:.88rem;">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Room No.</th>
                            <th>Type</th>
                            <th>Beds Capacity</th>
                            <th>Rent / Month</th>
                            <th>Occupants</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hostel->rooms as $room)
                            @php 
                                $activeAllocations = $room->allocations->where('status', 'active');
                                $occupiedCount = $activeAllocations->count();
                            @endphp
                            <tr>
                                <td class="ps-4 fw-bold text-dark">{{ $room->room_number }}</td>
                                <td><span class="badge bg-light text-dark border">{{ $room->room_type }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span>{{ $occupiedCount }} / {{ $room->capacity }} beds</span>
                                        <div class="progress" style="width:50px;height:6px;">
                                            <div class="progress-bar bg-{{ $occupiedCount == $room->capacity ? 'danger' : 'primary' }}" 
                                                 role="progressbar" 
                                                 style="width: {{ ($occupiedCount / $room->capacity) * 100 }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ currencySymbol() }}{{ number_format($room->cost_per_month, 2) }}</td>
                                <td>
                                    @if($activeAllocations->isEmpty())
                                        <span class="text-muted small">Empty</span>
                                    @else
                                        @foreach($activeAllocations as $alloc)
                                            <span class="badge bg-secondary p-2 me-1" style="font-size: 0.72rem;">
                                                <i class="fas fa-user-circle"></i> {{ $alloc->student->name }}
                                            </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="text-end pe-4">
                                    <form action="{{ route('hostels.rooms.destroy', [$hostel, $room]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room? All allocations will be lost.');" style="margin:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No rooms defined yet in this hostel block.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
