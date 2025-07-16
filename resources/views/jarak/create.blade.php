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

    .alert {
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 15px;
        border: 2px solid var(--kai-red);
        background: rgba(239, 68, 68, 0.1);
        color: var(--kai-red);
        font-weight: 500;
    }

    .alert ul {
        margin: 0;
        padding-left: 20px;
        list-style: none;
    }

    .alert li {
        margin-bottom: 5px;
        position: relative;
        padding-left: 20px;
    }

    .alert li::before {
        content: '❌';
        position: absolute;
        left: 0;
        top: 0;
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: var(--kai-blue);
        margin-bottom: 8px;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        padding-left: 30px;
    }

    /* Form label icons */
    .form-label[for="id_daop"]::before { content: '🏢'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="id_stasiun"]::before { content: '🚉'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="id_stasiun_sebelah"]::before { content: '🚏'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="id_lintas"]::before { content: '🛤️'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="id_tahun_gapeka"]::before { content: '📅'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="jarak"]::before { content: '📏'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="puncak_kecepatan"]::before { content: '🚄'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="taspat"]::before { content: '🎯'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="puncak_kecepatan_barang"]::before { content: '🚂'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="status"]::before { content: '✅'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="approved_at"]::before { content: '⏰'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="approved_by"]::before { content: '👤'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 15px;
        font-size: 1rem;
        font-weight: 500;
        color: var(--kai-blue);
        background: var(--kai-white);
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
        transform: translateY(-2px);
    }

    .form-control:hover {
        border-color: var(--kai-light-blue);
        transform: translateY(-1px);
    }

    .form-control[readonly] {
        background: var(--kai-gray-light);
        cursor: not-allowed;
        opacity: 0.7;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }

    .form-col {
        flex: 1;
    }

    .form-col-2 {
        flex: 0 0 calc(16.666% - 17px);
    }

    .form-col-4 {
        flex: 0 0 calc(33.333% - 14px);
    }

    .form-col-6 {
        flex: 0 0 calc(50% - 10px);
    }

    /* Section dividers */
    .form-section {
        margin: 40px 0;
        padding: 30px;
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.03) 100%);
        border-radius: 20px;
        border-left: 5px solid var(--kai-orange);
        position: relative;
    }

    .form-section::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-blue) 100%);
        border-radius: 22px;
        z-index: -1;
        opacity: 0.1;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--kai-blue);
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        padding-left: 35px;
    }

    /* Section title icons */
    .section-title.basic::before { content: '🏢'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 1.5rem; }
    .section-title.distance::before { content: '📏'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 1.5rem; }
    .section-title.speed::before { content: '🚄'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 1.5rem; }
    .section-title.approval::before { content: '✅'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); font-size: 1.5rem; }

    /* Button styling */
    .btn {
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
        cursor: pointer;
        font-size: 1rem;
        margin-right: 15px;
        margin-bottom: 10px;
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

    .button-container {
        text-align: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid var(--kai-gray-medium);
    }

    /* Floating elements */
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

    /* Select dropdown styling */
    .form-control select {
        appearance: none;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23FF6B35' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 20px;
        padding-right: 50px;
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
            flex-direction: column;
            gap: 0;
        }
        
        .form-col,
        .form-col-2,
        .form-col-4,
        .form-col-6 {
            flex: 1;
        }
        
        .btn {
            width: 100%;
            margin-right: 0;
            margin-bottom: 15px;
            justify-content: center;
        }
    }
</style>

<div class="form-container">
    <div class="form-card">
        <div class="floating-elements">
            <div class="floating-train">🚉</div>
            <div class="floating-train">🚂</div>
            <div class="floating-train">🛤️</div>
        </div>
        
        <div class="form-header">
            <div class="header-icon">{{ isset($jarak) ? '✏️' : '➕' }}</div>
            <div class="decorative-line"></div>
            <h4 class="form-title">{{ isset($jarak) ? 'Edit' : 'Tambah' }} Data Jarak</h4>
            <p class="form-subtitle">{{ isset($jarak) ? 'Perbarui Data Jarak Stasiun' : 'Tambah Data Jarak Stasiun Baru' }}</p>
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

                <!-- Basic Information Section -->
                <div class="form-section">
                    <div class="section-title basic">Informasi Dasar</div>
                    
                    <div class="form-row">
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="id_daop" class="form-label">Daop</label>
                                <input type="number" name="id_daop" id="id_daop" class="form-control" value="{{ old('id_daop', $jarak->id_daop ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="id_stasiun" class="form-label">Stasiun</label>
                                <input type="number" name="id_stasiun" id="id_stasiun" class="form-control" value="{{ old('id_stasiun', $jarak->id_stasiun ?? '') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="id_stasiun_sebelah" class="form-label">Stasiun Sebelah</label>
                                <input type="number" name="id_stasiun_sebelah" id="id_stasiun_sebelah" class="form-control" value="{{ old('id_stasiun_sebelah', $jarak->id_stasiun_sebelah ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="id_lintas" class="form-label">Lintas</label>
                                <input type="number" name="id_lintas" id="id_lintas" class="form-control" value="{{ old('id_lintas', $jarak->id_lintas ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="id_tahun_gapeka" class="form-label">Tahun Gapeka</label>
                        <input type="number" name="id_tahun_gapeka" id="id_tahun_gapeka" class="form-control" value="{{ old('id_tahun_gapeka', $jarak->id_tahun_gapeka ?? '') }}">
                    </div>
                </div>

                <!-- Distance Information Section -->
                <div class="form-section">
                    <div class="section-title distance">Informasi Jarak</div>
                    
                    <div class="form-row">
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="jarak" class="form-label">Jarak (km)</label>
                                <input type="number" step="0.01" name="jarak" id="jarak" class="form-control" value="{{ old('jarak', $jarak->jarak ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="taspat" class="form-label">Taspat</label>
                                <input type="text" name="taspat" id="taspat" class="form-control" value="{{ old('taspat', $jarak->taspat ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Speed Information Section -->
                <div class="form-section">
                    <div class="section-title speed">Informasi Kecepatan</div>
                    
                    <div class="form-row">
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="puncak_kecepatan" class="form-label">Puncak Kecepatan</label>
                                <input type="number" name="puncak_kecepatan" id="puncak_kecepatan" class="form-control" value="{{ old('puncak_kecepatan', $jarak->puncak_kecepatan ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-6">
                            <div class="form-group">
                                <label for="puncak_kecepatan_barang" class="form-label">Puncak Kecepatan Barang</label>
                                <input type="number" name="puncak_kecepatan_barang" id="puncak_kecepatan_barang" class="form-control" value="{{ old('puncak_kecepatan_barang', $jarak->puncak_kecepatan_barang ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Approval Information Section -->
                <div class="form-section">
                    <div class="section-title approval">Informasi Persetujuan</div>
                    
                    <div class="form-row">
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" {{ old('status', $jarak->status ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ old('status', $jarak->status ?? 1) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="approved_at" class="form-label">Approved At</label>
                                <input type="text" name="approved_at" id="approved_at" class="form-control" value="{{ old('approved_at', $jarak->approved_at ?? '') }}">
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="approved_by" class="form-label">Approved By</label>
                                <input type="text" name="approved_by" id="approved_by" class="form-control" value="{{ old('approved_by', $jarak->approved_by ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-primary">
                        <span>{{ isset($jarak) ? '✏️' : '💾' }}</span>
                        {{ isset($jarak) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('jarak.index') }}" class="btn btn-secondary">
                        <span>🔙</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection