{{-- resources/views/partials/home/categories.blade.php --}}
<section class="section categories">
    <div class="container">
        <div class="section-heading">
            <div class="eyebrow">Explore Our Collection</div>
            <h2>Shop by Category</h2>
            <p>Find something beautiful for yourself or someone special.</p>
        </div>

        <div class="category-grid">
            @php
                $categories = [
                    ['name' => 'Cross-Stitch', 'slug' => 'cross-stitch', 'image' => 'cross-stitch.jpg', 'desc' => 'Handmade patterns'],
                    ['name' => 'Embroidered T-Shirts', 'slug' => 'tshirts', 'image' => 'tshirts.jpg', 'desc' => 'Wear your story'],
                    ['name' => 'Jewellery', 'slug' => 'jewellery', 'image' => 'jewellery.jpg', 'desc' => 'Coming soon'],
                    ['name' => 'Custom Designs', 'slug' => 'custom', 'image' => 'custom.jpg', 'desc' => 'Made just for you'],
                ];
            @endphp

            @foreach($categories as $category)
                <a href="{{ url('/products?category=' . $category['slug']) }}" class="category-card">
                    <img src="{{ asset('images/categories/' . $category['image']) }}" alt="{{ $category['name'] }}">
                    <div class="category-overlay">
                        <div class="category-info">
                            <h3>{{ $category['name'] }}</h3>
                            <span>{{ $category['desc'] }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>