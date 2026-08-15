@extends('layouts.app')

@section('title', 'About Us')

@section('content')

{{-- =========================================================
     ABOUT HERO
========================================================= --}}
<section class="about-page-hero">

    <div class="container">

        <div class="about-hero-grid">

            {{-- Text --}}
            <div class="about-hero-text">

                <div class="eyebrow">
                    Our Story
                </div>

                <h1>
                    Where Every Stitch
                    <span>Has a Story.</span>
                </h1>

                <p>
                    Welcome to Threads & Blooms — a little space where
                    creativity, patience and handmade love come together.
                </p>

                <p>
                    Every piece is carefully created by hand to turn
                    simple fabrics and threads into something meaningful,
                    beautiful and uniquely yours.
                </p>

                <div class="about-hero-buttons">

                    <a
                        href="{{ url('/products') }}"
                        class="btn btn-primary"
                    >
                        Explore Our Collection
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a
                        href="{{ url('/customize') }}"
                        class="btn btn-outline"
                    >
                        Create Your Own
                    </a>

                </div>

            </div>


            {{-- Image --}}
            <div class="about-hero-image">

                <div class="about-image-frame">

                    <img
                        src="{{ asset('images/about-1.jpg') }}"
                        alt="Threads & Blooms handmade embroidery"
                        loading="lazy"
                        decoding="async"
                    >

                </div>


                <div class="about-floating-card">

                    <div class="floating-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <div>
                        <strong>Handmade</strong>
                        <span>with love</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     OUR STORY
========================================================= --}}
<section class="about-story section">

    <div class="container">

        <div class="about-story-grid">

            {{-- Images --}}
            <div class="about-story-images">

                <div class="story-image-large">

                    <img
                        src="{{ asset('images/about-2.jpg') }}"
                        alt="Handmade embroidery work"
                        loading="lazy"
                        decoding="async"
                    >

                </div>


                <div class="story-small-card">

                    <div class="story-card-icon">
                        <i class="fa-solid fa-heart"></i>
                    </div>

                    <div>
                        <strong>
                            Bloom in Every Stitch
                        </strong>

                        <span>
                            Threads & Blooms
                        </span>
                    </div>

                </div>

            </div>


            {{-- Content --}}
            <div class="about-story-content">

                <div class="eyebrow">
                    A Little About Us
                </div>

                <h2>
                    Handmade Pieces,
                    <span>Made From the Heart.</span>
                </h2>

                <p>
                    Threads & Blooms was created from a simple love
                    for beautiful handmade things.
                </p>

                <p>
                    We believe handmade products are more than
                    just things you can buy. Every piece carries
                    the time, patience and creativity of the person
                    who made it.
                </p>

                <p>
                    From delicate cross-stitch patterns and
                    embroidered T-shirts to personalised designs,
                    we create pieces that bring a little warmth
                    and personality into everyday life.
                </p>

                <p>
                    Whether you are looking for something special
                    for yourself or a thoughtful gift for someone
                    you love, we hope you find something that feels
                    just right.
                </p>

                <div class="story-highlights">

                    <div>
                        <i class="fa-solid fa-heart"></i>
                        <span>Made with love</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-scissors"></i>
                        <span>Carefully crafted</span>
                    </div>

                    <div>
                        <i class="fa-solid fa-gift"></i>
                        <span>Perfect for gifting</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     VALUES
========================================================= --}}
<section class="about-values section">

    <div class="container">

        <div class="section-heading">

            <div class="eyebrow">
                What We Believe
            </div>

            <h2>
                Made With Love & Care
            </h2>

            <p>
                Every piece we create follows the same simple values.
            </p>

        </div>


        <div class="values-grid">

            {{-- Handmade --}}
            <div class="value-card">

                <div class="value-icon">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <h3>
                    Handmade
                </h3>

                <p>
                    Every stitch is carefully made by hand,
                    giving each piece its own special character.
                </p>

            </div>


            {{-- Quality --}}
            <div class="value-card">

                <div class="value-icon">
                    <i class="fa-solid fa-award"></i>
                </div>

                <h3>
                    Quality
                </h3>

                <p>
                    We pay attention to the smallest details
                    and choose materials with care for beautiful
                    results.
                </p>

            </div>


            {{-- Creativity --}}
            <div class="value-card">

                <div class="value-icon">
                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                </div>

                <h3>
                    Creativity
                </h3>

                <p>
                    From floral patterns to personalised designs,
                    we love turning ideas into something real.
                </p>

            </div>


            {{-- Made For You --}}
            <div class="value-card">

                <div class="value-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>

                <h3>
                    Made For You
                </h3>

                <p>
                    Every order is prepared with care so your
                    handmade piece feels personal and meaningful.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     OUR PROCESS
========================================================= --}}
<section class="about-process section">

    <div class="container">

        <div class="section-heading">

            <div class="eyebrow">
                Behind Every Piece
            </div>

            <h2>
                From Thread to Treasure
            </h2>

            <p>
                A little glimpse into how we create our handmade pieces.
            </p>

        </div>


        <div class="process-grid">

            {{-- 01 --}}
            <div class="process-item">

                <div class="process-number">
                    01
                </div>

                <div class="process-icon">
                    <i class="fa-regular fa-lightbulb"></i>
                </div>

                <h3>
                    Imagine
                </h3>

                <p>
                    We begin with an idea, a pattern or your
                    personal request.
                </p>

            </div>


            {{-- Connector --}}
            <div class="process-line"></div>


            {{-- 02 --}}
            <div class="process-item">

                <div class="process-number">
                    02
                </div>

                <div class="process-icon">
                    <i class="fa-solid fa-pencil"></i>
                </div>

                <h3>
                    Design
                </h3>

                <p>
                    Colours, threads and details are carefully
                    selected to bring the idea to life.
                </p>

            </div>


            {{-- Connector --}}
            <div class="process-line"></div>


            {{-- 03 --}}
            <div class="process-item">

                <div class="process-number">
                    03
                </div>

                <div class="process-icon">
                    <i class="fa-solid fa-scissors"></i>
                </div>

                <h3>
                    Stitch
                </h3>

                <p>
                    Each stitch is carefully made with patience
                    and attention to detail.
                </p>

            </div>


            {{-- Connector --}}
            <div class="process-line"></div>


            {{-- 04 --}}
            <div class="process-item">

                <div class="process-number">
                    04
                </div>

                <div class="process-icon">
                    <i class="fa-solid fa-gift"></i>
                </div>

                <h3>
                    Deliver
                </h3>

                <p>
                    Your finished handmade piece is carefully
                    prepared and ready for you.
                </p>

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     CTA
========================================================= --}}
<section class="about-cta">

    <div class="container">

        <div class="about-cta-box">

            <div class="cta-decoration cta-left">
                <i class="fa-solid fa-leaf"></i>
            </div>

            <div class="cta-decoration cta-right">
                <i class="fa-solid fa-seedling"></i>
            </div>


            <div class="cta-content">

                <div class="eyebrow">
                    Made Just For You
                </div>

                <h2>
                    Have an Idea in Mind?
                </h2>

                <p>
                    Let's turn your idea into something beautiful,
                    handmade and uniquely yours.
                </p>

                <div class="cta-buttons">

                    <a
                        href="{{ url('/customize') }}"
                        class="btn btn-primary"
                    >
                        Create Your Own
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>

                    <a
                        href="{{ url('/products') }}"
                        class="btn btn-outline"
                    >
                        Shop Collection
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection



@push('styles')

<style>

/* =========================================================
   ABOUT PAGE
========================================================= */

.about-page-hero {
    padding: 75px 0;
    background:
        linear-gradient(
            135deg,
            #fffaf5 0%,
            #fbe9e3 100%
        );
}

.about-hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: center;
}

.about-hero-text .eyebrow {
    margin-bottom: 12px;
}

.about-hero-text h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(42px, 5vw, 68px);
    line-height: 1.05;
    color: #493b35;
    margin: 0 0 25px;
}

.about-hero-text h1 span {
    display: block;
    color: #b96d70;
    font-style: italic;
}

.about-hero-text p {
    max-width: 560px;
    color: #75665f;
    font-size: 15px;
    line-height: 1.9;
}

.about-hero-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 20px;
}


/* =========================================================
   HERO IMAGE
========================================================= */

.about-hero-image {
    position: relative;
}

.about-image-frame {
    background: white;
    padding: 12px;
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(70, 50, 40, .13);
    transform: rotate(2deg);
}

.about-image-frame img {
    display: block;
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 16px;
}

.about-floating-card {
    position: absolute;
    left: -35px;
    bottom: 30px;

    display: flex;
    align-items: center;
    gap: 10px;

    background: #fffaf5;
    border: 1px solid #eadbd0;

    padding: 13px 20px;
    border-radius: 15px;

    box-shadow: 0 12px 30px rgba(70,50,40,.12);
}

.floating-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fbe1df;
    color: #b96d70;
}

.about-floating-card strong {
    display: block;
    font-family: 'Playfair Display', serif;
    color: #493b35;
    font-size: 14px;
}

.about-floating-card span {
    display: block;
    color: #9a887e;
    font-size: 10px;
    margin-top: 2px;
}


/* =========================================================
   STORY
========================================================= */

.about-story {
    background: #fffaf5;
}

.about-story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: center;
}

.about-story-images {
    position: relative;
    padding-right: 30px;
}

.story-image-large {
    background: white;
    padding: 10px;
    border: 1px solid #eadbd0;
    border-radius: 20px;
}

.story-image-large img {
    display: block;
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 13px;
}

.story-small-card {
    position: absolute;
    right: 0;
    bottom: 35px;

    display: flex;
    align-items: center;
    gap: 10px;

    background: #b96d70;
    color: white;

    padding: 15px 20px;
    border-radius: 15px;

    box-shadow: 0 12px 30px rgba(80,40,40,.18);
}

.story-card-icon {
    width: 38px;
    height: 38px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: rgba(255,255,255,.16);
}

.story-small-card strong {
    display: block;
    font-family: 'Playfair Display', serif;
    font-size: 13px;
}

.story-small-card span {
    display: block;
    font-size: 9px;
    opacity: .85;
    margin-top: 3px;
}

.about-story-content h2 {
    font-family: 'Playfair Display', serif;
    font-size: 42px;
    line-height: 1.2;
    color: #493b35;
    margin: 12px 0 20px;
}

.about-story-content h2 span {
    display: block;
    color: #b96d70;
}

.about-story-content p {
    color: #75665f;
    line-height: 1.85;
    font-size: 14px;
}

.story-highlights {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 25px;
}

.story-highlights div {
    display: flex;
    align-items: center;
    gap: 7px;

    color: #695850;
    font-size: 11px;
    font-weight: 600;
}

.story-highlights i {
    color: #b96d70;
}


/* =========================================================
   VALUES
========================================================= */

.about-values {
    background: #f8eee5;
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

.value-card {
    background: #fffaf5;
    border: 1px solid #eadbd0;
    border-radius: 18px;
    padding: 30px 22px;
    text-align: center;
    transition: .25s;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(70,50,40,.09);
}

.value-icon {
    width: 58px;
    height: 58px;

    margin: 0 auto 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #fbe1df;
    color: #b96d70;

    font-size: 20px;
}

.value-card h3 {
    font-family: 'Playfair Display', serif;
    color: #493b35;
    font-size: 21px;
    margin: 0 0 10px;
}

.value-card p {
    color: #75665f;
    font-size: 12px;
    line-height: 1.7;
    margin: 0;
}


/* =========================================================
   PROCESS
========================================================= */

.about-process {
    background: #fffaf5;
}

.process-grid {
    display: grid;

    grid-template-columns:
        minmax(0, 1fr)
        auto
        minmax(0, 1fr)
        auto
        minmax(0, 1fr)
        auto
        minmax(0, 1fr);

    align-items: start;
    gap: 14px;

    margin-top: 45px;
}

.process-item {
    text-align: center;
    min-width: 0;
}

.process-number {
    color: #b96d70;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1px;
    margin-bottom: 12px;
}

.process-icon {
    width: 60px;
    height: 60px;

    margin: auto;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #f8eee5;
    border: 1px solid #eadbd0;

    color: #b96d70;

    font-size: 19px;
}

.process-item h3 {
    font-family: 'Playfair Display', serif;
    color: #493b35;

    font-size: 22px;

    margin: 15px 0 8px;
}

.process-item p {
    color: #75665f;

    font-size: 12px;
    line-height: 1.65;

    max-width: 230px;
    margin: 0 auto;
}

.process-line {
    width: 50px;
    height: 1px;

    background: #dfb5ae;

    margin-top: 91px;
}


/* =========================================================
   CTA
========================================================= */

.about-cta {
    padding: 70px 0;
    background: #fffaf5;
}

.about-cta-box {
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

.cta-content {
    position: relative;
    z-index: 2;
}

.about-cta-box h2 {
    font-family: 'Playfair Display', serif;
    color: #493b35;

    font-size: 38px;

    margin: 8px 0 12px;
}

.about-cta-box p {
    color: #75665f;

    max-width: 500px;

    margin: 0 auto 22px;

    line-height: 1.7;
}

.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
}

.cta-decoration {
    position: absolute;

    color: rgba(185,109,112,.22);

    font-size: 90px;
}

.cta-left {
    left: 35px;
    bottom: -15px;
}

.cta-right {
    right: 35px;
    top: -15px;
}


/* =========================================================
   TABLET
========================================================= */

@media (max-width: 1000px) {

    .about-hero-grid,
    .about-story-grid {
        grid-template-columns: 1fr;
        gap: 45px;
    }

    .about-hero-text {
        text-align: center;
    }

    .about-hero-text p {
        margin-left: auto;
        margin-right: auto;
    }

    .about-hero-buttons {
        justify-content: center;
    }

    .about-hero-image {
        max-width: 650px;
        width: 100%;
        margin: auto;
    }

    .about-story-images {
        max-width: 650px;
        width: 100%;
        margin: auto;
    }

    .values-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .process-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 35px;
    }

    .process-line {
        display: none;
    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 600px) {

    .about-page-hero {
        padding: 45px 0;
    }

    .about-hero-text h1 {
        font-size: 40px;
    }

    .about-hero-text p {
        font-size: 13px;
    }

    .about-hero-buttons {
        flex-direction: column;
    }

    .about-hero-buttons .btn {
        width: 100%;
        box-sizing: border-box;
    }

    .about-image-frame img,
    .story-image-large img {
        height: 360px;
    }

    .about-floating-card {
        left: 10px;
        bottom: 20px;
    }

    .about-story-content h2 {
        font-size: 34px;
    }

    .story-small-card {
        right: 10px;
        bottom: 20px;
    }

    .story-highlights {
        flex-direction: column;
        gap: 12px;
    }

    .values-grid {
        grid-template-columns: 1fr;
    }

    .process-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .process-item p {
        max-width: 280px;
    }

    .about-cta {
        padding: 45px 0;
    }

    .about-cta-box {
        padding: 45px 20px;
    }

    .about-cta-box h2 {
        font-size: 30px;
    }

    .cta-buttons {
        flex-direction: column;
    }

    .cta-buttons .btn {
        width: 100%;
        box-sizing: border-box;
    }

    .cta-decoration {
        display: none;
    }

}

</style>

@endpush