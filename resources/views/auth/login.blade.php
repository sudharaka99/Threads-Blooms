@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-section">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fa-regular fa-user"></i>
                </div>
                <h2>Welcome Back</h2>
                <p>Sign in to your account to continue</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="form-group">
                    <label for="email">
                        <i class="fa-regular fa-envelope"></i>
                        Email Address
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus 
                        placeholder="you@example.com"
                        class="@error('email') is-invalid @enderror"
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">
                        <i class="fa-solid fa-lock"></i>
                        Password
                    </label>
                    <div class="password-wrapper">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            placeholder="Enter your password"
                            class="@error('password') is-invalid @enderror"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="checkbox-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkmark"></span>
                        Remember me
                    </label>
                    <a href="{{ route('password.request') }}" class="forgot-link">
                        Forgot Password?
                    </a>
                </div>

                <button type="submit" class="btn btn-primary auth-submit">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Sign In
                </button>

                <p class="auth-footer">
                    Don't have an account? 
                    <a href="{{ route('register') }}">Create one now</a>
                </p>
            </form>
        </div>

        <div class="auth-image">
            <img src="{{ asset('images/login-decoration.jpg') }}" alt="Threads & Blooms">
            <div class="auth-image-text">
                <h3>Bloom in Every Stitch</h3>
                <p>Join our community of creative makers</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        const icon = input.nextElementSibling.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endpush