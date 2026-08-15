@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="auth-section">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fa-regular fa-user-plus"></i>
                </div>
                <h2>Create Account</h2>
                <p>Start your creative journey with us</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="auth-form">
                @csrf

                {{-- Full Name --}}
                <div class="form-group">
                    <label for="name">
                        <i class="fa-regular fa-user"></i>
                        Full Name
                    </label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        placeholder="John Doe"
                        class="@error('name') is-invalid @enderror"
                    >
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email --}}
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
                        placeholder="you@example.com"
                        class="@error('email') is-invalid @enderror"
                    >
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
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
                            placeholder="Min 8 characters"
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

                {{-- Confirm Password --}}
                <div class="form-group">
                    <label for="password_confirmation">
                        <i class="fa-solid fa-lock"></i>
                        Confirm Password
                    </label>
                    <div class="password-wrapper">
                        <input 
                            id="password_confirmation" 
                            type="password" 
                            name="password_confirmation" 
                            required 
                            placeholder="Confirm your password"
                        >
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn btn-primary auth-submit">
                    <i class="fa-regular fa-user-plus"></i>
                    Create Account
                </button>

                {{-- Footer Link --}}
                <p class="auth-footer">
                    Already have an account? 
                    <a href="{{ route('login') }}">Sign in here</a>
                </p>
            </form>
        </div>

        {{-- Image Side - Same as Login --}}
        <div class="auth-image">
            <img src="{{ asset('images/register-decoration.jpg') }}" alt="Threads & Blooms">
            <div class="auth-image-text">
                <h3>Join Our Creative Community</h3>
                <p>Discover handmade treasures and share your creations</p>
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