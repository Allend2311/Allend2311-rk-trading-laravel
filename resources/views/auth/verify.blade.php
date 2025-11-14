@extends('layouts.app')

@section('title', 'Verify Email - RK Trading')

@section('content')
<div class="login-container">
    <!-- Animated Gradient Background -->
    <div class="animated-background"></div>

    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- Decorative Icons -->
    <div class="decorative-icons">
        <div class="icon icon-sun">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="5"></circle>
                <line x1="12" y1="1" x2="12" y2="3"></line>
                <line x1="12" y1="21" x2="12" y2="23"></line>
                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                <line x1="1" y1="12" x2="3" y2="12"></line>
                <line x1="21" y1="12" x2="23" y2="12"></line>
                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
            </svg>
        </div>
        <div class="icon icon-leaf">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                <line x1="16" y1="8" x2="2" y2="22"></line>
                <line x1="17.5" y1="15" x2="9" y2="15"></line>
            </svg>
        </div>
    </div>

    <!-- Verification Card -->
    <div class="login-card">
        <div class="card-header">
            <div class="logo">
                <div class="logo-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="5"></circle>
                        <line x1="12" y1="1" x2="12" y2="3"></line>
                        <line x1="12" y1="21" x2="12" y2="23"></line>
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                        <line x1="1" y1="12" x2="3" y2="12"></line>
                        <line x1="21" y1="12" x2="23" y2="12"></line>
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                    </svg>
                </div>
            </div>
            <div class="title">
                <h1>RK Trading</h1>
                <p>Verify Your Email</p>
            </div>
        </div>

        <div class="card-content">
            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            <p class="verification-message">
                We've sent a 6-digit verification code to <strong>{{ session('verification_email') }}</strong>.
                Please enter the code below to complete your registration.
            </p>

            <form method="POST" action="{{ route('auth.verify') }}" class="login-form">
                @csrf

                <!-- Verification Code -->
                <div class="form-group">
                    <label for="code">Verification Code</label>
                    <div class="input-group">
                        <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <circle cx="12" cy="16" r="1"></circle>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <input
                            type="text"
                            id="code"
                            name="code"
                            placeholder="Enter 6-digit code"
                            maxlength="6"
                            pattern="[0-9]{6}"
                            value="{{ old('code') }}"
                            required
                        >
                    </div>
                </div>

                <!-- Verify Button -->
                <button type="submit" class="signin-btn">
                    <span>Verify</span>
                </button>

                <!-- Back to Sign Up -->
                <div class="signup-link">
                    <a href="{{ route('auth.register') }}">Back to Sign Up</a>
                </div>
            </form>

            <!-- Powered by Renewable Energy -->
            <div class="powered-by">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                    <line x1="16" y1="8" x2="2" y2="22"></line>
                    <line x1="17.5" y1="15" x2="9" y2="15"></line>
                </svg>
                <span>Powered by Renewable Energy</span>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/script.js') }}"></script>
@endpush
