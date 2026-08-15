@extends('layouts.admin')

@section('title', 'Edit Custom Order #' . str_pad($customOrder->id, 6, '0', STR_PAD_LEFT))
@section('page-title', 'Edit Custom Order')

@section('content')

<div class="edit-header">
    <div>
        <span class="dashboard-eyebrow">Editing</span>
        <h2>Custom Order #{{ str_pad($customOrder->id, 6, '0', STR_PAD_LEFT) }}</h2>
        <p>Update the custom order details below</p>
    </div>
    <div class="edit-header-actions">
        <a href="{{ route('admin.custom-orders.show', $customOrder) }}" class="btn btn-secondary">
            <i class="fa-regular fa-eye"></i> View Order
        </a>
        <a href="{{ route('admin.custom-orders.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left"></i> Back to List
        </a>
    </div>
</div>

<div class="edit-form-container">
    <form method="POST" action="{{ route('admin.custom-orders.update', $customOrder) }}" class="edit-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                            <option value="{{ $user->id }}" {{ old('user_id', $customOrder->user_id) == $user->id ? 'selected' : '' }}>
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
                                   value="{{ old('customer_name', $customOrder->customer_name) }}" placeholder="Enter customer name">
                            @error('customer_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="customer_email">Customer Email</label>
                            <input type="email" name="customer_email" id="customer_email" 
                                   class="form-input @error('customer_email') is-invalid @enderror"
                                   value="{{ old('customer_email', $customOrder->customer_email) }}" placeholder="Enter customer email">
                            @error('customer_email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="customer_phone">Customer Phone</label>
                        <input type="text" name="customer_phone" id="customer_phone" 
                               class="form-input @error('customer_phone') is-invalid @enderror"
                               value="{{ old('customer_phone', $customOrder->customer_phone) }}" placeholder="Enter customer phone">
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
                               value="{{ old('product_name', $customOrder->product_name) }}" placeholder="Enter product name" required>
                        @error('product_name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="4" 
                                  class="form-input @error('description') is-invalid @enderror"
                                  placeholder="Enter product description">{{ old('description', $customOrder->description) }}</textarea>
                        @error('description')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="quantity">Quantity <span class="required">*</span></label>
                            <input type="number" name="quantity" id="quantity" 
                                   class="form-input @error('quantity') is-invalid @enderror"
                                   value="{{ old('quantity', $customOrder->quantity) }}" min="1" required>
                            @error('quantity')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="total_price">Total Price (Rs.) <span class="required">*</span></label>
                            <input type="number" name="total_price" id="total_price" 
                                   class="form-input @error('total_price') is-invalid @enderror"
                                   value="{{ old('total_price', $customOrder->total_price) }}" step="0.01" min="0" required>
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
                               value="{{ old('image_url', $customOrder->image_url) }}" placeholder="https://example.com/image.jpg">
                        @error('image_url')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($customOrder->image_url)
                    <div class="image-preview">
                        <img src="{{ $customOrder->image_url }}" alt="Product Image" class="preview-image">
                        <button type="button" onclick="removeImage()" class="btn btn-danger btn-sm">Remove Image</button>
                    </div>
                    @endif

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
                            <option value="pending" {{ old('status', $customOrder->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $customOrder->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="review" {{ old('status', $customOrder->status) == 'review' ? 'selected' : '' }}>Under Review</option>
                            <option value="approved" {{ old('status', $customOrder->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="completed" {{ old('status', $customOrder->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ old('status', $customOrder->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        @error('status')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="priority">Priority</label>
                        <select name="priority" id="priority" class="form-select @error('priority') is-invalid @enderror">
                            <option value="low" {{ old('priority', $customOrder->priority) == 'low' ? 'selected' : '' }}>🟢 Low</option>
                            <option value="medium" {{ old('priority', $customOrder->priority) == 'medium' ? 'selected' : '' }}>🟡 Medium</option>
                            <option value="high" {{ old('priority', $customOrder->priority) == 'high' ? 'selected' : '' }}>🟠 High</option>
                            <option value="urgent" {{ old('priority', $customOrder->priority) == 'urgent' ? 'selected' : '' }}>🔴 Urgent</option>
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
                        @php
                            $specs = json_decode($customOrder->specifications, true) ?? [];
                        @endphp
                        @foreach($specs as $key => $value)
                        <div class="spec-row">
                            <input type="text" name="spec_keys[]" class="form-input spec-key" 
                                   placeholder="Key" value="{{ $key }}">
                            <input type="text" name="spec_values[]" class="form-input spec-value" 
                                   placeholder="Value" value="{{ $value }}">
                            <button type="button" onclick="removeSpec(this)" class="btn-icon btn-delete">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    <div class="spec-empty {{ count($specs) > 0 ? 'hidden' : '' }}">
                        <p class="text-muted">No specifications added yet</p>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="admin-panel">
                    <div class="panel-header">
                        <h3>Notes</h3>
                    </div>
                    <div class="form-group">
                        <textarea name="notes" id="notes" rows="4" 
                                  class="form-input @error('notes') is-invalid @enderror"
                                  placeholder="Add any additional notes...">{{ old('notes', $customOrder->notes) }}</textarea>
                        @error('notes')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Submit Buttons --}}
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fa-regular fa-floppy-disk"></i> Update Order
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
    .edit-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .edit-header-actions {
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

    .spec-empty.hidden {
        display: none;
    }

    .image-preview {
        margin-top: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .preview-image {
        max-width: 150px;
        max-height: 150px;
        border-radius: 8px;
        border: 1px solid var(--admin-border);
        object-fit: contain;
    }

    .form-actions {
        display: flex;
        gap: 10px;
        margin-top: 5px;
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

    .btn-danger {
        background: #fceaea;
        color: #a44f55;
        border: 1px solid #f0cfd1;
    }

    .btn-danger:hover {
        background: #f5d5d5;
        color: #8a3a40;
    }

    .btn-lg {
        padding: 12px 24px;
        font-size: 15px;
        border-radius: 10px;
        flex: 1;
        justify-content: center;
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

    .hidden {
        display: none !important;
    }

    @media (max-width: 992px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .edit-header {
            flex-direction: column;
        }
        
        .edit-header-actions {
            width: 100%;
        }
        
        .edit-header-actions .btn {
            flex: 1;
            justify-content: center;
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
    let specCount = {{ count(json_decode($customOrder->specifications, true) ?? []) }};

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
            empty.classList.add('hidden');
        }
    }

    function removeSpec(button) {
        const row = button.closest('.spec-row');
        row.remove();
        
        const container = document.getElementById('specifications-container');
        const empty = document.querySelector('.spec-empty');
        if (container.children.length === 0 && empty) {
            empty.classList.remove('hidden');
        }
    }

    function removeImage() {
        if (confirm('Remove the current image?')) {
            document.getElementById('image_url').value = '';
            document.querySelector('.image-preview').style.display = 'none';
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