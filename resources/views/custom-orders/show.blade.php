@extends('layouts.admin')

@section('title', 'Custom Order #' . str_pad($customOrder->id, 6, '0', STR_PAD_LEFT))
@section('page-title', 'Custom Order Details')

@section('content')

<div class="order-header">
    <div class="order-header-left">
        <div>
            <span class="dashboard-eyebrow">Order Details</span>
            <h2>#{{ str_pad($customOrder->id, 6, '0', STR_PAD_LEFT) }}</h2>
            <p>Custom order from {{ $customOrder->user->name ?? 'Guest' }}</p>
        </div>
    </div>
    <div class="order-header-right">
        <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back
        </a>
        <a href="{{ route('admin.custom-orders.edit', $customOrder) }}" class="btn btn-primary">
            <i class="fa-regular fa-pen-to-square"></i> Edit
        </a>
    </div>
</div>

{{-- Status Bar --}}
<div class="order-status-bar">
    <div class="status-track">
        @php
            $statuses = ['pending', 'in_progress', 'review', 'approved', 'completed'];
            $currentStatus = $customOrder->status ?? 'pending';
            $currentIndex = array_search($currentStatus, $statuses);
        @endphp

        @foreach($statuses as $index => $status)
            @if($index > 0)
                <div class="status-line {{ $index <= $currentIndex ? 'active' : '' }}"></div>
            @endif
            <div class="status-step {{ $index <= $currentIndex ? 'active' : '' }}">
                <div class="status-dot"></div>
                <span>{{ ucfirst(str_replace('_', ' ', $status)) }}</span>
            </div>
        @endforeach
    </div>
    <div class="current-status">
        <span class="status status-{{ $statusColors[$currentStatus] ?? 'secondary' }}">
            {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
        </span>
    </div>
</div>

<div class="order-grid">
    {{-- Left Column --}}
    <div class="order-main">
        {{-- Order Information --}}
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Order Information</h3>
            </div>
            <div class="order-info-grid">
                <div class="info-item">
                    <label>Order ID</label>
                    <span>#{{ str_pad($customOrder->id, 6, '0', STR_PAD_LEFT) }}</span>
                </div>
                <div class="info-item">
                    <label>Status</label>
                    <span class="status status-{{ $statusColors[$currentStatus] ?? 'secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Priority</label>
                    <span class="priority priority-{{ $priorityColors[$customOrder->priority ?? 'medium'] ?? 'secondary' }}">
                        <i class="fa-solid fa-circle"></i>
                        {{ ucfirst($customOrder->priority ?? 'Medium') }}
                    </span>
                </div>
                <div class="info-item">
                    <label>Date Created</label>
                    <span>{{ $customOrder->created_at->format('d M Y, h:i A') }}</span>
                </div>
                <div class="info-item">
                    <label>Last Updated</label>
                    <span>{{ $customOrder->updated_at->format('d M Y, h:i A') }}</span>
                </div>
                @if($customOrder->completed_at)
                <div class="info-item">
                    <label>Completed At</label>
                    <span>{{ $customOrder->completed_at->format('d M Y, h:i A') }}</span>
                </div>
                @endif
            </div>
        </div>

        {{-- Product Details --}}
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Product Details</h3>
            </div>
            <div class="product-details">
                <div class="product-main-info">
                    @if($customOrder->image_url)
                        <div class="product-image">
                            <img src="{{ $customOrder->image_url }}" alt="{{ $customOrder->product_name }}">
                        </div>
                    @else
                        <div class="product-image-placeholder">
                            <i class="fa-solid fa-shirt"></i>
                        </div>
                    @endif
                    <div class="product-info">
                        <h4>{{ $customOrder->product_name ?? 'N/A' }}</h4>
                        <p class="product-description">{{ $customOrder->description ?? 'No description provided' }}</p>
                        <div class="product-meta">
                            <span><strong>Quantity:</strong> {{ $customOrder->quantity ?? 1 }}</span>
                            <span><strong>Price:</strong> Rs. {{ number_format($customOrder->total_price ?? 0, 2) }}</span>
                        </div>
                    </div>
                </div>
                @if($customOrder->specifications)
                <div class="product-specifications">
                    <h5>Specifications</h5>
                    <div class="spec-grid">
                        @foreach(json_decode($customOrder->specifications, true) ?? [] as $key => $value)
                        <div class="spec-item">
                            <span class="spec-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                            <span class="spec-value">{{ $value }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- Notes --}}
        @if($customOrder->notes)
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Notes</h3>
            </div>
            <div class="notes-content">
                {{ $customOrder->notes }}
            </div>
        </div>
        @endif
    </div>

    {{-- Right Column --}}
    <div class="order-sidebar">
        {{-- Customer Info --}}
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Customer Information</h3>
            </div>
            <div class="customer-details">
                <div class="customer-avatar-large">
                    {{ substr($customOrder->user->name ?? 'G', 0, 1) }}
                </div>
                <div class="customer-detail-info">
                    <h4>{{ $customOrder->user->name ?? 'Guest' }}</h4>
                    <p><i class="fa-regular fa-envelope"></i> {{ $customOrder->user->email ?? 'N/A' }}</p>
                    @if($customOrder->user->phone)
                    <p><i class="fa-regular fa-phone"></i> {{ $customOrder->user->phone }}</p>
                    @endif
                    <a href="{{ route('admin.users.show', $customOrder->user_id) }}" class="btn btn-sm btn-secondary">
                        <i class="fa-regular fa-user"></i> View Profile
                    </a>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Quick Actions</h3>
            </div>
            <div class="quick-actions-sidebar">
                @if($currentStatus == 'pending')
                <button onclick="updateStatus('in_progress')" class="btn btn-info btn-sm w-full">
                    <i class="fa-solid fa-play"></i> Start Processing
                </button>
                @endif
                @if($currentStatus == 'in_progress')
                <button onclick="updateStatus('review')" class="btn btn-primary btn-sm w-full">
                    <i class="fa-solid fa-magnifying-glass"></i> Send for Review
                </button>
                @endif
                @if($currentStatus == 'review')
                <button onclick="updateStatus('approved')" class="btn btn-success btn-sm w-full">
                    <i class="fa-solid fa-check"></i> Approve Order
                </button>
                @endif
                @if($currentStatus == 'approved')
                <button onclick="updateStatus('completed')" class="btn btn-success btn-sm w-full">
                    <i class="fa-solid fa-flag-checkered"></i> Mark Complete
                </button>
                @endif
                @if(!in_array($currentStatus, ['completed', 'rejected']))
                <button onclick="updateStatus('rejected')" class="btn btn-danger btn-sm w-full">
                    <i class="fa-solid fa-xmark"></i> Reject Order
                </button>
                @endif
                <a href="#" onclick="printOrder()" class="btn btn-secondary btn-sm w-full">
                    <i class="fa-solid fa-print"></i> Print Order
                </a>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="admin-panel">
            <div class="panel-header">
                <h3>Order Summary</h3>
            </div>
            <div class="order-summary">
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>Rs. {{ number_format($customOrder->total_price ?? 0, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Quantity</span>
                    <span>{{ $customOrder->quantity ?? 1 }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span>Rs. {{ number_format($customOrder->total_price ?? 0, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Update Form --}}
<form id="statusForm" method="POST" style="display: none;">
    @csrf
    @method('PUT')
    <input type="hidden" name="status" id="statusInput">
</form>

@endsection

@push('styles')
<style>
    .order-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .order-header-right {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .order-status-bar {
        background: white;
        padding: 20px 30px;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
    }

    .status-track {
        display: flex;
        align-items: center;
        flex: 1;
        flex-wrap: wrap;
        gap: 0;
    }

    .status-step {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #9a887e;
        opacity: 0.5;
        transition: all 0.3s;
    }

    .status-step.active {
        opacity: 1;
        color: var(--admin-brown);
        font-weight: 600;
    }

    .status-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid #ddd;
        background: white;
        transition: all 0.3s;
    }

    .status-step.active .status-dot {
        border-color: var(--admin-pink-dark);
        background: var(--admin-pink-dark);
    }

    .status-line {
        width: 30px;
        height: 2px;
        background: #ddd;
        margin: 0 8px;
        transition: all 0.3s;
    }

    .status-line.active {
        background: var(--admin-pink-dark);
    }

    .current-status {
        flex-shrink: 0;
    }

    .order-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .order-main {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .order-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .admin-panel {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        padding: 20px 24px;
    }

    .panel-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .panel-header h3 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        color: #3d302b;
        margin: 0;
    }

    .order-info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .info-item label {
        font-size: 11px;
        text-transform: uppercase;
        color: #9a887e;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .info-item span {
        font-size: 14px;
        color: #493b35;
        font-weight: 500;
    }

    .priority {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .priority i {
        font-size: 6px;
    }

    .priority-success { background: #e6f0e4; color: #587050; }
    .priority-warning { background: #f8eee5; color: #b89478; }
    .priority-orange { background: #fdf0e0; color: #c48540; }
    .priority-danger { background: #fceaea; color: #a44f55; }
    .priority-secondary { background: #f0f0f0; color: #666; }

    .product-details {
        padding: 5px 0;
    }

    .product-main-info {
        display: flex;
        gap: 20px;
        align-items: flex-start;
    }

    .product-image {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        overflow: hidden;
        flex-shrink: 0;
        border: 1px solid var(--admin-border);
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .product-image-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 12px;
        background: var(--admin-pink-light);
        color: var(--admin-pink-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 36px;
        flex-shrink: 0;
        border: 1px solid var(--admin-border);
    }

    .product-info h4 {
        font-size: 18px;
        color: #3d302b;
        margin: 0 0 8px;
    }

    .product-description {
        color: #685951;
        font-size: 14px;
        line-height: 1.6;
        margin: 0 0 12px;
    }

    .product-meta {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #685951;
    }

    .product-meta strong {
        color: #493b35;
    }

    .product-specifications {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid var(--admin-border);
    }

    .product-specifications h5 {
        font-size: 14px;
        color: #3d302b;
        margin: 0 0 12px;
    }

    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .spec-item {
        display: flex;
        justify-content: space-between;
        padding: 6px 12px;
        background: #faf5f0;
        border-radius: 6px;
        font-size: 13px;
    }

    .spec-label {
        color: #9a887e;
    }

    .spec-value {
        color: #493b35;
        font-weight: 500;
    }

    .notes-content {
        color: #685951;
        font-size: 14px;
        line-height: 1.6;
        padding: 5px 0;
    }

    .customer-details {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .customer-avatar-large {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: var(--admin-pink-light);
        color: var(--admin-pink-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .customer-detail-info h4 {
        font-size: 16px;
        color: #3d302b;
        margin: 0 0 4px;
    }

    .customer-detail-info p {
        font-size: 13px;
        color: #685951;
        margin: 3px 0;
    }

    .customer-detail-info p i {
        width: 18px;
        color: #9a887e;
    }

    .quick-actions-sidebar {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .w-full {
        width: 100%;
    }

    .order-summary {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 14px;
        color: #685951;
    }

    .summary-row.total {
        border-top: 2px solid var(--admin-border);
        padding-top: 12px;
        margin-top: 4px;
        font-weight: 700;
        font-size: 16px;
        color: #3d302b;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-primary {
        background: var(--admin-pink-dark);
        color: white;
    }

    .btn-primary:hover {
        background: #a86264;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(185, 109, 112, 0.3);
    }

    .btn-secondary {
        background: #faf5f0;
        color: #493b35;
        border: 1px solid var(--admin-border);
    }

    .btn-secondary:hover {
        background: #f5ede8;
        transform: translateY(-1px);
    }

    .btn-info {
        background: #e3e9f5;
        color: #5a74a8;
        border: 1px solid #c5d2e8;
    }

    .btn-info:hover {
        background: #d0ddec;
        color: #3a5a8a;
    }

    .btn-success {
        background: #e6f0e4;
        color: #587050;
        border: 1px solid #c5d8c0;
    }

    .btn-success:hover {
        background: #d4e5d0;
        color: #3a5a3a;
    }

    .btn-danger {
        background: #fceaea;
        color: #a44f55;
        border: 1px solid #f0cfd1;
    }

    .btn-danger:hover {
        background: #f5d5d5;
        color: #8a3a40;
    }

    .btn-sm {
        padding: 8px 14px;
        font-size: 12px;
        border-radius: 6px;
    }

    .status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-warning { background: #f8eee5; color: #b89478; }
    .status-info { background: #e3e9f5; color: #5a74a8; }
    .status-primary { background: #e3e9f5; color: #5a74a8; }
    .status-success { background: #e6f0e4; color: #587050; }
    .status-danger { background: #fceaea; color: #a44f55; }
    .status-secondary { background: #f0f0f0; color: #666; }

    @media (max-width: 992px) {
        .order-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .order-info-grid {
            grid-template-columns: 1fr;
        }
        
        .status-track {
            gap: 0;
        }
        
        .status-step span {
            font-size: 10px;
        }
        
        .status-line {
            width: 15px;
        }
        
        .product-main-info {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .product-meta {
            flex-direction: column;
            gap: 5px;
            align-items: center;
        }
        
        .spec-grid {
            grid-template-columns: 1fr;
        }
        
        .order-header {
            flex-direction: column;
        }
        
        .order-header-right {
            width: 100%;
        }
        
        .order-header-right .btn {
            flex: 1;
            justify-content: center;
        }
        
        .customer-details {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function updateStatus(status) {
        if (confirm('Are you sure you want to update the status to "' + status.replace('_', ' ') + '"?')) {
            const form = document.getElementById('statusForm');
            form.action = '{{ route("admin.custom-orders.update", $customOrder) }}';
            document.getElementById('statusInput').value = status;
            form.submit();
        }
    }

    function printOrder() {
        window.print();
    }
</script>
@endpush