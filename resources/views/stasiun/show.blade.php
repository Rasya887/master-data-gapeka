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
        max-width: 800px;
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

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        background: var(--kai-white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .detail-table tr {
        transition: all 0.3s ease;
    }

    .detail-table tr:hover {
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
        transform: scale(1.02);
    }

    .detail-table th {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        padding: 20px 25px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        width: 35%;
        position: relative;
    }

    .detail-table th::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--kai-orange);
    }

    .detail-table td {
        padding: 20px 25px;
        border-bottom: 1px solid var(--kai-gray-medium);
        font-size: 1.1rem;
        font-weight: 500;
        color: var(--kai-blue);
        position: relative;
    }

    .detail-table tr:last-child td {
        border-bottom: none;
    }

    .detail-table tr:nth-child(even) {
        background: rgba(248, 250, 252, 0.5);
    }

    /* Row icons for stasiun fields */
    .detail-table tr:nth-child(1) th::after { content: '🆔'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(2) th::after { content: '🏢'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(3) th::after { content: '📝'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(4) th::after { content: '🚉'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(5) th::after { content: '📏'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(6) th::after { content: '🔤'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(7) th::after { content: '✅'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(8) th::after { content: '📦'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(9) th::after { content: '➖'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(10) th::after { content: '━'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(11) th::after { content: '🚏'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(12) th::after { content: '🚧'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(13) th::after { content: '🛤️'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(14) th::after { content: '🎯'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(15) th::after { content: '📅'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(16) th::after { content: '👤'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(17) th::after { content: '🔄'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }
    .detail-table tr:nth-child(18) th::after { content: '👥'; position: absolute; right: 20px; top: 50%; transform: translateY(-50%); }

    .btn-back {
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
        margin: 0 auto;
    }

    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(100, 116, 139, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .button-container {
        text-align: center;
        margin-top: 30px;
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

    .data-badge {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        color: var(--kai-white);
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .highlight-value {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .status-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-active {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        color: var(--kai-white);
    }

    .status-inactive {
        background: linear-gradient(135deg, var(--kai-red) 0%, #F87171 100%);
        color: var(--kai-white);
    }

    .status-yes {
        background: linear-gradient(135deg, var(--kai-green) 0%, #34D399 100%);
        color: var(--kai-white);
    }

    .status-no {
        background: linear-gradient(135deg, var(--kai-gray-dark) 0%, #9CA3AF 100%);
        color: var(--kai-white);
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .detail-title {
            font-size: 1.6rem;
        }
        
        .detail-body {
            padding: 30px 20px;
        }
        
        .detail-table th,
        .detail-table td {
            padding: 15px 20px;
            font-size: 0.95rem;
        }
        
        .detail-table th {
            width: 40%;
        }
    }

    /* Enhanced styling for specific fields */
    .detail-table tr:nth-child(1) td {
        color: var(--kai-orange);
        font-weight: 700;
    }

    .detail-table tr:nth-child(4) td {
        color: var(--kai-blue);
        font-weight: 700;
        font-size: 1.15rem;
    }

    .detail-table tr:nth-child(2) td {
        color: var(--kai-blue);
        font-weight: 700;
    }
</style>

<div class="detail-container">
    <div class="detail-card">
        <div class="floating-elements">
            <div class="floating-train">🚉</div>
            <div class="floating-train">🚂</div>
            <div class="floating-train">🛤️</div>
        </div>
        
        <div class="detail-header">
            <div class="header-icon">🚉</div>
            <div class="decorative-line"></div>
            <h3 class="detail-title">Detail Stasiun</h3>
            <p class="detail-subtitle">Informasi Lengkap Data Stasiun</p>
        </div>
        
        <div class="detail-body">
            <table class="detail-table">
                <tr>
                    <th>ID</th>
                    <td><span class="data-badge">{{ $stasiun->id }}</span></td>
                </tr>
                <tr>
                    <th>Daop</th>
                    <td><span class="highlight-value">{{ $stasiun->daop->nama ?? '-' }}</span></td>
                </tr>
                <tr>
                    <th>Singkatan</th>
                    <td>{{ $stasiun->singkatan }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><span class="highlight-value">{{ $stasiun->nama }}</span></td>
                </tr>
                <tr>
                    <th>DPL</th>
                    <td>{{ $stasiun->dpl ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kode</th>
                    <td>{{ $stasiun->kode ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Aktif</th>
                    <td>
                        <span class="status-badge {{ $stasiun->aktif ? 'status-active' : 'status-inactive' }}">
                            {{ $stasiun->aktif ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Kotak</th>
                    <td>
                        <span class="status-badge {{ $stasiun->kotak ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->kotak ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Garis Tipis</th>
                    <td>
                        <span class="status-badge {{ $stasiun->garis_tipis ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->garis_tipis ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Garis Tebal</th>
                    <td>
                        <span class="status-badge {{ $stasiun->garis_tebal ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->garis_tebal ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Perhentian</th>
                    <td>
                        <span class="status-badge {{ $stasiun->perhentian ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->perhentian ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Batas Daop</th>
                    <td>
                        <span class="status-badge {{ $stasiun->batas_daop ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->batas_daop ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Track</th>
                    <td>{{ $stasiun->track ?? '-' }}</td>
                </tr>
                <tr>
                    <th>PPKT</th>
                    <td>
                        <span class="status-badge {{ $stasiun->ppkt ? 'status-yes' : 'status-no' }}">
                            {{ $stasiun->ppkt ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $stasiun->created_at ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Created By</th>
                    <td>{{ $stasiun->created_by ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $stasiun->updated_at ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Updated By</th>
                    <td>{{ $stasiun->updated_by ?? '-' }}</td>
                </tr>
            </table>
            
            <div class="button-container">
                <a href="{{ route('stasiun.index') }}" class="btn-back">
                    <span>🔙</span>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection