<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">Edit User</h2>
    </x-slot>

    <style>
        :root {
            --kai-orange: #FF6B35;
            --kai-blue: #1E3A8A;
            --kai-light-blue: #3B82F6;
            --kai-dark-blue: #1E40AF;
            --kai-white: #FFFFFF;
            --kai-gray-light: #F8FAFC;
            --kai-gray-medium: #E2E8F0;
            --kai-gray-dark: #64748B;
            --kai-shadow: rgba(0, 0, 0, 0.1);
            --kai-green: #10B981;
            --kai-red: #EF4444;
            --kai-yellow: #F59E0B;
        }

        body {
            background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 50%, var(--kai-orange) 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .form-container {
            padding: 40px 20px;
            min-height: 100vh;
        }

        .form-card {
            background: var(--kai-white);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
        }

        .form-header {
            background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
            color: var(--kai-white);
            text-align: center;
            padding: 40px 30px;
            position: relative;
        }

        .form-header::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 20px solid transparent;
            border-right: 20px solid transparent;
            border-top: 15px solid var(--kai-dark-blue);
        }

        .header-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-white) 100%);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 15px;
            box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .form-subtitle {
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .decorative-line {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-white) 100%);
            margin: 15px auto;
            border-radius: 2px;
        }

        .form-body {
            padding: 50px 40px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: var(--kai-dark-blue);
            margin-bottom: 8px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-label::before {
            content: '';
            display: inline-block;
            width: 4px;
            height: 16px;
            background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
            margin-right: 8px;
            border-radius: 2px;
        }

        .form-control {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--kai-gray-medium);
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--kai-white);
            color: var(--kai-dark-blue);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--kai-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: var(--kai-gray-dark);
            opacity: 0.7;
        }

        .form-select {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid var(--kai-gray-medium);
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: var(--kai-white);
            color: var(--kai-dark-blue);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--kai-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--kai-gray-dark);
            font-size: 1.2rem;
            pointer-events: none;
            margin-top: 15px;
        }

        .button-group {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8C42 100%);
            color: var(--kai-white);
            border: none;
            padding: 15px 30px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
            cursor: pointer;
            font-size: 0.9rem;
            min-width: 120px;
            justify-content: center;
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
            text-decoration: none;
            color: var(--kai-white);
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, var(--kai-gray-dark) 0%, #94A3B8 100%);
            color: var(--kai-white);
            border: none;
            padding: 15px 30px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
            cursor: pointer;
            font-size: 0.9rem;
            min-width: 120px;
            justify-content: center;
        }

        .btn-secondary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(100, 116, 139, 0.4);
            text-decoration: none;
            color: var(--kai-white);
        }

        .floating-elements {
            position: absolute;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .floating-user {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.05;
            animation: float 10s ease-in-out infinite;
        }

        .floating-user:nth-child(1) {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-user:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        .floating-user:nth-child(3) {
            bottom: 20%;
            left: 70%;
            animation-delay: 2.5s;
        }

        .password-hint {
            font-size: 0.8rem;
            color: var(--kai-gray-dark);
            margin-top: 5px;
            font-style: italic;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .form-title {
                font-size: 1.4rem;
            }
            
            .form-body {
                padding: 30px 20px;
            }
            
            .button-group {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-primary-custom,
            .btn-secondary-custom {
                width: 100%;
            }
        }
    </style>

    <div class="form-container">
        <div class="form-card">
            <div class="floating-elements">
                <div class="floating-user">👤</div>
                <div class="floating-user">✏️</div>
                <div class="floating-user">🔐</div>
            </div>
            
            <div class="form-header">
                <div class="header-icon">✏️</div>
                <div class="decorative-line"></div>
                <h1 class="form-title">Edit User</h1>
                <p class="form-subtitle">Perbarui Informasi User</p>
            </div>
            
            <div class="form-body">
                <form action="{{ route('users.update', $user) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">👤 Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" placeholder="Masukkan nama lengkap" required>
                        <div class="input-icon">👤</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">📧 Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="Masukkan alamat email" required>
                        <div class="input-icon">📧</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">🔒 Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                        <div class="input-icon">🔒</div>
                        <div class="password-hint">Kosongkan jika tidak ingin mengubah password</div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">🔐 Role</label>
                        <select name="role" class="form-select" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-icon">🔐</div>
                    </div>
                    
                    <div class="button-group">
                        <button type="submit" class="btn-primary-custom">
                            <span>💾</span>
                            Update
                        </button>
                        <a href="{{ route('users.index') }}" class="btn-secondary-custom">
                            <span>↩️</span>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>