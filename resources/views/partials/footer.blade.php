{{-- resources/views/partials/footer.blade.php --}}
<footer>
    <div class="container">
        <div class="footer-grid">

            {{-- Brand --}}
            <div>
                <div class="footer-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Threads & Blooms">
                    <h3>THREADS & BLOOMS</h3>
                </div>
                <p class="footer-about">
                    Handmade creations designed to bring colour,
                    warmth and a little happiness into everyday life.
                </p>
                <div class="socials">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" aria-label="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a>
                </div>
            </div>

            {{-- Shop --}}
            <div>
                <h4>Shop</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/products') }}">All Products</a></li>
                    <li><a href="{{ url('/products?category=cross-stitch') }}">Cross-Stitch</a></li>
                    <li><a href="{{ url('/products?category=tshirts') }}">Embroidered T-Shirts</a></li>
                    <li><a href="{{ url('/products?category=jewellery') }}">Jewellery</a></li>
                    <li><a href="{{ url('/customize') }}">Custom Designs</a></li>
                </ul>
            </div>

            {{-- Information --}}
            <div>
                <h4>Information</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/about') }}">About Us</a></li>
                    <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                    <li><a href="{{ url('/shipping') }}">Shipping & Delivery</a></li>
                    <li><a href="{{ url('/returns') }}">Returns & Exchanges</a></li>
                    <li><a href="{{ url('/privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h4>Get in Touch</h4>
                <div class="contact-item">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>Sri Lanka</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>hello@threadsandblooms.com</span>
                </div>
                <div class="contact-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>+94 XX XXX XXXX</span>
                </div>
            </div>

        </div>

        <div class="copyright">
            © {{ date('Y') }} Threads & Blooms. All Rights Reserved. Made with ♥ and lots of stitches.
        </div>
    </div>
</footer>