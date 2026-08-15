{{-- resources/views/partials/home/why-us.blade.php --}}
<section class="section why-us">
    <div class="container">
        <div class="section-heading">
            <div class="eyebrow">Why Threads & Blooms</div>
            <h2>Made With Heart</h2>
        </div>

        <div class="why-grid">
            @php
                $reasons = [
                    ['icon' => 'fa-hand-holding-heart', 'title' => 'Handmade', 'desc' => 'Every piece is carefully created by hand.'],
                    ['icon' => 'fa-palette', 'title' => 'Unique Designs', 'desc' => 'Designs created with creativity and personality.'],
                    ['icon' => 'fa-seedling', 'title' => 'Made With Care', 'desc' => 'Quality materials and attention to every detail.'],
                    ['icon' => 'fa-gift', 'title' => 'Perfect Gifts', 'desc' => 'Beautiful handmade gifts for people you love.'],
                ];
            @endphp

            @foreach($reasons as $reason)
                <div class="why-card">
                    <div class="why-icon"><i class="fa-solid {{ $reason['icon'] }}"></i></div>
                    <h3>{{ $reason['title'] }}</h3>
                    <p>{{ $reason['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>