@extends('layouts.app')

@section('title', 'Customize Your Product')
@section('meta_description', 'Design your own custom product with Threads & Blooms')

@section('content')

<div class="customize-page">
    <div class="container">
        <div class="customize-header">
            <div class="customize-header-content">
                <span class="customize-badge">✨ Custom Design</span>
                <h1>Design Your Own Product</h1>
                <p>Create something unique and special. Tell us your vision and we'll bring it to life.</p>
            </div>
            <div class="customize-progress">
                <div class="progress-step active">
                    <div class="step-number">1</div>
                    <span>Design</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="step-number">2</div>
                    <span>Review</span>
                </div>
                <div class="progress-line"></div>
                <div class="progress-step">
                    <div class="step-number">3</div>
                    <span>Confirm</span>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('customize.store') }}" 
              class="customize-form" 
              enctype="multipart/form-data"
              id="customizeForm">
            @csrf

            <div class="customize-grid">
                {{-- Left Column - Design Form --}}
                <div class="customize-main">
                    {{-- Product Selection --}}
                    <div class="design-section">
                        <h3><i class="fa-solid fa-shirt"></i> Product Type</h3>
                        
                        {{-- Check if products exist and is not empty --}}
                        @if(isset($products) && $products->count() > 0)
                            <div class="product-grid">
                                @foreach($products as $product)
                                <div class="product-option" 
                                     data-price="{{ $product->price ?? 0 }}"
                                     data-name="{{ $product->name ?? $product->product_name ?? 'Product' }}">
                                    <input type="radio" name="product_id" id="product_{{ $product->id }}" 
                                           value="{{ $product->id }}" 
                                           {{ old('product_id') == $product->id ? 'checked' : '' }}
                                           onchange="updateEstimate()">
                                    <label for="product_{{ $product->id }}">
                                        @if(isset($product->image) && $product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name ?? 'Product' }}">
                                        @else
                                            <div class="product-placeholder">
                                                <i class="fa-solid fa-shirt"></i>
                                            </div>
                                        @endif
                                        <span class="product-name">{{ $product->name ?? $product->product_name ?? 'Product' }}</span>
                                        <span class="product-price">Rs. {{ number_format($product->price ?? 0, 2) }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        @else
                            {{-- Fallback: Show default product options if no products in database --}}
                            <div class="product-grid">
                                <div class="product-option" data-price="500" data-name="Custom Design">
                                    <input type="radio" name="product_id" id="product_default" value="" checked onchange="updateEstimate()">
                                    <label for="product_default">
                                        <div class="product-placeholder">
                                            <i class="fa-solid fa-shirt"></i>
                                        </div>
                                        <span class="product-name">Custom Design</span>
                                        <span class="product-price">Rs. 500.00</span>
                                    </label>
                                </div>
                                <div class="product-option" data-price="750" data-name="Premium Custom">
                                    <input type="radio" name="product_id" id="product_premium" value="" onchange="updateEstimate()">
                                    <label for="product_premium">
                                        <div class="product-placeholder">
                                            <i class="fa-solid fa-crown"></i>
                                        </div>
                                        <span class="product-name">Premium Custom</span>
                                        <span class="product-price">Rs. 750.00</span>
                                    </label>
                                </div>
                            </div>
                        @endif
                        @error('product_id')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Product Name (Custom) --}}
                    <div class="design-section">
                        <h3><i class="fa-regular fa-pen-to-square"></i> Product Name</h3>
                        <div class="form-group">
                            <label for="product_name">What would you like to call this? <span class="required">*</span></label>
                            <input type="text" name="product_name" id="product_name" 
                                   class="form-input @error('product_name') is-invalid @enderror"
                                   value="{{ old('product_name') }}" 
                                   placeholder="e.g., Custom Floral Dress" required>
                            @error('product_name')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="design-section">
                        <h3><i class="fa-regular fa-file-lines"></i> Describe Your Design</h3>
                        <div class="form-group">
                            <label for="description">Tell us about your vision <span class="required">*</span></label>
                            <textarea name="description" id="description" rows="5" 
                                      class="form-input @error('description') is-invalid @enderror"
                                      placeholder="Describe your design in detail...">{{ old('description') }}</textarea>
                            <small class="form-help">Be as detailed as possible about colors, patterns, style, and any specific features you want.</small>
                            @error('description')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Customization Options --}}
                    <div class="design-section">
                        <h3><i class="fa-solid fa-sliders"></i> Customization Options</h3>
                        <div class="customization-grid">
                            <div class="form-group">
                                <label for="size">Size</label>
                                <select name="size" id="size" class="form-select" onchange="updateEstimate()">
                                    <option value="">Select Size</option>
                                    @foreach($customizationOptions['sizes'] ?? ['XS', 'S', 'M', 'L', 'XL', 'XXL'] as $size)
                                    <option value="{{ $size }}" {{ old('size') == $size ? 'selected' : '' }}>
                                        {{ $size }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="color">Color</label>
                                <select name="color" id="color" class="form-select" onchange="updateEstimate()">
                                    <option value="">Select Color</option>
                                    @foreach($customizationOptions['colors'] ?? [] as $color)
                                    <option value="{{ $color['name'] }}" {{ old('color') == $color['name'] ? 'selected' : '' }}>
                                        {{ $color['name'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="material">Material</label>
                                <select name="material" id="material" class="form-select" onchange="updateEstimate()">
                                    <option value="">Select Material</option>
                                    @foreach($customizationOptions['materials'] ?? ['Cotton', 'Polyester', 'Linen', 'Silk', 'Wool', 'Denim'] as $material)
                                    <option value="{{ $material }}" {{ old('material') == $material ? 'selected' : '' }}>
                                        {{ $material }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="style">Style</label>
                                <select name="style" id="style" class="form-select" onchange="updateEstimate()">
                                    <option value="">Select Style</option>
                                    @foreach($customizationOptions['styles'] ?? ['Classic', 'Modern', 'Vintage', 'Minimalist', 'Boho'] as $style)
                                    <option value="{{ $style }}" {{ old('style') == $style ? 'selected' : '' }}>
                                        {{ $style }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Additional Details --}}
                    <div class="design-section">
                        <h3><i class="fa-regular fa-message"></i> Additional Details</h3>
                        <div class="form-group">
                            <label for="customization_details">Tell us more</label>
                            <textarea name="customization_details" id="customization_details" rows="3" 
                                      class="form-input @error('customization_details') is-invalid @enderror"
                                      placeholder="Any specific requirements, patterns, embroidery details, etc.">{{ old('customization_details') }}</textarea>
                            @error('customization_details')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="special_instructions">Special Instructions</label>
                            <textarea name="special_instructions" id="special_instructions" rows="2" 
                                      class="form-input @error('special_instructions') is-invalid @enderror"
                                      placeholder="Any special delivery instructions or preferences...">{{ old('special_instructions') }}</textarea>
                            @error('special_instructions')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Reference Images --}}
                    <div class="design-section">
                        <h3><i class="fa-regular fa-image"></i> Reference Images</h3>
                        <div class="form-group">
                            <label for="reference_images">Upload reference images</label>
                            <div class="file-upload-area" id="fileUploadArea">
                                <div class="file-upload-content">
                                    <i class="fa-regular fa-cloud-arrow-up"></i>
                                    <p>Drag & drop images here or click to browse</p>
                                    <small>Max 5 images, 2MB each (JPG, PNG, WebP)</small>
                                </div>
                                <input type="file" name="reference_images[]" id="reference_images" 
                                       class="file-input" multiple accept="image/*"
                                       onchange="handleFileUpload(this)">
                            </div>
                            <div id="imagePreviewContainer" class="image-preview-container"></div>
                            @error('reference_images.*')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Right Column - Summary --}}
                <div class="customize-sidebar">
                    <div class="summary-card sticky">
                        <h3>Order Summary</h3>
                        
                        <div class="summary-product">
                            <div class="product-preview" id="productPreview">
                                <div class="preview-placeholder">
                                    <i class="fa-solid fa-shirt"></i>
                                    <span>Your Design</span>
                                </div>
                            </div>
                            <div class="product-details-summary">
                                <h4 id="summaryName">Custom Product</h4>
                                <p id="summaryDescription">Your unique design</p>
                            </div>
                        </div>

                        <div class="summary-details">
                            <div class="summary-row">
                                <span>Quantity</span>
                                <div class="quantity-control">
                                    <button type="button" onclick="changeQuantity(-1)" class="qty-btn">-</button>
                                    <input type="number" name="quantity" id="quantity" 
                                           value="{{ old('quantity', 1) }}" min="1" max="100"
                                           onchange="updateEstimate()">
                                    <button type="button" onclick="changeQuantity(1)" class="qty-btn">+</button>
                                </div>
                            </div>
                            <div class="summary-row">
                                <span>Size</span>
                                <span id="summarySize">-</span>
                            </div>
                            <div class="summary-row">
                                <span>Color</span>
                                <span id="summaryColor">-</span>
                            </div>
                            <div class="summary-row">
                                <span>Material</span>
                                <span id="summaryMaterial">-</span>
                            </div>
                            <div class="summary-row">
                                <span>Style</span>
                                <span id="summaryStyle">-</span>
                            </div>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="summary-pricing">
                            <div id="priceBreakdown">
                                <div class="price-row">
                                    <span>Base Price</span>
                                    <span id="basePrice">Rs. 500.00</span>
                                </div>
                            </div>
                            <div class="summary-divider"></div>
                            <div class="price-row total">
                                <span>Estimated Total</span>
                                <span id="estimatedTotal">Rs. 500.00</span>
                            </div>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="form-group">
                            <label for="delivery_date">Preferred Delivery Date</label>
                            <input type="date" name="delivery_date" id="delivery_date" 
                                   class="form-input" min="{{ date('Y-m-d', strtotime('+7 days')) }}"
                                   value="{{ old('delivery_date') }}">
                        </div>

                        <input type="hidden" name="estimated_price" id="estimatedPrice" value="500">

                        <button type="submit" class="btn btn-primary btn-submit">
                            <i class="fa-solid fa-paper-plane"></i>
                            Submit Custom Order
                        </button>

                        <p class="summary-note">
                            <i class="fa-regular fa-circle-check"></i>
                            We'll review your design and get back to you within 24 hours
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
    .customize-page {
        padding: 40px 0 60px;
        background: #f8f6f4;
        min-height: 100vh;
    }

    .customize-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .customize-badge {
        display: inline-block;
        background: #fbe1df;
        color: #b96d70;
        padding: 4px 16px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 12px;
    }

    .customize-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        color: #3d302b;
        margin-bottom: 8px;
    }

    .customize-header p {
        font-size: 16px;
        color: #9a887e;
    }

    .customize-progress {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 400px;
        margin: 24px auto 0;
    }

    .progress-step {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #9a887e;
        opacity: 0.5;
        transition: all 0.3s;
    }

    .progress-step.active {
        opacity: 1;
        color: #493b35;
        font-weight: 600;
    }

    .step-number {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #eadbd0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .progress-step.active .step-number {
        background: #b96d70;
        color: white;
    }

    .progress-line {
        width: 40px;
        height: 2px;
        background: #eadbd0;
        margin: 0 10px;
    }

    .customize-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 32px;
        align-items: start;
    }

    .customize-main {
        display: flex;
        flex-direction: column;
        gap: 28px;
    }

    .design-section {
        background: white;
        border-radius: 16px;
        padding: 24px 28px;
        border: 1px solid #eadbd0;
    }

    .design-section h3 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #3d302b;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .design-section h3 i {
        color: #b96d70;
        font-size: 18px;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 16px;
    }

    .product-option input[type="radio"] {
        display: none;
    }

    .product-option label {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 16px 12px;
        border: 2px solid #eadbd0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
        text-align: center;
        height: 100%;
    }

    .product-option input[type="radio"]:checked + label {
        border-color: #b96d70;
        background: #fbe1df;
    }

    .product-option label:hover {
        border-color: #e8a4a5;
    }

    .product-option label img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 8px;
    }

    .product-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        background: #f5f0eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: #c4a68a;
        margin-bottom: 8px;
    }

    .product-name {
        font-weight: 600;
        font-size: 13px;
        color: #493b35;
    }

    .product-price {
        font-size: 12px;
        color: #b96d70;
        font-weight: 600;
    }

    .customization-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
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
        border: 1px solid #eadbd0;
        border-radius: 8px;
        font-size: 14px;
        background: white;
        transition: all 0.2s;
        color: #493b35;
    }

    .form-input:focus,
    .form-select:focus {
        outline: none;
        border-color: #e8a4a5;
        box-shadow: 0 0 0 3px rgba(185, 109, 112, 0.1);
    }

    .form-input.is-invalid {
        border-color: #a44f55;
    }

    .error-message {
        display: block;
        font-size: 12px;
        color: #a44f55;
        margin-top: 4px;
    }

    .file-upload-area {
        border: 2px dashed #eadbd0;
        border-radius: 12px;
        padding: 30px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: #e8a4a5;
        background: #faf5f0;
    }

    .file-upload-content i {
        font-size: 36px;
        color: #e8a4a5;
    }

    .file-upload-content p {
        margin: 8px 0 4px;
        color: #493b35;
        font-weight: 500;
    }

    .file-upload-content small {
        color: #9a887e;
        font-size: 12px;
    }

    .file-input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .image-preview-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .image-preview-item {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        aspect-ratio: 1;
    }

    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-item .remove-image {
        position: absolute;
        top: 4px;
        right: 4px;
        background: rgba(0,0,0,0.6);
        color: white;
        border: none;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        cursor: pointer;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .image-preview-item .remove-image:hover {
        background: rgba(200, 0, 0, 0.8);
    }

    /* Sidebar */
    .customize-sidebar {
        position: sticky;
        top: 100px;
    }

    .summary-card {
        background: white;
        border-radius: 16px;
        padding: 24px 28px;
        border: 1px solid #eadbd0;
    }

    .summary-card h3 {
        font-family: 'Playfair Display', serif;
        font-size: 20px;
        color: #3d302b;
        margin-bottom: 18px;
    }

    .summary-product {
        display: flex;
        gap: 16px;
        align-items: center;
        padding-bottom: 16px;
        border-bottom: 1px solid #eadbd0;
        margin-bottom: 16px;
    }

    .product-preview {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        background: #f5f0eb;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .product-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #c4a68a;
        font-size: 12px;
    }

    .preview-placeholder i {
        font-size: 28px;
        margin-bottom: 4px;
    }

    .product-details-summary h4 {
        font-size: 15px;
        color: #3d302b;
        margin: 0 0 2px;
    }

    .product-details-summary p {
        font-size: 13px;
        color: #9a887e;
        margin: 0;
    }

    .summary-details {
        margin-bottom: 16px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 6px 0;
        font-size: 14px;
        color: #685951;
        align-items: center;
    }

    .quantity-control {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .qty-btn {
        width: 28px;
        height: 28px;
        border: 1px solid #eadbd0;
        border-radius: 6px;
        background: white;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: #fbe1df;
        border-color: #e8a4a5;
    }

    .quantity-control input {
        width: 40px;
        text-align: center;
        border: 1px solid #eadbd0;
        border-radius: 6px;
        padding: 4px;
        font-size: 14px;
    }

    .quantity-control input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }

    .summary-divider {
        border-top: 1px solid #eadbd0;
        margin: 12px 0;
    }

    .summary-pricing {
        margin-bottom: 16px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        padding: 4px 0;
        font-size: 14px;
        color: #685951;
    }

    .price-row.total {
        font-weight: 700;
        font-size: 18px;
        color: #3d302b;
    }

    .btn-submit {
        width: 100%;
        padding: 14px;
        font-size: 16px;
        border-radius: 10px;
        margin-top: 8px;
        justify-content: center;
    }

    .btn-primary {
        background: #b96d70;
        color: white;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-primary:hover {
        background: #a86264;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(185, 109, 112, 0.3);
    }

    .summary-note {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #9a887e;
        margin-top: 12px;
        text-align: center;
        justify-content: center;
    }

    .summary-note i {
        color: #b96d70;
    }

    .sticky {
        position: sticky;
        top: 100px;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .customize-grid {
            grid-template-columns: 1fr;
        }
        
        .customize-sidebar {
            position: static;
        }
        
        .sticky {
            position: static;
        }
    }

    @media (max-width: 768px) {
        .customize-header h1 {
            font-size: 28px;
        }
        
        .customization-grid {
            grid-template-columns: 1fr;
        }
        
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
        
        .design-section {
            padding: 18px 16px;
        }
        
        .summary-card {
            padding: 18px 16px;
        }
        
        .customize-progress {
            max-width: 300px;
        }
        
        .progress-step span {
            font-size: 12px;
        }
        
        .progress-line {
            width: 20px;
        }
    }

    @media (max-width: 480px) {
        .product-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .image-preview-container {
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Update summary based on selections
    document.addEventListener('DOMContentLoaded', function() {
        // Update on select changes
        document.querySelectorAll('select[name="size"], select[name="color"], select[name="material"], select[name="style"]').forEach(el => {
            el.addEventListener('change', updateSummary);
        });

        // Update on product selection
        document.querySelectorAll('input[name="product_id"]').forEach(el => {
            el.addEventListener('change', function() {
                const label = this.closest('.product-option')?.querySelector('label');
                if (label) {
                    const name = label.querySelector('.product-name')?.textContent || 'Custom Product';
                    document.getElementById('summaryName').textContent = name;
                    
                    const price = label.querySelector('.product-price')?.textContent || 'Rs. 500.00';
                    document.getElementById('basePrice').textContent = price;
                }
                updateEstimate();
            });
        });

        // Update on description change
        document.getElementById('description')?.addEventListener('input', function() {
            const desc = this.value || 'Your unique design';
            document.getElementById('summaryDescription').textContent = desc.substring(0, 50) + (desc.length > 50 ? '...' : '');
        });

        // Update on product name change
        document.getElementById('product_name')?.addEventListener('input', function() {
            const name = this.value || 'Custom Product';
            document.getElementById('summaryName').textContent = name;
        });

        // Initial update
        updateSummary();
        updateEstimate();

        // File upload preview
        const fileInput = document.getElementById('reference_images');
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                handleFileUpload(this);
            });
        }
    });

    function updateSummary() {
        const size = document.getElementById('size')?.value || '-';
        const color = document.getElementById('color')?.value || '-';
        const material = document.getElementById('material')?.value || '-';
        const style = document.getElementById('style')?.value || '-';

        document.getElementById('summarySize').textContent = size;
        document.getElementById('summaryColor').textContent = color;
        document.getElementById('summaryMaterial').textContent = material;
        document.getElementById('summaryStyle').textContent = style;
    }

    function changeQuantity(delta) {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value) + delta;
        if (value < 1) value = 1;
        if (value > 100) value = 100;
        input.value = value;
        updateEstimate();
    }

    function updateEstimate() {
        // Get selected product price
        let basePrice = 500;
        const selectedProduct = document.querySelector('input[name="product_id"]:checked');
        if (selectedProduct) {
            const option = selectedProduct.closest('.product-option');
            if (option) {
                const price = option.dataset.price;
                if (price) {
                    basePrice = parseFloat(price);
                }
            }
        }

        // Get quantity
        const quantity = parseInt(document.getElementById('quantity')?.value || 1);

        // Size adjustment
        const sizeMultiplier = {
            'XS': 0.9,
            'S': 1.0,
            'M': 1.0,
            'L': 1.1,
            'XL': 1.2,
            'XXL': 1.3
        };
        const size = document.getElementById('size')?.value || 'M';
        const sizeAdjustment = sizeMultiplier[size] || 1.0;
        const sizePrice = basePrice * (sizeAdjustment - 1);

        // Material adjustment
        const materialPrices = {
            'Cotton': 0,
            'Polyester': 50,
            'Linen': 100,
            'Silk': 250,
            'Wool': 150,
            'Denim': 75
        };
        const material = document.getElementById('material')?.value || 'Cotton';
        const materialPrice = materialPrices[material] || 0;

        // Custom design fee
        const customizationDetails = document.getElementById('customization_details')?.value || '';
        const designFee = customizationDetails.length > 50 ? 200 : 0;

        // Calculate total
        const subtotal = basePrice + sizePrice + materialPrice + designFee;
        const total = subtotal * quantity;

        // Update display
        document.getElementById('estimatedTotal').textContent = 'Rs. ' + total.toFixed(2);
        document.getElementById('estimatedPrice').value = total;

        // Update breakdown
        const breakdownContainer = document.getElementById('priceBreakdown');
        let html = `<div class="price-row"><span>Base Price</span><span>Rs. ${basePrice.toFixed(2)}</span></div>`;
        
        if (sizePrice > 0) {
            html += `<div class="price-row"><span>Size: ${size}</span><span>Rs. ${sizePrice.toFixed(2)}</span></div>`;
        }
        if (materialPrice > 0) {
            html += `<div class="price-row"><span>Material: ${material}</span><span>Rs. ${materialPrice.toFixed(2)}</span></div>`;
        }
        if (designFee > 0) {
            html += `<div class="price-row"><span>Custom Design Fee</span><span>Rs. ${designFee.toFixed(2)}</span></div>`;
        }
        
        html += `<div class="summary-divider"></div>`;
        html += `<div class="price-row"><span>Quantity</span><span>× ${quantity}</span></div>`;
        
        breakdownContainer.innerHTML = html;
    }

    function handleFileUpload(input) {
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        if (input.files) {
            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'image-preview-item';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Reference ${index + 1}">
                        <button type="button" class="remove-image" onclick="removeImage(this, ${index})">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    `;
                    container.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    }

    function removeImage(button, index) {
        const item = button.closest('.image-preview-item');
        item.remove();

        // Remove from file input
        const input = document.getElementById('reference_images');
        const dt = new DataTransfer();
        const files = input.files;
        
        for (let i = 0; i < files.length; i++) {
            if (i !== index) {
                dt.items.add(files[i]);
            }
        }
        
        input.files = dt.files;
    }

    // Drag and drop support
    const fileUploadArea = document.getElementById('fileUploadArea');
    if (fileUploadArea) {
        ['dragenter', 'dragover'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                fileUploadArea.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileUploadArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                fileUploadArea.classList.remove('dragover');
            });
        });

        fileUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            const input = document.getElementById('reference_images');
            input.files = e.dataTransfer.files;
            handleFileUpload(input);
        });
    }
</script>
@endpush