@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

{{-- =========================================================
     CONTACT HERO
========================================================= --}}
<section class="contact-hero">

    <div class="container">

        <div class="contact-hero-content">

            <div class="eyebrow">
                We'd Love To Hear From You
            </div>

            <h1>
                Let's Create Something
                <span>Beautiful Together.</span>
            </h1>

            <p>
                Have a question about our handmade pieces,
                want to create a custom design, or simply want
                to say hello? We would love to hear from you.
            </p>

        </div>

    </div>

</section>



{{-- =========================================================
     CONTACT MAIN
========================================================= --}}
<section class="contact-section section">

    <div class="container">

        <div class="contact-grid">

            {{-- =================================================
                 CONTACT INFORMATION
            ================================================= --}}
            <div class="contact-info">

                <div class="eyebrow">
                    Get In Touch
                </div>

                <h2>
                    We'd Love To
                    <span>Hear From You.</span>
                </h2>

                <p class="contact-intro">
                    Whether you have a question about a product,
                    need help with an order, or have an idea for
                    a custom piece, feel free to reach out.
                </p>


                {{-- Email --}}
                <div class="contact-info-card">

                    <div class="contact-icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>

                    <div>
                        <span class="contact-label">
                            Email Us
                        </span>

                        <a href="mailto:hello@threadsandblooms.com">
                            hello@threadsandblooms.com
                        </a>
                    </div>

                </div>


                {{-- Phone --}}
                <div class="contact-info-card">

                    <div class="contact-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>

                    <div>
                        <span class="contact-label">
                            Call / WhatsApp
                        </span>

                        <a href="tel:+94771234567">
                            +94 77 123 4567
                        </a>
                    </div>

                </div>


                {{-- Location --}}
                <div class="contact-info-card">

                    <div class="contact-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>

                    <div>
                        <span class="contact-label">
                            Our Location
                        </span>

                        <span class="contact-value">
                            Sri Lanka
                        </span>
                    </div>

                </div>


                {{-- Opening Hours --}}
                <div class="contact-info-card">

                    <div class="contact-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>

                    <div>
                        <span class="contact-label">
                            Response Hours
                        </span>

                        <span class="contact-value">
                            Monday – Saturday
                            <br>
                            9:00 AM – 6:00 PM
                        </span>
                    </div>

                </div>


                {{-- Social --}}
                <div class="contact-social">

                    <h3>
                        Follow Our Handmade Journey
                    </h3>

                    <div class="social-links">

                        <a
                            href="#"
                            aria-label="Instagram"
                            class="social-link"
                        >
                            <i class="fa-brands fa-instagram"></i>
                        </a>

                        <a
                            href="#"
                            aria-label="Facebook"
                            class="social-link"
                        >
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>

                        <a
                            href="#"
                            aria-label="TikTok"
                            class="social-link"
                        >
                            <i class="fa-brands fa-tiktok"></i>
                        </a>

                    </div>

                </div>

            </div>



            {{-- =================================================
                 CONTACT FORM
            ================================================= --}}
            <div class="contact-form-wrapper">

                <div class="contact-form-header">

                    <div class="form-flower">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <div>

                        <h2>
                            Send Us A Message
                        </h2>

                        <p>
                            We usually reply within 24 hours.
                        </p>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ url('/contact') }}"
                    class="contact-form"
                >

                    @csrf


                    {{-- Name --}}
                    <div class="form-group">

                        <label for="name">
                            <i class="fa-regular fa-user"></i>
                            Your Name
                        </label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Enter your name"
                            required
                            class="@error('name') is-invalid @enderror"
                        >

                        @error('name')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Email --}}
                    <div class="form-group">

                        <label for="email">
                            <i class="fa-regular fa-envelope"></i>
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                            required
                            class="@error('email') is-invalid @enderror"
                        >

                        @error('email')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Phone --}}
                    <div class="form-group">

                        <label for="phone">
                            <i class="fa-solid fa-phone"></i>
                            Phone Number
                            <span class="optional">
                                Optional
                            </span>
                        </label>

                        <input
                            type="text"
                            id="phone"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="+94 XX XXX XXXX"
                        >

                    </div>


                    {{-- Subject --}}
                    <div class="form-group">

                        <label for="subject">
                            <i class="fa-regular fa-message"></i>
                            Subject
                        </label>

                        <select
                            id="subject"
                            name="subject"
                            required
                        >

                            <option value="" disabled selected>
                                What can we help you with?
                            </option>

                            <option value="product">
                                Product Question
                            </option>

                            <option value="order">
                                Order Enquiry
                            </option>

                            <option value="custom">
                                Custom Design
                            </option>

                            <option value="wholesale">
                                Wholesale / Business
                            </option>

                            <option value="other">
                                Something Else
                            </option>

                        </select>

                    </div>


                    {{-- Message --}}
                    <div class="form-group">

                        <label for="message">
                            <i class="fa-regular fa-comment"></i>
                            Your Message
                        </label>

                        <textarea
                            id="message"
                            name="message"
                            rows="6"
                            placeholder="Tell us how we can help..."
                            required
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        class="btn btn-primary contact-submit"
                    >

                        Send Message

                        <i class="fa-solid fa-paper-plane"></i>

                    </button>

                </form>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     CUSTOM DESIGN CTA
========================================================= --}}
<section class="contact-custom">

    <div class="container">

        <div class="contact-custom-box">

            <div class="custom-decoration left">
                <i class="fa-solid fa-leaf"></i>
            </div>

            <div class="custom-content">

                <div class="eyebrow">
                    Have Something Special In Mind?
                </div>

                <h2>
                    Create Your Own
                    <span>Custom Piece.</span>
                </h2>

                <p>
                    Tell us your idea and let us turn it into
                    a handmade piece created especially for you.
                </p>

                <a
                    href="{{ url('/customize') }}"
                    class="btn btn-primary"
                >
                    Start A Custom Design
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <div class="custom-decoration right">
                <i class="fa-solid fa-seedling"></i>
            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     FAQ
========================================================= --}}
<section class="contact-faq section">

    <div class="container">

        <div class="section-heading">

            <div class="eyebrow">
                Quick Answers
            </div>

            <h2>
                Frequently Asked Questions
            </h2>

            <p>
                Here are some common questions from our customers.
            </p>

        </div>


        <div class="faq-grid">

            {{-- FAQ 1 --}}
            <div class="faq-card">

                <div class="faq-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>

                <div>

                    <h3>
                        How long does an order take?
                    </h3>

                    <p>
                        Because our products are handmade, preparation
                        time can vary depending on the design and order.
                        We will let you know the expected time when
                        confirming your order.
                    </p>

                </div>

            </div>


            {{-- FAQ 2 --}}
            <div class="faq-card">

                <div class="faq-icon">
                    <i class="fa-solid fa-pen-ruler"></i>
                </div>

                <div>

                    <h3>
                        Can I request a custom design?
                    </h3>

                    <p>
                        Yes. We love creating personalised pieces.
                        Send us your idea and we can discuss the
                        design, colours and details.
                    </p>

                </div>

            </div>


            {{-- FAQ 3 --}}
            <div class="faq-card">

                <div class="faq-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>

                <div>

                    <h3>
                        Do you make gifts?
                    </h3>

                    <p>
                        Absolutely. Handmade embroidery pieces make
                        thoughtful gifts for birthdays, anniversaries,
                        celebrations and special moments.
                    </p>

                </div>

            </div>


            {{-- FAQ 4 --}}
            <div class="faq-card">

                <div class="faq-icon">
                    <i class="fa-solid fa-message"></i>
                </div>

                <div>

                    <h3>
                        How can I contact you?
                    </h3>

                    <p>
                        You can use the contact form above, email us,
                        call or WhatsApp us, or connect with us through
                        our social media pages.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/* =========================================================
   CONTACT HERO
========================================================= */

.contact-hero {
    padding: 75px 0 65px;

    background:
        linear-gradient(
            135deg,
            #fffaf5 0%,
            #fbe9e3 100%
        );

    text-align: center;
}

.contact-hero-content {
    max-width: 760px;
    margin: auto;
}

.contact-hero .eyebrow {
    margin-bottom: 12px;
}

.contact-hero h1 {
    font-family: 'Playfair Display', serif;

    font-size: clamp(42px, 5vw, 65px);

    line-height: 1.08;

    color: #493b35;

    margin: 0 0 22px;
}

.contact-hero h1 span {
    display: block;

    color: #b96d70;

    font-style: italic;
}

.contact-hero p {
    max-width: 620px;

    margin: auto;

    color: #75665f;

    font-size: 15px;

    line-height: 1.9;
}


/* =========================================================
   MAIN CONTACT
========================================================= */

.contact-section {
    background: #fffaf5;
}

.contact-grid {
    display: grid;

    grid-template-columns: .85fr 1.15fr;

    gap: 65px;

    align-items: start;
}


/* =========================================================
   CONTACT INFO
========================================================= */

.contact-info h2 {
    font-family: 'Playfair Display', serif;

    font-size: 42px;

    line-height: 1.2;

    color: #493b35;

    margin: 12px 0 18px;
}

.contact-info h2 span {
    display: block;

    color: #b96d70;
}

.contact-intro {
    color: #75665f;

    font-size: 14px;

    line-height: 1.85;

    margin-bottom: 30px;

    max-width: 470px;
}

.contact-info-card {
    display: flex;

    align-items: center;

    gap: 15px;

    padding: 16px;

    margin-bottom: 13px;

    background: #fff;

    border: 1px solid #eadbd0;

    border-radius: 15px;

    transition: .25s;
}

.contact-info-card:hover {
    transform: translateX(4px);

    box-shadow:
        0 10px 25px rgba(70, 50, 40, .07);
}

.contact-icon {
    flex: 0 0 46px;

    width: 46px;
    height: 46px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fbe1df;

    color: #b96d70;

    font-size: 16px;
}

.contact-label {
    display: block;

    color: #9a887e;

    font-size: 10px;

    text-transform: uppercase;

    letter-spacing: .8px;

    margin-bottom: 4px;
}

.contact-info-card a,
.contact-value {
    color: #493b35;

    text-decoration: none;

    font-size: 13px;

    line-height: 1.5;
}

.contact-info-card a:hover {
    color: #b96d70;
}


/* =========================================================
   SOCIAL
========================================================= */

.contact-social {
    margin-top: 30px;
}

.contact-social h3 {
    font-family: 'Playfair Display', serif;

    color: #493b35;

    font-size: 19px;

    margin-bottom: 14px;
}

.social-links {
    display: flex;

    gap: 10px;
}

.social-link {
    width: 40px;
    height: 40px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f8eee5;

    border: 1px solid #eadbd0;

    color: #b96d70;

    text-decoration: none;

    transition: .25s;
}

.social-link:hover {
    background: #b96d70;

    color: #fff;

    transform: translateY(-3px);
}


/* =========================================================
   CONTACT FORM
========================================================= */

.contact-form-wrapper {
    background: #fff;

    border: 1px solid #eadbd0;

    border-radius: 22px;

    padding: 35px;

    box-shadow:
        0 15px 45px rgba(70, 50, 40, .07);
}

.contact-form-header {
    display: flex;

    align-items: center;

    gap: 15px;

    padding-bottom: 22px;

    margin-bottom: 25px;

    border-bottom: 1px solid #f0e4dc;
}

.form-flower {
    width: 50px;
    height: 50px;

    display: flex;

    align-items: center;
    justify-content: center;

    flex: 0 0 50px;

    border-radius: 50%;

    background: #fbe1df;

    color: #b96d70;

    font-size: 19px;
}

.contact-form-header h2 {
    font-family: 'Playfair Display', serif;

    color: #493b35;

    font-size: 26px;

    margin: 0 0 3px;
}

.contact-form-header p {
    color: #9a887e;

    font-size: 11px;

    margin: 0;
}


/* Form groups */

.contact-form .form-group {
    margin-bottom: 18px;
}

.contact-form label {
    display: flex;

    align-items: center;

    gap: 7px;

    color: #493b35;

    font-size: 11px;

    font-weight: 600;

    margin-bottom: 7px;
}

.contact-form label i {
    color: #b96d70;
}

.optional {
    color: #aaa;

    font-weight: 400;

    margin-left: 3px;
}


/* Inputs */

.contact-form input,
.contact-form select,
.contact-form textarea {
    width: 100%;

    box-sizing: border-box;

    border: 1px solid #e6d8cf;

    background: #fffaf7;

    color: #493b35;

    border-radius: 10px;

    padding: 12px 14px;

    font-family: inherit;

    font-size: 12px;

    outline: none;

    transition: .2s;
}

.contact-form input {
    height: 45px;
}

.contact-form select {
    height: 45px;

    cursor: pointer;
}

.contact-form textarea {
    resize: vertical;

    min-height: 130px;

    line-height: 1.6;
}

.contact-form input:focus,
.contact-form select:focus,
.contact-form textarea:focus {
    border-color: #c98a8c;

    background: #fff;

    box-shadow:
        0 0 0 3px rgba(185, 109, 112, .08);
}

.contact-form input::placeholder,
.contact-form textarea::placeholder {
    color: #b9aaa2;
}


/* Error */

.contact-form .is-invalid {
    border-color: #c56d6d;
}

.error-message {
    display: block;

    color: #c56d6d;

    font-size: 10px;

    margin-top: 5px;
}


/* Submit */

.contact-submit {
    width: 100%;

    margin-top: 5px;

    border: none;

    cursor: pointer;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 10px;
}


/* =========================================================
   CUSTOM CTA
========================================================= */

.contact-custom {
    padding: 20px 0 75px;

    background: #fffaf5;
}

.contact-custom-box {
    position: relative;

    overflow: hidden;

    background:
        linear-gradient(
            135deg,
            #fbe1df,
            #f8eee5
        );

    border: 1px solid #ead1ca;

    border-radius: 24px;

    padding: 60px 40px;

    text-align: center;
}

.custom-content {
    position: relative;

    z-index: 2;
}

.custom-content h2 {
    font-family: 'Playfair Display', serif;

    color: #493b35;

    font-size: 38px;

    margin: 8px 0 10px;
}

.custom-content h2 span {
    color: #b96d70;

    font-style: italic;
}

.custom-content p {
    color: #75665f;

    max-width: 530px;

    margin: 0 auto 23px;

    line-height: 1.7;

    font-size: 13px;
}

.custom-decoration {
    position: absolute;

    color: rgba(185,109,112,.2);

    font-size: 90px;
}

.custom-decoration.left {
    left: 35px;

    bottom: -15px;
}

.custom-decoration.right {
    right: 35px;

    top: -15px;
}


/* =========================================================
   FAQ
========================================================= */

.contact-faq {
    background: #f8eee5;
}

.faq-grid {
    display: grid;

    grid-template-columns: repeat(2, 1fr);

    gap: 18px;

    margin-top: 35px;
}

.faq-card {
    display: flex;

    gap: 15px;

    background: #fffaf5;

    border: 1px solid #eadbd0;

    border-radius: 17px;

    padding: 24px;

    transition: .25s;
}

.faq-card:hover {
    transform: translateY(-3px);

    box-shadow:
        0 10px 25px rgba(70, 50, 40, .07);
}

.faq-icon {
    flex: 0 0 42px;

    width: 42px;
    height: 42px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fbe1df;

    color: #b96d70;
}

.faq-card h3 {
    font-family: 'Playfair Display', serif;

    color: #493b35;

    font-size: 18px;

    margin: 0 0 7px;
}

.faq-card p {
    color: #75665f;

    font-size: 11px;

    line-height: 1.7;

    margin: 0;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 900px) {

    .contact-grid {
        grid-template-columns: 1fr;

        gap: 45px;
    }

    .contact-info {
        max-width: 650px;

        margin: auto;

        width: 100%;
    }

    .contact-form-wrapper {
        max-width: 650px;

        width: 100%;

        box-sizing: border-box;

        margin: auto;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .contact-hero {
        padding: 50px 0;
    }

    .contact-hero h1 {
        font-size: 40px;
    }

    .contact-hero p {
        font-size: 13px;
    }

    .contact-info h2 {
        font-size: 34px;
    }

    .contact-form-wrapper {
        padding: 22px 18px;

        border-radius: 17px;
    }

    .contact-form-header h2 {
        font-size: 22px;
    }

    .faq-grid {
        grid-template-columns: 1fr;
    }

    .contact-custom-box {
        padding: 45px 20px;
    }

    .custom-content h2 {
        font-size: 30px;
    }

    .custom-decoration {
        display: none;
    }

}

</style>

@endpush