@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="auth-section">
    <div class="auth-container">
        <div class="auth-card" style="text-align:center;">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <h2>404</h2>
                <p>Page not found</p>
            </div>

            <p>The page you are looking for does not exist or has moved.</p>

            <a href="{{ url('/') }}" class="btn btn-primary">
                <i class="fa-solid fa-house"></i>
                Go Home
            </a>
        </div>
    </div>
</div>
@endsection
