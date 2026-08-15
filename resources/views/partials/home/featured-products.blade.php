{{-- resources/views/partials/home/featured-products.blade.php --}}
<section class="section featured">
    <div class="container">
        <div class="section-heading">
            <div class="eyebrow">Our Favourites</div>
            <h2>Featured Products</h2>
            <p>A few of our most-loved handmade creations.</p>
        </div>

        @if($featuredProducts->count() > 0)
            <div class="product-grid">
                @foreach($featuredProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @elseif(isset($demoProducts) && $demoProducts->count() > 0)
            <div class="product-grid">
                @foreach($demoProducts as $product)
                    @include('partials.product-card', ['product' => $product])
                @endforeach
            </div>
        @else
            <div class="product-grid">
                @php
                    // Fallback inline demo products
                    $fallbackProducts = [
                        ['name' => 'Floral Bouquet', 'type' => 'Cross-Stitch Pattern', 'price' => 1200, 'image' => 'products/floral-bouquet.jpg'],
                        ['name' => 'Sleepy Cat', 'type' => 'Cross-Stitch Pattern', 'price' => 1200, 'image' => 'products/sleepy-cat.jpg'],
                        ['name' => 'Lavender Dreams', 'type' => 'Cross-Stitch Pattern', 'price' => 1200, 'image' => 'products/lavender-dreams.jpg'],
                        ['name' => 'Floral Vine', 'type' => 'Embroidered T-Shirt', 'price' => 2400, 'image' => 'products/floral-vine.jpg'],
                        ['name' => 'Wild Flowers', 'type' => 'Embroidered T-Shirt', 'price' => 2400, 'image' => 'products/wild-flowers.jpg'],
                        ['name' => 'Initial Bloom', 'type' => 'Embroidered T-Shirt', 'price' => 2400, 'image' => 'products/initial-bloom.jpg'],
                    ];
                @endphp

                @foreach($fallbackProducts as $product)
                    <div class="product-card">
                        <a href="{{ url('/products') }}">
                            <div class="product-image">
                                <span class="wishlist">
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                                <img src="{{ asset('images/' . $product['image']) }}" alt="{{ $product['name'] }}" loading="lazy" decoding="async">
                            </div>
                        </a>
                        <div class="product-info">
                            <div class="product-category">Handmade</div>
                            <h3>{{ $product['name'] }}</h3>
                            <div class="product-type">{{ $product['type'] }}</div>
                            <div class="product-bottom">
                                <div class="price">Rs. {{ number_format($product['price']) }}</div>
                                <a href="{{ url('/products') }}" class="view-btn">View →</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="view-all">
            <a href="{{ url('/products') }}" class="btn btn-outline">
                View All Products <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>