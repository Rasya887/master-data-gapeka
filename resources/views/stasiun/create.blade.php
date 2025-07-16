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
    .form-label[for="singkatan"]::before { content: '🔤'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="nama"]::before { content: '🚉'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="dpl"]::before { content: '📏'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="kode"]::before { content: '🆔'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="track"]::before { content: '🛤️'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="ppkt"]::before { content: '🎯'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="created_by"]::before { content: '👤'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }
    .form-label[for="updated_by"]::before { content: '🔄'; position: absolute; left: 0; top: 50%; transform: translateY(-50%); }

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

    .section-title::before {
        content: '⚙️';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.5rem;
    }

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

    /* Toggle switch styling for boolean fields */
    .toggle-container {
        position: relative;
        display: inline-block;
    }

    .toggle-switch {
        position: relative;
        width: 60px;
        height: 30px;
        background: var(--kai-gray-medium);
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid var(--kai-gray-medium);
    }

    .toggle-switch.active {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        border-color: var(--kai-green);
    }

    .toggle-switch::before {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 22px;
        height: 22px;
        background: var(--kai-white);
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .toggle-switch.active::before {
        transform: translateX(30px);
    }

    .toggle-label {
        margin-left: 10px;
        font-weight: 500;
        color: var(--kai-blue);
        vertical-align: middle;
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
        .form-col-4 {
            flex: 1;
        }
        
        .btn {
            width: 100%;
            margin-right: 0;
            margin-bottom: 15px;
            justify-content: center;
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

    /* Custom checkbox styling for boolean fields */
    .checkbox-group {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 10px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        background: var(--kai-gray-light);
        border-radius: 15px;
        border: 2px solid var(--kai-gray-medium);
        transition: all 0.3s ease;
        cursor: pointer;
        flex: 1;
        min-width: 150px;
    }

    .checkbox-item:hover {
        border-color: var(--kai-orange);
        transform: translateY(-2px);
    }

    .checkbox-item.active {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        border-color: var(--kai-green);
        color: var(--kai-white);
    }

    .checkbox-item.active .checkbox-label {
        color: var(--kai-white);
    }

    .checkbox-label {
        font-weight: 500;
        color: var(--kai-blue);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
    }

    /* Status indicators */
    .status-indicator {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--kai-gray-medium);
        transition: all 0.3s ease;
        display: inline-block;
    }

    .status-indicator.active {
        background: var(--kai-green);
        box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
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
            <div class="header-icon">{{ isset($stasiun) ? '✏️' : '➕' }}</div>
            <div class="decorative-line"></div>
            <h2 class="form-title">{{ isset($stasiun) ? 'Edit Stasiun' : 'Tambah Stasiun' }}</h2>
            <p class="form-subtitle">{{ isset($stasiun) ? 'Perbarui Data Stasiun' : 'Tambah Data Stasiun Baru' }}</p>
        </div>
        
        <div class="form-body">
            <form action="{{ isset($stasiun) ? route('stasiun.update', $stasiun->id) : route('stasiun.store') }}" method="POST">
                @csrf
                @if(isset($stasiun))
                    @method('PUT')
                @endif

                <!-- Basic Information Section -->
                <div class="form-section">
                    <div class="section-title">Informasi Dasar</div>
                    
                    <div class="form-group">
                        <label for="id_daop" class="form-label">Daop</label>
                        <select name="id_daop" id="id_daop" class="form-control" required>
                            <option value="">Pilih Daop</option>
                            @foreach ($daops as $daop)
                                <option value="{{ $daop->id }}" {{ old('id_daop', $stasiun->id_daop ?? '') == $daop->id ? 'selected' : '' }}>
                                    {{ $daop->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="singkatan" class="form-label">Singkatan</label>
                                <input type="text" name="singkatan" id="singkatan" class="form-control" value="{{ old('singkatan', $stasiun->singkatan ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $stasiun->nama ?? '') }}" required>
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="dpl" class="form-label">DPL</label>
                                <input type="number" step="0.01" name="dpl" id="dpl" class="form-control" value="{{ old('dpl', $stasiun->dpl ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="kode" class="form-label">Kode</label>
                                <input type="text" name="kode" id="kode" class="form-control" value="{{ old('kode', $stasiun->kode ?? '') }}">
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="track" class="form-label">Track</label>
                                <input type="text" name="track" id="track" class="form-control" value="{{ old('track', $stasiun->track ?? '') }}">
                            </div>
                        </div>
                        <div class="form-col-4">
                            <div class="form-group">
                                <label for="ppkt" class="form-label">PPKT</label>
                                <select name="ppkt" id="ppkt" class="form-control">
                                    <option value="0" {{ old('ppkt', $stasiun->ppkt ?? 0) == 0 ? 'selected' : '' }}>Tidak</option>
                                    <option value="1" {{ old('ppkt', $stasiun->ppkt ?? 0) == 1 ? 'selected' : '' }}>Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Configuration Section -->
                <div class="form-section">
                    <div class="section-title">Konfigurasi Stasiun</div>
                    
                    <div class="checkbox-group">
                        @foreach (['aktif' => 'Aktif', 'kotak' => 'Kotak', 'garis_tipis' => 'Garis Tipis', 'garis_tebal' => 'Garis Tebal', 'perhentian' => 'Perhentian', 'batas_daop' => 'Batas Daop'] as $field => $label)
                            <div class="checkbox-item {{ old($field, $stasiun->$field ?? 0) == 1 ? 'active' : '' }}" onclick="toggleCheckbox('{{ $field }}')">
                                <div class="status-indicator {{ old($field, $stasiun->$field ?? 0) == 1 ? 'active' : '' }}"></div>
                                <span class="checkbox-label">{{ $label }}</span>
                                <select name="{{ $field }}" id="{{ $field }}" class="form-control" style="display: none;">
                                    <option value="0" {{ old($field, $stasiun->$field ?? 0) == 0 ? 'selected' : '' }}>0</option>
                                    <option value="1" {{ old($field, $stasiun->$field ?? 0) == 1 ? 'selected' : '' }}>1</option>
                                </select>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Audit Information Section -->
                <div class="form-section">
                    <div class="section-title">Informasi Audit</div>
                    
                    <div class="form-row">
                        <div class="form-col">
                            <div class="form-group">
                                <label for="created_by" class="form-label">Created By</label>
                                <input type="text" name="created_by" id="created_by" class="form-control" value="{{ old('created_by', $stasiun->created_by ?? '') }}" readonly>
                            </div>
                        </div>
                        <div class="form-col">
                            <div class="form-group">
                                <label for="updated_by" class="form-label">Updated By</label>
                                <input type="text" name="updated_by" id="updated_by" class="form-control" value="{{ old('updated_by', $stasiun->updated_by ?? '') }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="button-container">
                    <button type="submit" class="btn btn-primary">
                        <span>{{ isset($stasiun) ? '✏️' : '💾' }}</span>
                        {{ isset($stasiun) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('stasiun.index') }}" class="btn btn-secondary">
                        <span>🔙</span>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleCheckbox(fieldName) {
    const checkboxItem = document.querySelector(`#${fieldName}`).closest('.checkbox-item');
    const select = document.querySelector(`#${fieldName}`);
    const statusIndicator = checkboxItem.querySelector('.status-indicator');
    
    const isActive = checkboxItem.classList.contains('active');
    
    if (isActive) {
        checkboxItem.classList.remove('active');
        statusIndicator.classList.remove('active');
        select.value = '0';
    } else {
        checkboxItem.classList.add('active');
        statusIndicator.classList.add('active');
        select.value = '1';
    }
}
</script>

@endsection