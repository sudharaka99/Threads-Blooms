{{-- resources/views/partials/home/handmade.blade.php --}}
<section class="section handmade">
    <div class="container">
        <div class="handmade-grid">
            <div class="handmade-image">
                <img src="{{ asset('images/home/custom-embroidery.jpg') }}" alt="Custom Embroidery">
                <div class="image-decoration"></div>
            </div>
            <div class="handmade-text">
                <div class="eyebrow">Made Especially For You</div>
                <h2>Your Idea.<br>Our Threads.</h2>
                <p>
                    Have a design in mind? Turn your idea into a beautiful
                    handmade creation. Choose your colours, style, name,
                    initials or your favourite design.
                </p>
                <ul class="feature-list">
                    <li><i class="fa-solid fa-check"></i> Personalised embroidery</li>
                    <li><i class="fa-solid fa-check"></i> Choose your own colours</li>
                    <li><i class="fa-solid fa-check"></i> Names & initials available</li>
                    <li><i class="fa-solid fa-check"></i> Handmade with care</li>
                </ul>
                <a href="{{ url('/customize') }}" class="btn btn-primary">
                    Start Your Custom Design <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>