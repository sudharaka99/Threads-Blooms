{{-- resources/views/partials/home/hero.blade.php --}}

<section class="hero">

    <div class="hero-content">

        {{-- LEFT SIDE --}}
        <div class="hero-text">

            <div class="small-heading">
                Handmade with Love
            </div>

            <h2>
                Little Stitches,
                <br>
                <em>Beautiful Stories.</em>
            </h2>

            <p class="hero-description">
                Discover handmade embroidery pieces created with patience,
                creativity and love. From delicate cross-stitch patterns
                to beautifully embroidered T-shirts.
            </p>

            <div class="hero-buttons">

                <a href="{{ url('/products') }}"
                   class="btn btn-primary">

                    Explore Collection
                    <i class="fa-solid fa-arrow-right"></i>

                </a>

                <a href="{{ url('/customize') }}"
                   class="btn btn-outline">

                    Create Your Own

                </a>

            </div>

        </div>


        {{-- RIGHT SIDE LOGO --}}
        <div class="hero-logo">

            <img
                src="{{ asset('images/logo.png') }}"
                alt="Threads & Blooms - Bloom in Every Stitch"
                loading="eager"
                decoding="async"
            >

        </div>

    </div>

</section>