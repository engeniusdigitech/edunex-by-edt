@extends('layouts.admin')
@section('title', 'Hostel Messes')
@section('content')
<style>
.m-hdr{background:linear-gradient(135deg,#0F172A,#1E1B4B);border-radius:18px;padding:28px 32px;margin-bottom:28px;border:1px solid rgba(99,102,241,.2);position:relative;overflow:hidden;}
.m-hdr::before{content:'';position:absolute;inset:0;background-image:linear-gradient(rgba(99,102,241,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(99,102,241,.05) 1px,transparent 1px);background-size:26px 26px;}
.m-card{background:#fff;border:1px solid #F1F5F9;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,.03);overflow:hidden;transition:all .2s;}
.m-card:hover{transform:translateY(-2px);box-shadow:0 10px 25px rgba(0,0,0,.05);border-color:rgba(79,70,229,.25);}
.btn-add{background:linear-gradient(135deg,#4F46E5,#7C3AED);color:#fff;border:none;padding:10px 20px;border-radius:10px;font-size:.85rem;font-weight:700;display:inline-flex;align-items:center;gap:8px;text-decoration:none;box-shadow:0 4px 15px rgba(79,70,229,.35);}
.btn-add:hover{color:#fff;transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,.45);}
.btn-action{width:36px;height:36px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;color:#64748B;border:1px solid #E2E8F0;background:#fff;text-decoration:none;}
.btn-action:hover{color:#4F46E5;border-color:#4F46E5;background:#EEF2FF;}
</style>

<div class="m-hdr d-flex justify-content-between align-items-center flex-wrap gap-3">
    <div style="position:relative;z-index:2;">
        <span style="font-size:.7rem;font-weight:700;color:#67E8F9;text-transform:uppercase;letter-spacing:1px;"><i class="fas fa-utensils me-1"></i> Mess &amp; Catering</span>
        <h2 style="font-size:1.5rem;font-weight:800;color:#fff;margin:6px 0 0;letter-spacing:-.5px;">Hostel Messes</h2>
    </div>
    <div style="position:relative;z-index:2;">
        <a href="{{ route('hostel-messes.create') }}" class="btn-add"><i class="fas fa-plus"></i> Create Hostel Mess</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-4 border-success-subtle shadow-sm mb-4" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
    </div>
@endif

<div class="row g-4">
    @forelse($messes as $mess)
        <div class="col-md-6 col-lg-4">
            <div class="m-card p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size:0.7rem;padding:4px 10px;">{{ $mess->subscriptions_count }} Active Subscribers</span>
                </div>
                <h4 style="font-size:1.15rem;font-weight:700;color:#1E293B;margin-bottom:8px;letter-spacing:-.3px;">{{ $mess->name }}</h4>
                <p style="font-size:.85rem;color:#64748B;line-height:1.5;min-height:42px;margin-bottom:20px;">{{ $mess->description ?: 'No description provided for this hostel mess.' }}</p>
                
                @if($mess->warden_name)
                    <div style="font-size:.8rem;color:#475569;margin-bottom:20px;">
                        <strong>Warden/Caterer:</strong> {{ $mess->warden_name }}
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center pt-3 border-top" style="border-color:#F1F5F9!important;">
                    <a href="{{ route('hostel-messes.show', $mess) }}" style="font-size:.82rem;color:#4F46E5;text-decoration:none;font-weight:700;display:inline-flex;align-items:center;gap:6px;">Manage Menu &amp; Subs <i class="fas fa-arrow-right"></i></a>
                    <div class="d-flex gap-2">
                        <form action="{{ route('hostel-messes.destroy', $mess) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this mess? All menu details and student subscriptions will be lost.');" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action" style="color:#EF4444;" title="Delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div style="background:#fff;border:1px solid #E2E8F0;border-radius:18px;padding:60px 20px;text-align:center;color:#64748B;">
                <i class="fas fa-utensils fs-1 mb-3" style="color:#CBD5E1;"></i>
                <h5 class="text-dark fw-bold">No Hostel Mess Hall Registered</h5>
                <p class="mb-4">Create your first mess catering system to start managing daily nutrition calendars.</p>
                <a href="{{ route('hostel-messes.create') }}" class="btn-add"><i class="fas fa-plus"></i> Create Hostel Mess</a>
            </div>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $messes->links() }}
</div>
@endsection
