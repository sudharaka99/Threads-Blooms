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
                    [
                        'name' => 'Cross-Stitch',
                        'slug' => 'cross-stitch',
                        'image' => 'images/cross stich.jpeg',
                        'desc' => 'Handmade patterns'
                    ],
                    [
                        'name' => 'Embroidered T-Shirts',
                        'slug' => 'tshirts',
                        'image' => 'images/tshirt.jpeg',
                        'desc' => 'Wear your story'
                    ],
                    [
                        'name' => 'Jewellery',
                        'slug' => 'jewellery',
                        'image' => 'images/Jw.jpeg',
                        'desc' => 'Coming soon'
                    ],
                    [
                        'name' => 'Custom Designs',
                        'slug' => 'custom',
                        'image' => 'images/cd.jpeg',
                        'desc' => 'Made just for you'
                    ],
                ];
            @endphp

            @foreach($categories as $category)
                <a href="{{ url('/products?category=' . $category['slug']) }}" class="category-card">
                    <img 
                        src="{{ asset($category['image']) }}" 
                        alt="{{ $category['name'] }}" 
                        loading="lazy" 
                        decoding="async"
                    >

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