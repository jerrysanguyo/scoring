@extends('layouts.auth.login')

@section('content')
<div class="min-vh-100 d-flex justify-content-center align-items-center">
    <div class="card shadow-lg rounded-4 mx-3" style="max-width: 800px; width: 100%;">
        <div class="d-flex flex-column flex-md-row g-0">
            <div
                class="flex-shrink-0 d-flex justify-content-center align-items-center p-4 bg-white rounded-top-4 rounded-md-start-4">
                <a href="{{ url('/') }}" class="text-center">
                    <img src="{{ asset('image/logo.webp') }}" alt="Logo" class="img-fluid"
                        style="max-height: 200px; animation: bounceIn 1s;" />
                </a>
            </div>
            
            <div class="flex-fill">
                <div class="card-body p-4 p-md-5">
                    <h2 class="fw-bold text-black text-center mb-3">Welcome Back</h2>
                    <p class="text-center text-black-50 mb-4">Sign in to access the admin panel</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input id="email" type="email"
                                class="form-control form-control-lg @error('email') is-invalid @enderror rounded-3"
                                name="email" value="{{ old('email') }}" placeholder="name@example.com" required
                                autocomplete="email" autofocus>
                            <label for="email">Email address</label>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input id="password" type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror rounded-3"
                                name="password" placeholder="Password" required autocomplete="current-password">
                            <label for="password">Password</label>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div
                            class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4">
                            <div class="form-check mb-2 mb-sm-0">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label text-black" for="remember">Remember me</label>
                            </div>
                            <!-- <a href="{{ route('password.request') }}" class="text-black text-decoration-none">Forgot Password?</a> -->
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit"
                                class="btn btn-outline-primary btn-lg rounded-3 fw-semibold">Login</button>
                        </div>

                        <p class="text-center text-black-50 mb-0 small">
                            Kindly ask the admin for account creation
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media (max-width: 767.98px) {
    .card-body {
        padding: 2rem 1.5rem !important;
    }
}

@keyframes bounceIn {
    0% {
        transform: scale(0.5);
        opacity: 0;
    }

    60% {
        transform: scale(1.1);
        opacity: 1;
    }

    100% {
        transform: scale(1);
    }
}
</style>
@endsection