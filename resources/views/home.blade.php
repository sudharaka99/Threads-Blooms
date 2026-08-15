{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Threads & Blooms | Bloom in Every Stitch')
@section('description', 'Threads & Blooms - Handmade cross-stitch patterns, embroidered T-shirts, jewellery and custom embroidery designs.')

@section('content')

    {{-- ==============================
         HERO
    ============================== --}}
    @include('partials.home.hero')

    {{-- ==============================
         CATEGORIES
    ============================== --}}
    @include('partials.home.categories')

    {{-- ==============================
         FEATURED PRODUCTS
    ============================== --}}
    @include('partials.home.featured-products')

    {{-- ==============================
         CUSTOM / HANDMADE SECTION
    ============================== --}}
    @include('partials.home.handmade')

    {{-- ==============================
         ABOUT
    ============================== --}}
    @include('partials.home.about')

    {{-- ==============================
         WHY CHOOSE US
    ============================== --}}
    @include('partials.home.why-us')

    {{-- ==============================
         TESTIMONIALS
    ============================== --}}
    @include('partials.home.testimonials')

    {{-- ==============================
         INSTAGRAM / GALLERY
    ============================== --}}
    @include('partials.home.gallery')

@endsection