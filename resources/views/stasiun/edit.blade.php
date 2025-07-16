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
        --kai-green: #10B981;
        --kai-red: #EF4444;
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
        max-width: 1000px;
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

    .form-section {
        margin-bottom: 40px;
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--kai-blue);
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid var(--kai-gray-medium);
        position: relative;
    }

    .section-title::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 60px;
        height: 2px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--kai-blue);
        margin-bottom: 8px;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
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
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: var(--kai-light-blue);
    }

    .form-control[readonly] {
        background: var(--kai-gray-light);
        border-color: var(--kai-gray-medium);
        color: var(--kai-gray-dark);
    }

    .form-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23FF6B35' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 12px center;
        background-repeat: no-repeat;
        background-size: 16px 12px;
        padding-right: 45px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: -10px;
    }

    .col-md-2, .col-md-4, .col-md-6 {
        padding: 10px;
    }

    .col-md-2 { flex: 0 0 16.666667%; }
    .col-md-4 { flex: 0 0 33.333333%; }
    .col-md-6 { flex: 0 0 50%; }

    .toggle-group {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .toggle-item {
        flex: 1;
        min-width: 150px;
    }

    .toggle-select {
        position: relative;
    }

    .toggle-select select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 10px;
        background: var(--kai-white);
        color: var(--kai-blue);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .toggle-select select:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
    }

    .toggle-select select[value="1"] {
        border-color: var(--kai-green);
        background: rgba(16, 185, 129, 0.1);
    }

    .toggle-select select[value="0"] {
        border-color: var(--kai-gray-dark);
        background: rgba(100, 116, 139, 0.1);
    }

    .button-group {
        display: flex;
        gap: 15px;
        justify-content: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid var(--kai-gray-medium);
    }

    .btn {
        padding: 15px 35px;
        border: none;
        border-radius: 25px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 1rem;
        min-width: 140px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        color: var(--kai-white);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
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
        box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
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

    .required::after {
        content: ' *';
        color: var(--kai-red);
        font-weight: bold;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .form-title {
            font-size: 1.6rem;
        }
        
        .form-body {
            padding: 30px 20px;
        }
        
        .col-md-2, .col-md-4, .col-md-6 {
            flex: 0 0 100%;
        }
        
        .toggle-group {
            flex-direction: column;
        }
        
        .button-group {
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 992px) {
        .col-md-2 { flex: 0 0 50%; }
        .col-md-4 { flex: 0 0 100%; }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="floating-elements">
            <div class="floating-train">🚉</div>
            <div class="floating-train">📝</div>
            <div class="floating-train">🛤️</div>
        </div>
        
        <div class="form-header">
            <div class="header-icon">{{ isset($stasiun) ? '✏️' : '➕' }}</div>
            <div class="decorative-line"></div>
            <h3 class="form-title">{{ isset($stasiun) ? 'Edit' : 'Tambah' }} Stasiun</h3>
            <p class="form-subtitle">{{ isset($stasiun) ? 'Perbarui informasi stasiun' : 'Tambah data stasiun baru' }}</p>
        </div>
        
        <div class="form-body">
            <form action="{{ isset($stasiun) ? route('stasiun.update', $stasiun->id) : route('stasiun.store') }}" method="POST">
                @csrf
                @if(isset($stasiun))
                    @method('PUT')
                @endif

                <div class="form-section">
                    <h4 class="section-title">🏢 Informasi Dasar</h4>
                    
                    <div class="form-group">
                        <label for="id_daop" class="form-label required">Daop</label>
                        <select name="id_daop" class="form-control form-select" required>
                            <option value="">Pilih Daop</option>
                            @foreach ($daops as $daop)
                                <option value="{{ $daop->id }}" {{ old('id_daop', $stasiun->id_daop ?? '') == $daop->id ? 'selected' : '' }}>
                                    {{ $daop->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label required">Singkatan</label>
                                <input type="text" name="singkatan" class="form-control" value="{{ old('singkatan', $stasiun->singkatan ?? '') }}" required placeholder="Masukkan singkatan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label required">Nama Stasiun</label>
                                <input type="text" name="nama" class="form-control" value="{{ old('nama', $stasiun->nama ?? '') }}" required placeholder="Masukkan nama stasiun">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">DPL</label>
                                <input type="number" step="0.01" name="dpl" class="form-control" value="{{ old('dpl', $stasiun->dpl ?? '') }}" placeholder="Masukkan DPL">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Kode</label>
                                <input type="text" name="kode" class="form-control" value="{{ old('kode', $stasiun->kode ?? '') }}" placeholder="Masukkan kode">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Track</label>
                                <input type="text" name="track" class="form-control" value="{{ old('track', $stasiun->track ?? '') }}" placeholder="Masukkan track">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">PPKT</label>
                                <select name="ppkt" class="form-control form-select">
                                    <option value="0" {{ old('ppkt', $stasiun->ppkt ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('ppkt', $stasiun->ppkt ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">⚙️ Konfigurasi Stasiun</h4>
                    
                    <div class="toggle-group">
                        @foreach (['aktif' => 'Aktif', 'kotak' => 'Kotak', 'garis_tipis' => 'Garis Tipis', 'garis_tebal' => 'Garis Tebal', 'perhentian' => 'Perhentian', 'batas_daop' => 'Batas Daop'] as $field => $label)
                            <div class="toggle-item">
                                <label class="form-label">{{ $label }}</label>
                                <div class="toggle-select">
                                    <select name="{{ $field }}" class="form-control" value="{{ old($field, $stasiun->$field ?? 0) }}">
                                        <option value="0" {{ old($field, $stasiun->$field ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                                        <option value="1" {{ old($field, $stasiun->$field ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                                    </select>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-section">
                    <h4 class="section-title">📝 Informasi Sistem</h4>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Created By</label>
                                <input type="text" name="created_by" class="form-control" value="{{ old('created_by', $stasiun->created_by ?? '') }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Updated By</label>
                                <input type="text" name="updated_by" class="form-control" value="{{ old('updated_by', $stasiun->updated_by ?? '') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">
                        <span>{{ isset($stasiun) ? '💾' : '➕' }}</span>
                        {{ isset($stasiun) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('stasiun.index') }}" class="btn btn-secondary">
                        <span>❌</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection