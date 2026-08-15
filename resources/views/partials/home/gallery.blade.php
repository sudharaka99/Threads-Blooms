{{-- resources/views/partials/home/gallery.blade.php --}}
<section class="section gallery">
    <div class="container">
        <div class="section-heading">
            <div class="eyebrow">Follow Our Journey</div>
            <h2>@threadsandblooms</h2>
        </div>
    </div>

    <div class="gallery-grid">
        @for($i = 1; $i <= 6; $i++)
            <div class="gallery-item">
                <img src="{{ asset('images/gallery/gallery-' . $i . '.jpg') }}" alt="Threads and Blooms">
                <div class="gallery-overlay">
                    <i class="fa-brands fa-instagram"></i>
                </div>
            </div>
        @endfor
    </div>
</section>