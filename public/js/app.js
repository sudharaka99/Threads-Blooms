/**
 * Mobile Menu Toggle
 */
function toggleMenu() {
    const nav = document.getElementById('navLinks');
    nav.classList.toggle('show');
}

// Close mobile menu after clicking a link
document.querySelectorAll('.nav-links a').forEach(function(link) {
    link.addEventListener('click', function() {
        document.getElementById('navLinks').classList.remove('show');
    });
});

/**
 * Wishlist Toggle
 */
document.querySelectorAll('.wishlist').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();

        const icon = this.querySelector('i');
        icon.classList.toggle('fa-regular');
        icon.classList.toggle('fa-solid');
    });
});

/**
 * Newsletter Form
 */
document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
    const email = this.querySelector('input[type="email"]');
    if (!email.value || !email.value.includes('@')) {
        e.preventDefault();
        alert('Please enter a valid email address.');
    }
});

/**
 * Smooth scroll for anchor links
 */
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        const href = this.getAttribute('href');
        if (href !== '#') {
            e.preventDefault();
            document.querySelector(href)?.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});