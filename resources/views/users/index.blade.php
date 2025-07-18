@extends('layouts.app')

@section('title', 'Manajemen User')

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

    .management-container {
        padding: 40px 20px;
        min-height: 100vh;
    }

    .management-card {
        background: var(--kai-white);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .management-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
    }

    .management-header {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        text-align: center;
        padding: 40px 30px;
        position: relative;
    }

    .management-header::after {
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

    .management-title {
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .management-subtitle {
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

    .management-body {
        padding: 50px 40px;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-bottom: 30px;
        flex-wrap: wrap;
        align-items: center;
        margin-left: 30px;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8C42 100%);
        color: var(--kai-white);
        border: none;
        padding: 12px 25px;
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

    .btn-home {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 100%);
        color: var(--kai-white);
        border: none;
        padding: 12px 25px;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(30, 58, 138, 0.3);
        cursor: pointer;
        font-size: 0.9rem;
    }

    .btn-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 58, 138, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .alert-success {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        color: var(--kai-white);
        border: none;
        border-radius: 15px;
        padding: 15px 20px;
        margin-bottom: 25px;
        font-weight: 600;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
    }

    .table-container {
        background: var(--kai-gray-light);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    .table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        background: var(--kai-white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    }

    .table thead th {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px 15px;
        border: none;
        font-size: 0.9rem;
        text-align: center;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }

    .table tbody tr:hover {
        background: linear-gradient(135deg, #FFF7ED 0%, var(--kai-gray-light) 100%);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .table tbody td {
        padding: 18px 15px;
        border: none;
        border-bottom: 1px solid var(--kai-gray-medium);
        vertical-align: middle;
        text-align: center;
        font-weight: 500;
        color: var(--kai-dark-blue);
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8C42 100%);
        color: var(--kai-white);
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }

    .btn-sm {
        padding: 8px 15px;
        font-size: 0.8rem;
        border-radius: 15px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        margin: 0 3px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--kai-yellow) 0%, #FCD34D 100%);
        color: var(--kai-white);
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
    }

    .btn-warning:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        color: var(--kai-white);
        text-decoration: none;
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--kai-red) 0%, #F87171 100%);
        color: var(--kai-white);
        box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        color: var(--kai-white);
    }

    .action-buttons-cell {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        flex-wrap: wrap;
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

    .floating-user:nth-child(4) {
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
        .management-title {
            font-size: 1.6rem;
        }
        
        .management-body {
            padding: 30px 20px;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table-container {
            padding: 20px;
        }
        
        .table thead th,
        .table tbody td {
            padding: 12px 8px;
            font-size: 0.8rem;
        }
        
        .btn-sm {
            padding: 6px 10px;
            font-size: 0.7rem;
        }
    }
</style>

<div class="management-container">
    <div class="management-card">
        <div class="floating-elements">
            <div class="floating-user">👤</div>
            <div class="floating-user">👥</div>
            <div class="floating-user">👨‍💼</div>
            <div class="floating-user">🔐</div>
        </div>
        
        <div class="management-header">
            <div class="header-icon">👥</div>
            <div class="decorative-line"></div>
            <h1 class="management-title">Manajemen User</h1>
            <p class="management-subtitle">Kelola User Sistem Dengan Mudah</p>
        </div>
        
        <div class="management-body">
            <div class="action-buttons">
                <a href="/dashboard" class="btn-home">
                    <span>🏠</span>
                    Dashboard
                </a>
                <a href="{{ route('users.create') }}" class="btn-primary-custom">
                    <span>➕</span>
                    Tambah User
                </a>
            </div>

            @if(session('success'))
                <div class="alert-success">
                    <span>✅</span>
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>👤 Nama</th>
                            <th>📧 Email</th>
                            <th>🔐 Role</th>
                            <th>⚡ Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="role-badge">
                                        <span>👨‍💼</span>
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons-cell">
                                        <a href="{{ route('users.edit', $user) }}" class="btn-sm btn-warning">
                                            <span>✏️</span>
                                            Edit
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                <span>🗑️</span>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection