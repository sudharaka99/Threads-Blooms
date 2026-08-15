{{-- resources/views/partials/home/about.blade.php --}}
<section class="section about">
    <div class="container">
        <div class="about-grid">
            <div class="about-images">
                <img src="{{ asset('images/home/about-1.jpg') }}" alt="Threads and Blooms handmade embroidery">
                <img src="{{ asset('images/home/about-2.jpg') }}" alt="Handmade embroidery work">
            </div>
            <div class="about-text">
                <div class="eyebrow">Our Story</div>
                <h2>Where Every Stitch Has a Story.</h2>
                <p>Threads & Blooms was created from a simple love for beautiful handmade things.</p>
                <p>
                    Every piece is carefully designed, stitched and finished
                    by hand. We believe that handmade products carry something
                    special — time, patience and a little piece of the person
                    who created them.
                </p>
                <p>
                    From tiny floral patterns to personalised embroidery,
                    our goal is to create pieces that make everyday moments
                    a little more beautiful.
                </p>
                <a href="{{ url('/about') }}" class="btn btn-outline">
                    Read Our Story <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>