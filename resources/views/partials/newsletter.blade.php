{{-- resources/views/partials/newsletter.blade.php --}}
<section class="newsletter">
    <h2>Stay in the Bloom</h2>
    <p>
        Get new designs, handmade stories and special offers directly
        to your inbox.
    </p>

    <form action="{{ url('/newsletter') }}" method="POST" class="newsletter-form">
        @csrf
        <input type="email" name="email" placeholder="Enter your email address" required>
        <button type="submit">Subscribe</button>
    </form>
</section>