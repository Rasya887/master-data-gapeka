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

    .detail-container {
        padding: 40px 20px;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-card {
        background: var(--kai-white);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 1000px;
        width: 100%;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .detail-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
    }

    .detail-header {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        text-align: center;
        padding: 40px 30px;
        position: relative;
    }

    .detail-header::after {
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

    .detail-title {
        font-size: 2rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .detail-subtitle {
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

    .detail-body {
        padding: 50px 40px;
    }

    .back-button {
        background: linear-gradient(135deg, var(--kai-gray-dark) 0%, #475569 100%);
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
        box-shadow: 0 5px 15px rgba(100, 116, 139, 0.3);
        cursor: pointer;
        font-size: 0.9rem;
        margin-bottom: 30px;
    }

    .back-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 116, 139, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .detail-item {
        background: var(--kai-gray-light);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid var(--kai-orange);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .detail-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-left-color: var(--kai-blue);
    }

    .detail-item::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, transparent 70%);
        opacity: 0.1;
        border-radius: 0 15px 0 50px;
    }

    .detail-label {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--kai-blue);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .detail-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--kai-dark-blue);
        word-wrap: break-word;
        line-height: 1.4;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        color: var(--kai-white);
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
    }

    .status-inactive {
        background: linear-gradient(135deg, var(--kai-red) 0%, #F87171 100%);
        color: var(--kai-white);
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
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
        opacity: 0.05;
        animation: float 10s ease-in-out infinite;
    }

    .floating-train:nth-child(1) {
        top: 15%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-train:nth-child(2) {
        top: 60%;
        right: 15%;
        animation-delay: 5s;
    }

    .floating-train:nth-child(3) {
        bottom: 20%;
        left: 70%;
        animation-delay: 2.5s;
    }

    .floating-train:nth-child(4) {
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

    .highlight-primary {
        color: var(--kai-orange);
        font-weight: 700;
    }

    .highlight-secondary {
        color: var(--kai-blue);
        font-weight: 600;
    }

    .unit {
        font-size: 0.9rem;
        color: var(--kai-gray-dark);
        font-weight: 500;
    }

    /* Special styling for important fields */
    .detail-item.important {
        border-left-color: var(--kai-orange);
        background: linear-gradient(135deg, #FFF7ED 0%, var(--kai-gray-light) 100%);
    }

    .detail-item.important .detail-label {
        color: var(--kai-orange);
    }

    .detail-item.important .detail-value {
        color: var(--kai-dark-blue);
        font-weight: 700;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .detail-title {
            font-size: 1.6rem;
        }
        
        .detail-body {
            padding: 30px 20px;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .detail-item {
            padding: 15px;
        }
    }

    /* Animation for content loading */
    .detail-item {
        animation: slideInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .detail-item:nth-child(1) { animation-delay: 0.1s; }
    .detail-item:nth-child(2) { animation-delay: 0.2s; }
    .detail-item:nth-child(3) { animation-delay: 0.3s; }
    .detail-item:nth-child(4) { animation-delay: 0.4s; }
    .detail-item:nth-child(5) { animation-delay: 0.5s; }
    .detail-item:nth-child(6) { animation-delay: 0.6s; }
    .detail-item:nth-child(7) { animation-delay: 0.7s; }
    .detail-item:nth-child(8) { animation-delay: 0.8s; }
    .detail-item:nth-child(9) { animation-delay: 0.9s; }

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
</style>

<div class="detail-container">
    <div class="detail-card">
        <div class="floating-elements">
            <div class="floating-train">🚂</div>
            <div class="floating-train">📏</div>
            <div class="floating-train">🛤️</div>
            <div class="floating-train">⚡</div>
        </div>
        
        <div class="detail-header">
            <div class="header-icon">📊</div>
            <div class="decorative-line"></div>
            <h1 class="detail-title">Detail Data Jarak</h1>
            <p class="detail-subtitle">Informasi Lengkap Jarak Antar Stasiun</p>
        </div>
        
        <div class="detail-body">
            <a href="{{ route('jarak.index') }}" class="back-button">
                <span>⬅️</span>
                Kembali
            </a>

            <div class="detail-grid">
                <div class="detail-item important">
                    <div class="detail-label">
                        <span>🆔</span>
                        ID
                    </div>
                    <div class="detail-value highlight-primary">
                        {{ $jarak->id }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🏢</span>
                        Daop
                    </div>
                    <div class="detail-value">
                        {{ $jarak->daop->nama ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🚉</span>
                        Stasiun
                    </div>
                    <div class="detail-value">
                        {{ $jarak->stasiun->nama ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🚉</span>
                        Stasiun Sebelah
                    </div>
                    <div class="detail-value">
                        {{ $jarak->stasiunSebelah->nama ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🛤️</span>
                        ID Lintas
                    </div>
                    <div class="detail-value">
                        {{ $jarak->id_lintas ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>📅</span>
                        ID Tahun Gapeka
                    </div>
                    <div class="detail-value">
                        {{ $jarak->id_tahun_gapeka ?? '-' }}
                    </div>
                </div>

                <div class="detail-item important">
                    <div class="detail-label">
                        <span>📏</span>
                        Jarak
                    </div>
                    <div class="detail-value">
                        <span class="highlight-primary">{{ $jarak->jarak }}</span>
                        <span class="unit">km</span>
                    </div>
                </div>

                <div class="detail-item important">
                    <div class="detail-label">
                        <span>⚡</span>
                        Puncak Kecepatan
                    </div>
                    <div class="detail-value">
                        <span class="highlight-primary">{{ $jarak->puncak_kecepatan }}</span>
                        <span class="unit">km/jam</span>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🎯</span>
                        Taspat
                    </div>
                    <div class="detail-value">
                        {{ $jarak->taspat ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>📦</span>
                        Puncak Kecepatan Barang
                    </div>
                    <div class="detail-value">
                        @if($jarak->puncak_kecepatan_barang)
                            <span class="highlight-secondary">{{ $jarak->puncak_kecepatan_barang }}</span>
                            <span class="unit">km/jam</span>
                        @else
                            -
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>🔄</span>
                        Status
                    </div>
                    <div class="detail-value">
                        @if($jarak->status == 1)
                            <span class="status-badge status-active">
                                <span>✅</span>
                                Aktif
                            </span>
                        @else
                            <span class="status-badge status-inactive">
                                <span>❌</span>
                                Nonaktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>📅</span>
                        Created At
                    </div>
                    <div class="detail-value">
                        {{ $jarak->created_at ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>👤</span>
                        Created By
                    </div>
                    <div class="detail-value">
                        {{ $jarak->created_by ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>📅</span>
                        Updated At
                    </div>
                    <div class="detail-value">
                        {{ $jarak->updated_at ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>👤</span>
                        Updated By
                    </div>
                    <div class="detail-value">
                        {{ $jarak->updated_by ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>✅</span>
                        Approved At
                    </div>
                    <div class="detail-value">
                        {{ $jarak->approved_at ?? '-' }}
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-label">
                        <span>👨‍💼</span>
                        Approved By
                    </div>
                    <div class="detail-value">
                        {{ $jarak->approved_by ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection