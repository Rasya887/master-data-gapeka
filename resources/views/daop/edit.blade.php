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
        --kai-gray-dark: #64748B;
        --kai-shadow: rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 50%, var(--kai-orange) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        padding: 40px 20px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-card {
        background: var(--kai-white);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 600px;
        width: 100%;
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
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .form-subtitle {
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

    .form-body {
        padding: 50px 40px;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--kai-blue);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: var(--kai-white);
        color: var(--kai-blue);
        font-weight: 500;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: var(--kai-light-blue);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .button-group {
        display: flex;
        gap: 15px;
        margin-top: 40px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        color: var(--kai-white);
        border: none;
        padding: 15px 35px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .btn-secondary {
        background: linear-gradient(135deg, var(--kai-gray-dark) 0%, #475569 100%);
        color: var(--kai-white);
        border: none;
        padding: 15px 35px;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
        cursor: pointer;
        font-size: 1rem;
    }

    .btn-secondary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(100, 116, 139, 0.4);
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

    .floating-train {
        position: absolute;
        font-size: 1.5rem;
        opacity: 0.08;
        animation: float 8s ease-in-out infinite;
    }

    .floating-train:nth-child(1) {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .floating-train:nth-child(2) {
        top: 70%;
        right: 10%;
        animation-delay: 4s;
    }

    .floating-train:nth-child(3) {
        bottom: 15%;
        left: 80%;
        animation-delay: 2s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-15px) rotate(3deg);
        }
    }

    .input-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kai-gray-dark);
        font-size: 1.2rem;
        pointer-events: none;
        opacity: 0.6;
    }

    .form-group:nth-child(1) .input-icon::before { content: '🏢'; }
    .form-group:nth-child(2) .input-icon::before { content: '🔤'; }
    .form-group:nth-child(3) .input-icon::before { content: '📝'; }
    .form-group:nth-child(4) .input-icon::before { content: '🚂'; }
    .form-group:nth-child(5) .input-icon::before { content: '🌐'; }
    .form-group:nth-child(6) .input-icon::before { content: '🚌'; }

    /* Form validation styles */
    .form-control:required:valid {
        border-color: #10B981;
    }

    .form-control:required:invalid {
        border-color: #EF4444;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-title {
            font-size: 1.6rem;
        }
        
        .form-body {
            padding: 30px 20px;
        }
        
        .button-group {
            flex-direction: column;
            align-items: stretch;
        }
        
        .btn-primary,
        .btn-secondary {
            width: 100%;
            justify-content: center;
        }
    }

    /* Loading animation */
    .btn-primary:active {
        transform: scale(0.98);
    }

    .form-control:focus + .input-icon {
        opacity: 1;
        color: var(--kai-orange);
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="floating-elements">
            <div class="floating-train">✏️</div>
            <div class="floating-train">🏢</div>
            <div class="floating-train">📝</div>
        </div>
        
        <div class="form-header">
            <div class="header-icon">✏️</div>
            <div class="decorative-line"></div>
            <h2 class="form-title">Edit Daop</h2>
            <p class="form-subtitle">Ubah Data Daerah Operasi</p>
        </div>
        
        <div class="form-body">
            <form action="{{ route('daop.update', $daop->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" 
                           name="nama" 
                           id="nama"
                           class="form-control" 
                           value="{{ $daop->nama }}" 
                           required
                           placeholder="Masukkan nama daop">
                    <div class="input-icon"></div>
                </div>

                <div class="form-group">
                    <label for="singkatan" class="form-label">Singkatan</label>
                    <input type="text" 
                           name="singkatan" 
                           id="singkatan"
                           class="form-control" 
                           value="{{ $daop->singkatan }}"
                           placeholder="Masukkan singkatan">
                    <div class="input-icon"></div>
                </div>

                <div class="form-group">
                    <label for="nomenklatur" class="form-label">Nomenklatur</label>
                    <input type="text" 
                           name="nomenklatur" 
                           id="nomenklatur"
                           class="form-control" 
                           value="{{ $daop->nomenklatur }}"
                           placeholder="Masukkan nomenklatur">
                    <div class="input-icon"></div>
                </div>

                <div class="form-group">
                    <label for="daop" class="form-label">Daop</label>
                    <input type="text" 
                           name="daop" 
                           id="daop"
                           class="form-control" 
                           value="{{ $daop->daop }}"
                           placeholder="Masukkan daop">
                    <div class="input-icon"></div>
                </div>

                <div class="form-group">
                    <label for="id_region" class="form-label">ID Region</label>
                    <input type="text" 
                           name="id_region" 
                           id="id_region"
                           class="form-control" 
                           value="{{ $daop->id_region }}"
                           placeholder="Masukkan ID region">
                    <div class="input-icon"></div>
                </div>

                <div class="form-group">
                    <label for="bus_area" class="form-label">Bus Area</label>
                    <input type="text" 
                           name="bus_area" 
                           id="bus_area"
                           class="form-control" 
                           value="{{ $daop->bus_area }}"
                           placeholder="Masukkan bus area">
                    <div class="input-icon"></div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-primary">
                        <span>💾</span>
                        Update
                    </button>
                    <a href="{{ route('daop.index') }}" class="btn-secondary">
                        <span>❌</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection