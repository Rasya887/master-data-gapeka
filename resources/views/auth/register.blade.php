@extends('layouts.app')

@section('content')
<style>
    :root {
        --kai-orange: #FF6B35;
        --kai-blue: #1E3A8A;
        --kai-light-blue: #3B82F6;
        --kai-dark-blue: #1E40AF;
        --kai-white: #FFFFFF;
        --kai-gray-light: #F8FAFC;
        --kai-gray-medium: #E2E8F0;
        --kai-shadow: rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 50%, var(--kai-orange) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .register-card {
        background: var(--kai-white);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 500px;
        width: 100%;
        position: relative;
    }

    .register-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 50%, var(--kai-orange) 100%);
    }

    .card-header {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        text-align: center;
        padding: 30px 20px;
        border: none;
        position: relative;
    }

    .card-header::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 15px solid transparent;
        border-right: 15px solid transparent;
        border-top: 10px solid var(--kai-dark-blue);
    }

    .card-header h4 {
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .card-body {
        padding: 40px 30px 30px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        color: var(--kai-blue);
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
        font-size: 0.95rem;
    }

    .form-control {
        border: 2px solid var(--kai-gray-medium);
        border-radius: 12px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--kai-gray-light);
        padding-right: 50px;
    }

    .form-control:focus {
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        background: var(--kai-white);
        outline: none;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        background: #fff5f5;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    .btn-register {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        border: none;
        border-radius: 12px;
        padding: 15px 30px;
        font-size: 1rem;
        font-weight: 600;
        color: var(--kai-white);
        width: 100%;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(255, 107, 53, 0.3);
        background: linear-gradient(135deg, #FF8A65 0%, var(--kai-orange) 100%);
    }

    .logo-section {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: var(--kai-white);
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .decorative-line {
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
        margin: 0 auto 20px;
        border-radius: 2px;
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kai-gray-medium);
        font-size: 1.1rem;
    }

    .form-section {
        margin-bottom: 30px;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 576px) {
        .register-card {
            margin: 10px;
            border-radius: 15px;
        }
        
        .card-body {
            padding: 30px 20px;
        }
        
        .card-header {
            padding: 25px 15px;
        }
    }
</style>

<div class="register-container">
    <div class="register-card">
        <div class="card-header">
            <div class="logo-section">
                <div class="logo-icon">🚂</div>
                <div class="decorative-line"></div>
            </div>
            <h4>{{ __('Register') }}</h4>
        </div>
        
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="form-section">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <div style="position: relative;">
                            <input id="name" 
                                   type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autocomplete="name" 
                                   autofocus
                                   placeholder="Masukkan nama lengkap">
                            <span class="input-icon">👤</span>
                        </div>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <div style="position: relative;">
                            <input id="email" 
                                   type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   required 
                                   autocomplete="email"
                                   placeholder="Masukkan email Anda">
                            <span class="input-icon">📧</span>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div style="position: relative;">
                            <input id="password" 
                                   type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Masukkan password">
                            <span class="input-icon">🔒</span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <div style="position: relative;">
                            <input id="password-confirm" 
                                   type="password" 
                                   class="form-control" 
                                   name="password_confirmation" 
                                   required 
                                   autocomplete="new-password"
                                   placeholder="Konfirmasi password">
                            <span class="input-icon">🔐</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-register">
                    {{ __('Register') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection