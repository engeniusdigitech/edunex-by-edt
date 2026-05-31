@extends('layouts.admin')
@section('title', 'Book Details')

@section('content')
<div class="mb-4 d-flex justify-content-between align-items-center">
    <a href="{{ route('library.books.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i>Back to Books
    </a>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius:16px;">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 mb-3 mb-md-0 text-center">
                @if(!empty($book->cover_image))
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover" class="img-fluid rounded-3 shadow-sm" style="max-height:300px; object-fit:cover; width:100%;">
                @else
                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center flex-column text-muted shadow-sm" style="height:300px; width:100%;">
                        <i class="fas fa-book fa-4x mb-3"></i>
                        <span>No Cover Available</span>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <h4 class="fw-bold text-dark mb-2">{{ $book->title ?? 'Unknown Title' }}</h4>
                <div class="mb-3">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-medium me-2">{{ $book->category->name ?? 'N/A' }}</span>
                    @if(isset($book) && $book->status == 'active')
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-medium">Active</span>
                    @else
                        <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2 fw-medium">Inactive</span>
                    @endif
                </div>

                <div class="row mb-4">
                    <div class="col-sm-6 mb-2"><strong>Author:</strong> {{ $book->author->name ?? 'N/A' }}</div>
                    <div class="col-sm-6 mb-2"><strong>Publisher:</strong> {{ $book->publisher->name ?? 'N/A' }}</div>
                    <div class="col-sm-6 mb-2"><strong>ISBN:</strong> {{ $book->isbn ?? 'N/A' }}</div>
                    <div class="col-sm-6 mb-2"><strong>Edition:</strong> {{ $book->edition ?? 'N/A' }}</div>
                    <div class="col-sm-6 mb-2"><strong>Language:</strong> {{ $book->language ?? 'N/A' }}</div>
                    <div class="col-sm-6 mb-2"><strong>Rack/Location:</strong> {{ $book->rack_number ?? 'N/A' }}</div>
                </div>

                <p class="text-muted">{{ $book->description ?? '' }}</p>

                <div class="row mt-4 g-3">
                    <div class="col-4">
                        <div class="p-3 bg-light rounded-3 text-center border">
                            <div class="fs-6 text-muted mb-1">Total Copies</div>
                            <div class="fs-4 fw-bold text-dark">{{ $book->total_copies ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-success bg-opacity-10 rounded-3 text-center border border-success border-opacity-25">
                            <div class="fs-6 text-success mb-1">Available</div>
                            <div class="fs-4 fw-bold text-success">{{ $book->available_copies ?? 0 }}</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3 bg-warning bg-opacity-10 rounded-3 text-center border border-warning border-opacity-25">
                            <div class="fs-6 text-warning mb-1">Currently Issued</div>
                            <div class="fs-4 fw-bold text-warning">{{ $book->issued_copies ?? 0 }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-body p-4 text-center">
                <h6 class="fw-bold mb-3">QR Code</h6>
                <div class="mb-3 d-flex justify-content-center align-items-center h-100 pb-4">
                    @if(class_exists('\SimpleSoftwareIO\QrCode\Facades\QrCode'))
                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($book->book_number ?? ($book->isbn ?? 'N/A')) !!}
                    @else
                        <div class="text-muted"><i class="fas fa-qrcode fa-4x mb-2"></i><br>QR Generator not found</div>
                    @endif
                </div>
                <button class="btn btn-outline-primary btn-sm"><i class="fas fa-print me-1"></i> Print QR</button>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3 mt-md-0">
        <div class="card border-0 shadow-sm h-100" style="border-radius:16px;">
            <div class="card-body p-4 text-center">
                <h6 class="fw-bold mb-3">Barcode</h6>
                <div class="mb-3 d-flex flex-column justify-content-center align-items-center h-100 pb-4">
                    @if(class_exists('\Milon\Barcode\DNS1D'))
                        {!! \Milon\Barcode\Facades\DNS1DFacade::getBarcodeHTML($book->book_number ?? ($book->isbn ?? '000'), 'C39', 2, 80) !!}
                    @else
                        <div class="text-muted"><i class="fas fa-barcode fa-4x mb-2"></i><br>Barcode Generator not found</div>
                    @endif
                    <div class="mt-2 text-muted fw-bold">{{ $book->book_number ?? ($book->isbn ?? 'N/A') }}</div>
                </div>
                <button class="btn btn-outline-primary btn-sm"><i class="fas fa-print me-1"></i> Print Barcode</button>
            </div>
        </div>
    </div>
</div>

<h5 class="fw-bold mb-3">Issue History</h5>
<div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr style="background-color:#F8FAFC;">
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Member</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Type</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Issue Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Due Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Return Date</th>
                    <th style="font-size:0.75rem;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#64748B;padding:14px 20px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($issues ?? [] as $issue)
                <tr>
                    <td style="padding:14px 20px;">{{ $issue->member->name ?? 'Unknown' }}</td>
                    <td style="padding:14px 20px;">{{ ucfirst($issue->member_type ?? '') }}</td>
                    <td style="padding:14px 20px;">{{ \Carbon\Carbon::parse($issue->issue_date)->format('d M Y') }}</td>
                    <td style="padding:14px 20px;">{{ \Carbon\Carbon::parse($issue->due_date)->format('d M Y') }}</td>
                    <td style="padding:14px 20px;">{{ $issue->return_date ? \Carbon\Carbon::parse($issue->return_date)->format('d M Y') : '-' }}</td>
                    <td style="padding:14px 20px;">
                        @if($issue->status == 'issued')
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-1">Issued</span>
                        @elseif($issue->status == 'returned')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">Returned</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-1">{{ ucfirst($issue->status) }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">No issue history found for this book.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if(isset($issues) && $issues->hasPages())
    <div class="card-footer bg-white border-0 py-3">
        {{ $issues->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
