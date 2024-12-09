@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="card p-4 border-0 shadow-lg" style="max-width: 420px; width: 100%; border-radius: 16px;">
        <!-- Card Header -->
        <div class="text-center mb-4">
            <div class="mb-3">
                {{-- //<img src="{{ ('/public/admin_assets/images/login/logo.jpeg)') }}" alt="Logo" class="img-fluid" style="max-width: 80px;"> --}}
                <img src="{{ asset('admin_assets/images/logo/images.jpeg') }}" alt="Logo" class="img-fluid" style="max-width: 100px;">

            </div>
            <h4 class="fw-bold text-primary">{{ __('Bienvenido al SOFT AUDI!') }}</h4>
            <p class="text-muted">{{ __('Ingrese su Cuenta Para Iniciar') }}</p>
        </div>
        <!-- Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email -->
            <div class="form-floating mb-3">
                <input id="email" type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    name="email" value="{{ old('email') }}" 
                    autocomplete="email" autofocus 
                    placeholder="Correo Electronico - Email">
                <label for="email">{{ __('Email Address') }}</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Password -->
            <div class="form-floating mb-3">
                <input id="password" type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    name="password" autocomplete="current-password" 
                    placeholder="Contraseña">
                <label for="password">{{ __('Password') }}</label>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <!-- Remember Me -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Recuerdame') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-primary small">
                        {{ __('Recuperar Contraseña?') }}
                    </a>
                @endif
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                {{ __('Ingresar') }}
            </button>
        </form>
        <!-- Divider -->
        <div class="text-center my-3">
            <span class="text-muted small">{{ __('o Continuar con') }}</span>
        </div>
        <!-- Social Buttons -->
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-secondary w-100">
                <i class="bi bi-google"></i> Google
            </a>
            <a href="#" class="btn btn-outline-secondary w-100">
                <i class="bi bi-facebook"></i> Facebook
            </a>
        </div>
        <!-- Links -->
        <div class="text-center mt-4">
            <p class="small text-muted">
                {{ __('no tengo cuenta crear?') }} 
                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">
                    {{ __('Registrarse') }}
                </a>
            </p>
        </div>
    </div>
</div>

<style>
    body {
        background: linear-gradient(135deg, #f0f4f8, #d9e8fc);
        font-family: 'Inter', sans-serif;
    }

    .card {
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-primary {
        background: #4c6ef5;
        border: none;
    }

    .btn-primary:hover {
        background: #365ed8;
    }

    .btn-outline-secondary {
        border-radius: 8px;
    }

    .btn-outline-secondary:hover {
        background: #f0f4f8;
    }
</style>
@endsection
