@extends('layouts.admin')

@section('title', 'Custom Orders')
@section('page-title', 'Custom Orders')

@section('content')

<div class="custom-orders-header">
    <div>
        <span class="dashboard-eyebrow">Management</span>
        <h2>Custom Orders</h2>
        <p>Manage all custom order requests from customers</p>
    </div>
    <div class="header-actions">
        <a href="#" class="btn btn-secondary" onclick="exportOrders()">
            <i class="fa-solid fa-file-export"></i> Export
        </a>
        <a href="{{ route('admin.custom-orders.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> New Custom Order
        </a>
    </div>
</div>

{{-- Stats --}}
<div class="stats-row">
    <div class="stat-mini">
        <span class="stat-mini-label">Total Orders</span>
        <strong class="stat-mini-value">{{ $customOrders->total() }}</strong>
    </div>
    <div class="stat-mini">
        <span class="stat-mini-label">Pending</span>
        <strong class="stat-mini-value text-warning">{{ $pendingCount ?? 0 }}</strong>
    </div>
    <div class="stat-mini">
        <span class="stat-mini-label">In Progress</span>
        <strong class="stat-mini-value text-info">{{ $inProgressCount ?? 0 }}</strong>
    </div>
    <div class="stat-mini">
        <span class="stat-mini-label">Completed</span>
        <strong class="stat-mini-value text-success">{{ $completedCount ?? 0 }}</strong>
    </div>
    <div class="stat-mini">
        <span class="stat-mini-label">Revenue</span>
        <strong class="stat-mini-value">Rs. {{ number_format($totalRevenue ?? 0, 2) }}</strong>
    </div>
</div>

{{-- Filters --}}
<div class="filter-section">
    <form method="GET" action="{{ route('admin.custom-orders.index') }}" class="filter-form">
        <div class="filter-grid">
            <div class="filter-item">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="review" {{ request('status') == 'review' ? 'selected' : '' }}>Under Review</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="filter-item">
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-input" 
                       placeholder="Search by ID or customer..." 
                       value="{{ request('search') }}">
            </div>

            <div class="filter-item">
                <label for="date_from">Date From</label>
                <input type="date" name="date_from" id="date_from" class="form-input" 
                       value="{{ request('date_from') }}">
            </div>

            <div class="filter-item">
                <label for="date_to">Date To</label>
                <input type="date" name="date_to" id="date_to" class="form-input" 
                       value="{{ request('date_to') }}">
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
                <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-undo"></i> Reset
                </a>
            </div>
        </div>
    </form>
</div>

{{-- Table --}}
<div class="admin-panel">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th width="40">
                        <input type="checkbox" id="selectAll" class="checkbox">
                    </th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th width="120">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customOrders as $order)
                <tr>
                    <td>
                        <input type="checkbox" class="checkbox order-checkbox" value="{{ $order->id }}">
                    </td>
                    <td>
                        <strong>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</strong>
                    </td>
                    <td>
                        <div class="customer-info">
                            <div class="customer-avatar">
                                {{ substr($order->user->name ?? 'G', 0, 1) }}
                            </div>
                            <div>
                                <div class="customer-name">{{ $order->user->name ?? 'Guest' }}</div>
                                <div class="customer-email">{{ $order->user->email ?? 'N/A' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="product-info">
                            <strong>{{ $order->product_name ?? 'N/A' }}</strong>
                            <small>{{ Str::limit($order->description ?? '', 30) }}</small>
                        </div>
                    </td>
                    <td>{{ $order->quantity ?? 1 }}</td>
                    <td>
                        <strong>Rs. {{ number_format($order->total_price ?? 0, 2) }}</strong>
                    </td>
                    <td>
                        @php
                            $statusColors = [
                                'pending' => 'warning',
                                'in_progress' => 'info',
                                'review' => 'primary',
                                'approved' => 'success',
                                'completed' => 'success',
                                'rejected' => 'danger'
                            ];
                            $status = $order->status ?? 'pending';
                        @endphp
                        <span class="status status-{{ $statusColors[$status] ?? 'secondary' }}">
                            {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </span>
                    </td>
                    <td>
                        <div class="date-info">
                            <div>{{ $order->created_at->format('d M Y') }}</div>
                            <small>{{ $order->created_at->format('h:i A') }}</small>
                        </div>
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.custom-orders.show', $order) }}" 
                               class="btn-icon btn-view" title="View">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.custom-orders.edit', $order) }}" 
                               class="btn-icon btn-edit" title="Edit">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                            <button onclick="deleteOrder({{ $order->id }})" 
                                    class="btn-icon btn-delete" title="Delete">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center empty-state">
                        <i class="fa-regular fa-inbox"></i>
                        <p>No custom orders found</p>
                        <a href="{{ route('admin.custom-orders.create') }}" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-plus"></i> Create First Custom Order
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="table-footer">
        <div class="table-info">
            Showing {{ $customOrders->firstItem() ?? 0 }} to {{ $customOrders->lastItem() ?? 0 }} 
            of {{ $customOrders->total() }} entries
        </div>
        <div class="table-pagination">
            {{ $customOrders->appends(request()->query())->links() }}
        </div>
    </div>
</div>

{{-- Delete Form --}}
<form id="deleteForm" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

@endsection

@push('styles')
<style>
    .custom-orders-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 24px;
    }

    .stat-mini {
        background: white;
        padding: 15px 20px;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        text-align: center;
    }

    .stat-mini-label {
        display: block;
        font-size: 11px;
        text-transform: uppercase;
        color: #9a887e;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .stat-mini-value {
        display: block;
        font-size: 22px;
        margin-top: 4px;
        color: #3d302b;
    }

    .text-warning { color: #b89478; }
    .text-info { color: #5a74a8; }
    .text-success { color: #587050; }

    .filter-section {
        background: white;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid var(--admin-border);
        margin-bottom: 24px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 15px;
        align-items: end;
    }

    .filter-item {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-item label {
        font-size: 11px;
        font-weight: 600;
        color: #69574e;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-actions {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .form-select,
    .form-input {
        padding: 8px 12px;
        border: 1px solid var(--admin-border);
        border-radius: 8px;
        font-size: 13px;
        background: white;
        transition: border-color 0.2s;
        width: 100%;
    }

    .form-select:focus,
    .form-input:focus {
        outline: none;
        border-color: var(--admin-pink);
        box-shadow: 0 0 0 3px rgba(185, 109, 112, 0.1);
    }

    .customer-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .customer-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--admin-pink-light);
        color: var(--admin-pink-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        flex-shrink: 0;
    }

    .customer-name {
        font-weight: 600;
        color: #493b35;
        font-size: 13px;
    }

    .customer-email {
        font-size: 11px;
        color: #9a887e;
    }

    .product-info strong {
        display: block;
        font-size: 13px;
        color: #493b35;
    }

    .product-info small {
        font-size: 11px;
        color: #9a887e;
    }

    .date-info {
        font-size: 12px;
        color: #493b35;
    }

    .date-info small {
        font-size: 10px;
        color: #9a887e;
    }

    .status {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .status-warning { background: #f8eee5; color: #b89478; }
    .status-info { background: #e3e9f5; color: #5a74a8; }
    .status-primary { background: #e3e9f5; color: #5a74a8; }
    .status-success { background: #e6f0e4; color: #587050; }
    .status-danger { background: #fceaea; color: #a44f55; }
    .status-secondary { background: #f0f0f0; color: #666; }

    .action-buttons {
        display: flex;
        gap: 4px;
    }

    .btn-icon {
        width: 32px;
        height: 32px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
        background: transparent;
        color: #685951;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-view:hover { background: #e3e9f5; color: #5a74a8; }
    .btn-edit:hover { background: #f8eee5; color: #b89478; }
    .btn-delete:hover { background: #fceaea; color: #a44f55; }

    .checkbox {
        width: 16px;
        height: 16px;
        cursor: pointer;
        accent-color: var(--admin-pink-dark);
    }

    .empty-state {
        padding: 40px 20px !important;
        text-align: center;
        color: #9a887e;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 12px;
        display: block;
        color: var(--admin-border);
    }

    .empty-state p {
        margin-bottom: 15px;
        font-size: 14px;
    }

    .table-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 15px;
        border-top: 1px solid var(--admin-border);
        margin-top: 15px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .table-info {
        font-size: 12px;
        color: #9a887e;
    }

    .table-pagination {
        display: flex;
        gap: 5px;
    }

    .table-pagination .pagination {
        margin: 0;
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

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
    }

    @media (max-width: 768px) {
        .filter-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
        
        .custom-orders-header {
            flex-direction: column;
        }
        
        .table-footer {
            flex-direction: column;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .filter-grid {
            grid-template-columns: 1fr;
        }
        
        .stats-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    function deleteOrder(id) {
        if (confirm('Are you sure you want to delete this custom order?')) {
            const form = document.getElementById('deleteForm');
            form.action = `{{ route('admin.custom-orders.destroy', '') }}/${id}`;
            form.submit();
        }
    }

    document.getElementById('selectAll')?.addEventListener('change', function() {
        document.querySelectorAll('.order-checkbox').forEach(cb => cb.checked = this.checked);
    });

    function exportOrders() {
        window.location.href = '{{ route("admin.custom-orders.export") }}';
    }
</script>
@endpush