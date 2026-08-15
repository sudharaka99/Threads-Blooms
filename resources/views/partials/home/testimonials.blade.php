{{-- resources/views/partials/home/testimonials.blade.php --}}
<section class="section testimonials">
    <div class="container">
        <div class="section-heading">
            <div class="eyebrow">Customer Love</div>
            <h2>What They Say</h2>
            <p>Little words from people who brought Threads & Blooms home.</p>
        </div>

        <div class="testimonial-grid">
            @php
                $testimonials = [
                    [
                        'text' => 'The embroidery was even prettier in person. You can really see how much care went into making it.',
                        'name' => 'Nethmi',
                        'verified' => true
                    ],
                    [
                        'text' => 'I ordered a custom embroidered T-shirt and absolutely loved it. The design came out exactly how I imagined.',
                        'name' => 'Kavindi',
                        'verified' => true
                    ],
                    [
                        'text' => 'Such a beautiful handmade gift. The packaging and little details made it feel extra special.',
                        'name' => 'Amaya',
                        'verified' => true
                    ]
                ];
            @endphp

            @foreach($testimonials as $testimonial)
                <div class="testimonial">
                    <div class="stars">★★★★★</div>
                    <p>"{{ $testimonial['text'] }}"</p>
                    <div class="customer">
                        <div class="customer-avatar">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <strong>{{ $testimonial['name'] }}</strong>
                            <span>{{ $testimonial['verified'] ? 'Verified Customer' : 'Customer' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>