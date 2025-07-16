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
        max-width: 900px;
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

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
        margin-bottom: 25px;
    }

    .form-group {
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

    .form-control select {
        cursor: pointer;
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

    .floating-train:nth-child(4) {
        top: 40%;
        right: 60%;
        animation-delay: 6s;
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

    /* Form validation styles */
    .form-control:required:valid {
        border-color: #10B981;
    }

    .form-control:required:invalid {
        border-color: #EF4444;
    }

    /* Alert styles */
    .alert {
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 30px;
        border: none;
        font-weight: 500;
    }

    .alert-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: #DC2626;
        border-left: 5px solid #EF4444;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
    }

    .alert li {
        margin-bottom: 5px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-title {
            font-size: 1.6rem;
        }
        
        .form-body {
            padding: 30px 20px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
            gap: 20px;
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
            <div class="floating-train">🚂</div>
            <div class="floating-train">📏</div>
            <div class="floating-train">🛤️</div>
            <div class="floating-train">⚡</div>
        </div>
        
        <div class="form-header">
            <div class="header-icon">📏</div>
            <div class="decorative-line"></div>
            <h2 class="form-title">{{ isset($jarak) ? 'Edit' : 'Tambah' }} Data Jarak</h2>
            <p class="form-subtitle">Kelola Data Jarak Antar Stasiun</p>
        </div>
        
        <div class="form-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($jarak) ? route('jarak.update', $jarak->id) : route('jarak.store') }}" method="POST">
                @csrf
                @if (isset($jarak))
                    @method('PUT')
                @endif

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_daop" class="form-label">Daop</label>
                        <input type="number" 
                               name="id_daop" 
                               id="id_daop"
                               class="form-control" 
                               value="{{ old('id_daop', $jarak->id_daop ?? '') }}" 
                               required
                               placeholder="ID Daop">
                        <div class="input-icon">🏢</div>
                    </div>

                    <div class="form-group">
                        <label for="id_stasiun" class="form-label">Stasiun</label>
                        <input type="number" 
                               name="id_stasiun" 
                               id="id_stasiun"
                               class="form-control" 
                               value="{{ old('id_stasiun', $jarak->id_stasiun ?? '') }}" 
                               required
                               placeholder="ID Stasiun">
                        <div class="input-icon">🚉</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_stasiun_sebelah" class="form-label">Stasiun Sebelah</label>
                        <input type="number" 
                               name="id_stasiun_sebelah" 
                               id="id_stasiun_sebelah"
                               class="form-control" 
                               value="{{ old('id_stasiun_sebelah', $jarak->id_stasiun_sebelah ?? '') }}" 
                               required
                               placeholder="ID Stasiun Sebelah">
                        <div class="input-icon">🚉</div>
                    </div>

                    <div class="form-group">
                        <label for="id_lintas" class="form-label">Lintas</label>
                        <input type="number" 
                               name="id_lintas" 
                               id="id_lintas"
                               class="form-control" 
                               value="{{ old('id_lintas', $jarak->id_lintas ?? '') }}"
                               placeholder="ID Lintas">
                        <div class="input-icon">🛤️</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_tahun_gapeka" class="form-label">Tahun Gapeka</label>
                        <input type="number" 
                               name="id_tahun_gapeka" 
                               id="id_tahun_gapeka"
                               class="form-control" 
                               value="{{ old('id_tahun_gapeka', $jarak->id_tahun_gapeka ?? '') }}"
                               placeholder="ID Tahun Gapeka">
                        <div class="input-icon">📅</div>
                    </div>

                    <div class="form-group">
                        <label for="jarak" class="form-label">Jarak (km)</label>
                        <input type="number" 
                               step="0.01" 
                               name="jarak" 
                               id="jarak"
                               class="form-control" 
                               value="{{ old('jarak', $jarak->jarak ?? '') }}" 
                               required
                               placeholder="Jarak dalam km">
                        <div class="input-icon">📏</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="puncak_kecepatan" class="form-label">Puncak Kecepatan</label>
                        <input type="number" 
                               name="puncak_kecepatan" 
                               id="puncak_kecepatan"
                               class="form-control" 
                               value="{{ old('puncak_kecepatan', $jarak->puncak_kecepatan ?? '') }}" 
                               required
                               placeholder="Kecepatan maksimal">
                        <div class="input-icon">⚡</div>
                    </div>

                    <div class="form-group">
                        <label for="puncak_kecepatan_barang" class="form-label">Puncak Kecepatan Barang</label>
                        <input type="number" 
                               name="puncak_kecepatan_barang" 
                               id="puncak_kecepatan_barang"
                               class="form-control" 
                               value="{{ old('puncak_kecepatan_barang', $jarak->puncak_kecepatan_barang ?? '') }}"
                               placeholder="Kecepatan barang">
                        <div class="input-icon">📦</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="taspat" class="form-label">Taspat</label>
                        <input type="text" 
                               name="taspat" 
                               id="taspat"
                               class="form-control" 
                               value="{{ old('taspat', $jarak->taspat ?? '') }}"
                               placeholder="Taspat">
                        <div class="input-icon">🎯</div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', $jarak->status ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $jarak->status ?? 1) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <div class="input-icon">🔄</div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="approved_at" class="form-label">Approved At</label>
                        <input type="text" 
                               name="approved_at" 
                               id="approved_at"
                               class="form-control" 
                               value="{{ old('approved_at', $jarak->approved_at ?? '') }}"
                               placeholder="Tanggal persetujuan">
                        <div class="input-icon">📅</div>
                    </div>

                    <div class="form-group">
                        <label for="approved_by" class="form-label">Approved By</label>
                        <input type="text" 
                               name="approved_by" 
                               id="approved_by"
                               class="form-control" 
                               value="{{ old('approved_by', $jarak->approved_by ?? '') }}"
                               placeholder="Disetujui oleh">
                        <div class="input-icon">👤</div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn-primary">
                        <span>💾</span>
                        {{ isset($jarak) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('jarak.index') }}" class="btn-secondary">
                        <span>❌</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection