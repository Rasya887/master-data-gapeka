<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">Edit Menu</h2>
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

        .edit-container {
            padding: 40px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .edit-card {
            background: var(--kai-white);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 700px;
            width: 100%;
            position: relative;
            backdrop-filter: blur(10px);
        }

        .edit-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
        }

        .edit-header {
            background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
            color: var(--kai-white);
            text-align: center;
            padding: 40px 30px;
            position: relative;
        }

        .edit-header::after {
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

        .edit-title {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .edit-subtitle {
            font-size: 1.1rem;
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

        .edit-body {
            padding: 50px 40px;
        }

        .form-group {
            margin-bottom: 25px;
            animation: slideInUp 0.6s ease-out;
            animation-fill-mode: both;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }

        .form-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--kai-blue);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            background: var(--kai-gray-light);
            border: 2px solid var(--kai-gray-medium);
            border-radius: 15px;
            padding: 15px 20px;
            font-size: 1rem;
            font-weight: 500;
            color: var(--kai-dark-blue);
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--kai-orange);
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
            background: var(--kai-white);
        }

        .form-control:hover, .form-select:hover {
            border-color: var(--kai-light-blue);
            background: var(--kai-white);
        }

        .form-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 40px;
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
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
            text-decoration: none;
            color: var(--kai-white);
        }

        .btn-secondary-custom {
            background: linear-gradient(135deg, var(--kai-gray-dark) 0%, #475569 100%);
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

        .floating-edit {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.05;
            animation: float 10s ease-in-out infinite;
        }

        .floating-edit:nth-child(1) {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-edit:nth-child(2) {
            top: 60%;
            right: 15%;
            animation-delay: 5s;
        }

        .floating-edit:nth-child(3) {
            bottom: 20%;
            left: 70%;
            animation-delay: 2.5s;
        }

        .floating-edit:nth-child(4) {
            top: 30%;
            right: 45%;
            animation-delay: 7.5s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .edit-title {
                font-size: 1.6rem;
            }
            
            .edit-body {
                padding: 30px 20px;
            }
            
            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }
            
            .btn-primary-custom,
            .btn-secondary-custom {
                justify-content: center;
            }
        }
    </style>

    <div class="edit-container">
        <div class="edit-card">
            <div class="floating-elements">
                <div class="floating-edit">✏️</div>
                <div class="floating-edit">📝</div>
                <div class="floating-edit">🎯</div>
                <div class="floating-edit">⚙️</div>
            </div>
            
            <div class="edit-header">
                <div class="header-icon">✏️</div>
                <div class="decorative-line"></div>
                <h1 class="edit-title">Edit Menu</h1>
                <p class="edit-subtitle">Perbarui Informasi Menu</p>
            </div>
            
            <div class="edit-body">
                <form action="{{ route('menus.update', $menu) }}" method="POST">
                    @csrf 
                    @method('PUT')
                    
                    <div class="form-group">
                        <label class="form-label">
                            <span>📝</span>
                            Nama Menu
                        </label>
                        <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <span>🔗</span>
                            Route
                        </label>
                        <input type="text" name="route" class="form-control" value="{{ $menu->route }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <span>🎨</span>
                            Icon
                        </label>
                        <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <span>📊</span>
                            Urutan
                        </label>
                        <input type="number" name="menu_order" class="form-control" value="{{ old('menu_order', 0) }}">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">
                            <span>🔄</span>
                            Status
                        </label>
                        <select name="is_active" class="form-select">
                            <option value="1" {{ $menu->is_active ? 'selected' : '' }}>✅ Aktif</option>
                            <option value="0" {{ !$menu->is_active ? 'selected' : '' }}>❌ Nonaktif</option>
                        </select>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-primary-custom">
                            <span>💾</span>
                            Update
                        </button>
                        <a href="{{ route('menus.index') }}" class="btn-secondary-custom">
                            <span>⬅️</span>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>