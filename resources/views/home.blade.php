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
        --kai-shadow: rgba(0, 0, 0, 0.1);
    }

    body {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 50%, var(--kai-orange) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .dashboard-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    .dashboard-card {
        background: var(--kai-white);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 1000px;
        width: 100%;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
    }

    .dashboard-header {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        text-align: center;
        padding: 50px 30px;
        position: relative;
    }

    .dashboard-header::after {
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

    .logo-section {
        margin-bottom: 30px;
    }

    .logo-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-white) 100%);
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        margin-bottom: 15px;
        box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .dashboard-subtitle {
        font-size: 1.2rem;
        font-weight: 400;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .decorative-line {
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-white) 100%);
        margin: 20px auto;
        border-radius: 2px;
    }

    .dashboard-body {
        padding: 60px 40px 50px;
    }

    .menu-section {
        margin-bottom: 40px;
    }

    .menu-title {
        color: var(--kai-blue);
        font-size: 1.3rem;
        font-weight: 600;
        text-align: center;
        margin-bottom: 40px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        max-width: 900px;
        margin: 0 auto;
    }

    .menu-card {
        background: var(--kai-white);
        border: 3px solid var(--kai-gray-medium);
        border-radius: 20px;
        padding: 35px 25px;
        text-align: center;
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        display: block;
    }

    .menu-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 107, 53, 0.1), transparent);
        transition: left 0.6s ease;
    }

    .menu-card:hover::before {
        left: 100%;
    }

    .menu-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        border-color: var(--kai-orange);
        text-decoration: none;
    }

    .menu-card.daop {
        border-color: var(--kai-blue);
    }

    .menu-card.daop:hover {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        border-color: var(--kai-blue);
    }

    .menu-card.stasiun {
        border-color: var(--kai-orange);
    }

    .menu-card.stasiun:hover {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        color: var(--kai-white);
        border-color: var(--kai-orange);
    }

    .menu-card.jarak {
        border-color: var(--kai-light-blue);
    }

    .menu-card.jarak:hover {
        background: linear-gradient(135deg, var(--kai-light-blue) 0%, var(--kai-blue) 100%);
        color: var(--kai-white);
        border-color: var(--kai-light-blue);
    }

    .menu-icon {
        font-size: 3rem;
        margin-bottom: 20px;
        display: block;
    }

    .menu-title-card {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .menu-description {
        font-size: 0.95rem;
        opacity: 0.8;
        line-height: 1.5;
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
        font-size: 2rem;
        opacity: 0.1;
        animation: float 6s ease-in-out infinite;
    }

    .floating-train:nth-child(1) {
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .floating-train:nth-child(2) {
        top: 70%;
        right: 10%;
        animation-delay: 2s;
    }

    .floating-train:nth-child(3) {
        bottom: 20%;
        left: 80%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-20px);
        }
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }
        
        .dashboard-body {
            padding: 40px 20px;
        }
        
        .menu-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .menu-card {
            padding: 30px 20px;
        }
    }
</style>

<div class="dashboard-container">
    <div class="dashboard-card">
        <div class="floating-elements">
            <div class="floating-train">🚂</div>
            <div class="floating-train">🚃</div>
            <div class="floating-train">🚄</div>
        </div>
        
        <div class="dashboard-header">
            <div class="logo-section">
                <div class="logo-icon">🚂</div>
                <div class="decorative-line"></div>
            </div>
            <h1 class="dashboard-title">Master GAPEKA</h1>
            <p class="dashboard-subtitle">Sistem Manajemen Grafik Perjalanan Kereta Api</p>
        </div>
        
        <div class="dashboard-body">
            <div class="menu-section">
                <h3 class="menu-title">Pilih Menu Data</h3>
                
                <div class="menu-grid">
                    <a href="{{ route('daop.index') }}" class="menu-card daop">
                        <span class="menu-icon">🏢</span>
                        <h4 class="menu-title-card">Data Daop</h4>
                    </a>
                    
                    <a href="{{ route('stasiun.index') }}" class="menu-card stasiun">
                        <span class="menu-icon">🚉</span>
                        <h4 class="menu-title-card">Data Stasiun</h4>
                    </a>
                    
                    <a href="{{ route('jarak.index') }}" class="menu-card jarak">
                        <span class="menu-icon">📏</span>
                        <h4 class="menu-title-card">Data Jarak</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection