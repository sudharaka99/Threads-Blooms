{{-- resources/views/partials/product-card.blade.php --}}
<div class="product-card">
    <a href="{{ url('/products') }}">
        <div class="product-image">
            <span class="wishlist">
                <i class="fa-regular fa-heart"></i>
            </span>
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
        </div>
    </a>
    <div class="product-info">
        <div class="product-category">Handmade</div>
        <h3>{{ $product->name }}</h3>
        <div class="product-type">{{ $product->type }}</div>
        <div class="product-bottom">
            <div class="price">Rs. {{ number_format($product->price) }}</div>
            <a href="{{ url('/products') }}" class="view-btn">View →</a>
        </div>
    </div>
</div>