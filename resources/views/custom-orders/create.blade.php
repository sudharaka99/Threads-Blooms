@extends('layouts.admin')

@section('title', 'Create Custom Order')
@section('page-title', 'Create Custom Order')

@section('content')

<div class="create-header">
    <div>
        <span class="dashboard-eyebrow">Create</span>
        <h2>New Custom Order</h2>
        <p>Create a new custom order for a customer</p>
    </div>
    <div class="create-header-actions">
        <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="create-form-container">
    <form method="POST" action="{{ route('admin.custom-orders.store') }}" class="create-form" enctype="multipart/form-data">
        @csrf

        <div class="form-grid">
            {{-- Left Column --}}
            <div class="form-main">
                {{-- Customer Information --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Customer Information</h3>
                    </div>

                    <div class="form-group">
                        <label for="user_id">Customer <span class="required">*</span></label>
                        <select name="user_id" id="user_id" class="form-select @error('user_id') is-invalid @enderror">
                            <option value="">Select Customer</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="customer_name">Customer Name</label>
                            <input type="text" name="customer_name" id="customer_name" 
                                   class="form-input @error('customer_name') is-invalid @enderror"
                                   value="{{ old('customer_name') }}" placeholder="Enter customer name">
                            @error('customer_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_email">Customer Email</label>
                            <input type="email" name="customer_email" id="customer_email" 
                                   class="form-input @error('customer_email') is-invalid @enderror"
                                   value="{{ old('customer_email') }}" placeholder="Enter customer email">
                            @error('customer_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" name="customer_phone" id="customer_phone" 
                               class="form-input @error('customer_phone') is-invalid @enderror"
                               value="{{ old('customer_phone') }}" placeholder="Enter customer phone">
                        @error('customer_phone')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Product Details --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Product Details</h3>
                    </div>

                    <div class="form-group">
                        <label for="product_name">Product Name <span class="required">*</span></label>
                        <input type="text" name="product_name" id="product_name" 
                               class="form-input @error('product_name') is-invalid @enderror"
                               value="{{ old('product_name') }}" placeholder="Enter product name" required>
                        @error('product_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="form-input @error('description') is-invalid @enderror"
                                  placeholder="Enter product description">{{ old('description') }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="quantity">Quantity <span class="required">*</span></label>
                            <input type="number" name="quantity" id="quantity" 
                                   class="form-input @error('quantity') is-invalid @enderror"
                                   value="{{ old('quantity', 1) }}" min="1" required>
                            @error('quantity')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_price">Total Price (Rs.) <span class="required">*</span></label>
                            <input type="number" name="total_price" id="total_price" 
                                   class="form-input @error('total_price') is-invalid @enderror"
                                   value="{{ old('total_price') }}" step="0.01" min="0" required>
                            @error('total_price')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image</label>
                        <input type="file" name="image" id="image" 
                               class="form-input @error('image') is-invalid @enderror"
                               accept="image/*">
                        @error('image')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                        <small class="form-help">Upload a product image (JPG, PNG, WebP - Max 2MB)</small>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Product Image URL</label>
                        <input type="url" name="image_url" id="image_url" 
                               class="form-input @error('image_url') is-invalid @enderror"
                               value="{{ old('image_url') }}" placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="imagePreview" style="display:none; margin-top:12px;">
                        <img src="" alt="Preview" style="max-width:200px; max-height:200px; border-radius:8px; border:1px solid var(--admin-border);">
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="form-sidebar">
                {{-- Status & Priority --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Order Details</h3>
                    </div>

                    <div class="form-group">
                        <label for="status">Status <span class="required">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                            <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="review" {{ old('status') == 'review' ? 'selected' : '' }}>Under Review</option>
                            <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                            <option value="low" {{ old('priority', 'low') == 'low' ? 'selected' : '' }}>🟢 Low</option>
                            <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>🟠 High</option>
                            <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>🔴 Urgent</option>
                        </select>
                        @error('priority')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Specifications --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Specifications</h3>
                        <button type="button" onclick="addSpecification()" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-plus"></i> Add
                        </button>
                    </div>
                    <div id="specifications-container">
                        <div class="spec-empty">
                            <p class="text-muted">No specifications added yet</p>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Additional Notes</h3>
                    </div>
                    <div class="form-group">
                        <textarea name="notes" id="notes" rows="4" 
                                  class="form-input @error('notes') is-invalid @enderror"
                                  placeholder="Add any additional notes...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa-regular fa-floppy-disk"></i> Create Order
                    </button>
                    <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fa-solid fa-xmark"></i> Cancel
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@push('styles')
<style>
    .create-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .create-header-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .form-main {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-sidebar {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #493b35;
        margin-bottom: 5px;
    }

    .form-group .required {
        color: #a44f55;
    }

    .form-help {
        display: block;
        font-size: 12px;
        color: #9a887e;
        margin-top: 4px;
    }

    .form-input,
    .form-select {
        width: 100%;
        padding: 10px 14px;
        border: 1px solid var(--admin-border);
        border-radius: 8px;
        font-size: 14px;
        background: white;
        transition: border-color 0.2s, box-shadow 0.2s;
        color: #493b35;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: var(--admin-pink);
        box-shadow: 0 0 0 3px rgba(185, 109, 112, 0.1);
    }

    .form-input.is-invalid,
    .form-select.is-invalid {
        border-color: #a44f55;
    }

    .error-message {
        display: block;
        font-size: 12px;
        color: #a44f55;
        margin-top: 4px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    .spec-row {
        display: flex;
        gap: 8px;
        margin-bottom: 8px;
        align-items: center;
    }

    .spec-row .spec-key {
        flex: 0 0 40%;
    }

    .spec-row .spec-value {
        flex: 1;
    }

    .spec-empty {
        text-align: center;
        padding: 20px;
        color: #9a887e;
        font-size: 13px;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 5px;
    }

    .btn-lg {
        padding: 12px 24px;
        font-size: 15px;
        border-radius: 10px;
        flex: 1;
        justify-content: center;
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
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(185, 109, 112, 0.3);
    }

    .btn-secondary {
        background: #faf5f0;
        color: #493b35;
        border: 1px solid var(--admin-border);
    }

    .btn-secondary:hover {
        background: #f5ede8;
        transform: translateY(-2px);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
    }

    .btn-icon {
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
        background: transparent;
        color: #685951;
    }

    .btn-delete:hover {
        background: #fceaea;
        color: #a44f55;
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

    @media (max-width: 992px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .create-header {
            flex-direction: column;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-actions {
            flex-direction: column;
        }
        
        .spec-row {
            flex-wrap: wrap;
        }
        
        .spec-row .spec-key,
        .spec-row .spec-value {
            flex: 1 1 100%;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    let specCount = 0;

    function addSpecification() {
        const container = document.getElementById('specifications-container');
        const empty = document.querySelector('.spec-empty');
        
        const row = document.createElement('div');
        row.className = 'spec-row';
        row.innerHTML = `
            <input type="text" name="spec_keys[]" class="form-input spec-key" placeholder="Key">
            <input type="text" name="spec_values[]" class="form-input spec-value" placeholder="Value">
            <button type="button" onclick="removeSpec(this)" class="btn-icon btn-delete">
                <i class="fa-regular fa-trash-can"></i>
            </button>
        `;
        
        container.appendChild(row);
        if (empty) {
            empty.remove();
        }
    }

    function removeSpec(button) {
        const row = button.closest('.spec-row');
        row.remove();
        
        const container = document.getElementById('specifications-container');
        if (container.children.length === 0) {
            container.innerHTML = `
                <div class="spec-empty">
                    <p class="text-muted">No specifications added yet</p>
                </div>
            `;
        }
    }

    // Image preview
    document.getElementById('image')?.addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        const img = preview.querySelector('img');
        
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@endpush