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
        --kai-success: #10B981;
        --kai-warning: #F59E0B;
        --kai-danger: #EF4444;
    }

    body {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-light-blue) 50%, var(--kai-orange) 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
        padding: 40px 20px;
        min-height: 100vh;
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
        position: relative;
    }

    .page-title {
        color: var(--kai-white);
        font-size: 3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 3px;
        margin-bottom: 10px;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        position: relative;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.2rem;
        font-weight: 400;
        margin-bottom: 30px;
    }

    .decorative-line {
        width: 120px;
        height: 4px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-white) 100%);
        margin: 20px auto;
        border-radius: 2px;
    }

    .data-card {
        background: var(--kai-white);
        border-radius: 25px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        max-width: 1400px;
        margin: 0 auto;
        position: relative;
        backdrop-filter: blur(10px);
    }

    .data-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, var(--kai-orange) 0%, var(--kai-blue) 25%, var(--kai-orange) 50%, var(--kai-blue) 75%, var(--kai-orange) 100%);
    }

    .card-header {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
        padding: 30px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .header-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--kai-orange) 0%, var(--kai-white) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 12px 25px;
        border: none;
        border-radius: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
        font-size: 0.9rem;
        min-width: 120px;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--kai-orange) 0%, #FF8A65 100%);
        color: var(--kai-white);
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 107, 53, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .btn-home {
        background: linear-gradient(135deg, var(--kai-white) 0%, #F8FAFC 100%);
        color: var(--kai-blue);
        box-shadow: 0 5px 15px rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.3);
        min-width: 100px;
    }

    .btn-home:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.3);
        text-decoration: none;
        color: var(--kai-blue);
        background: linear-gradient(135deg, #FFFFFF 0%, #F1F5F9 100%);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.8rem;
        min-width: 80px;
    }

    .btn-info {
        background: linear-gradient(135deg, var(--kai-light-blue) 0%, var(--kai-blue) 100%);
        color: var(--kai-white);
        box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3);
    }

    .btn-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .btn-warning {
        background: linear-gradient(135deg, var(--kai-warning) 0%, #FBBF24 100%);
        color: var(--kai-white);
        box-shadow: 0 3px 10px rgba(245, 158, 11, 0.3);
    }

    .btn-warning:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(245, 158, 11, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--kai-danger) 0%, #F87171 100%);
        color: var(--kai-white);
        box-shadow: 0 3px 10px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        text-decoration: none;
        color: var(--kai-white);
    }

    .search-filter-section {
        padding: 30px 40px;
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
        border-bottom: 1px solid var(--kai-gray-medium);
    }

    .search-container {
        display: flex;
        gap: 20px;
        align-items: center;
        flex-wrap: wrap;
    }

    .search-box {
        flex: 1;
        min-width: 300px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 25px;
        font-size: 1rem;
        color: var(--kai-blue);
        background: var(--kai-white);
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
    }

    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--kai-gray-dark);
        font-size: 1.2rem;
    }

    .filter-select {
        padding: 12px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 20px;
        font-size: 1rem;
        color: var(--kai-blue);
        background: var(--kai-white);
        min-width: 150px;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
    }

    .table-container {
        padding: 0;
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        background: var(--kai-white);
    }

    .data-table thead {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
    }

    .data-table th {
        padding: 20px 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        position: relative;
        white-space: nowrap;
    }

    .data-table th:first-child {
        padding-left: 30px;
    }

    .data-table th:last-child {
        padding-right: 30px;
        text-align: center;
    }

    .data-table th::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--kai-orange);
    }

    .data-table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--kai-gray-medium);
    }

    .data-table tbody tr:hover {
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
        transform: scale(1.005);
    }

    .data-table tbody tr:nth-child(even) {
        background: rgba(248, 250, 252, 0.5);
    }

    .data-table tbody tr:nth-child(even):hover {
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
    }

    .data-table td {
        padding: 15px;
        font-size: 1rem;
        color: var(--kai-blue);
        vertical-align: middle;
    }

    .data-table td:first-child {
        padding-left: 30px;
        font-weight: 600;
        color: var(--kai-orange);
    }

    .data-table td:last-child {
        padding-right: 30px;
        text-align: center;
    }

    .data-table td:nth-child(2) {
        font-weight: 600;
        color: var(--kai-dark-blue);
    }

    .action-buttons {
        display: flex;
        gap: 5px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .action-form {
        display: inline-block;
        margin: 0;
    }

    .alert {
        padding: 15px 25px;
        margin: 30px 40px 0;
        border-radius: 15px;
        border: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success {
        background: linear-gradient(135deg, var(--kai-success) 0%, #34D399 100%);
        color: var(--kai-white);
    }

    .pagination-container {
        padding: 30px 40px;
        display: flex;
        justify-content: center;
        background: var(--kai-gray-light);
    }

    .pagination {
        display: flex;
        gap: 5px;
        align-items: center;
    }

    .page-link {
        padding: 10px 15px;
        background: var(--kai-white);
        color: var(--kai-blue);
        text-decoration: none;
        border-radius: 10px;
        border: 2px solid var(--kai-gray-medium);
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: var(--kai-orange);
        color: var(--kai-white);
        border-color: var(--kai-orange);
        transform: translateY(-2px);
        text-decoration: none;
    }

    .page-link.active {
        background: var(--kai-blue);
        color: var(--kai-white);
        border-color: var(--kai-blue);
    }

    .stats-bar {
        padding: 20px 40px;
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
        border-bottom: 1px solid var(--kai-gray-medium);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .stats-info {
        color: var(--kai-blue);
        font-weight: 500;
    }

    .floating-elements {
        position: fixed;
        width: 100%;
        height: 100%;
        pointer-events: none;
        overflow: hidden;
        z-index: 0;
    }

    .floating-item {
        position: absolute;
        font-size: 2rem;
        opacity: 0.03;
        animation: float 12s ease-in-out infinite;
    }

    .floating-item:nth-child(1) {
        top: 10%;
        left: 5%;
        animation-delay: 0s;
    }

    .floating-item:nth-child(2) {
        top: 60%;
        right: 10%;
        animation-delay: 4s;
    }

    .floating-item:nth-child(3) {
        bottom: 20%;
        left: 15%;
        animation-delay: 8s;
    }

    .floating-item:nth-child(4) {
        top: 30%;
        right: 30%;
        animation-delay: 2s;
    }

    .floating-item:nth-child(5) {
        bottom: 40%;
        right: 5%;
        animation-delay: 6s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0px) rotate(0deg);
        }
        50% {
            transform: translateY(-20px) rotate(5deg);
        }
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .card-header {
            flex-direction: column;
            text-align: center;
        }

        .header-actions {
            width: 100%;
            justify-content: center;
        }
        
        .search-container {
            flex-direction: column;
        }
        
        .search-box {
            min-width: 100%;
        }
        
        .data-table {
            font-size: 0.8rem;
        }
        
        .data-table th,
        .data-table td {
            padding: 10px 8px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 3px;
        }
        
        .btn-sm {
            min-width: 60px;
            padding: 6px 12px;
        }
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 40px;
        color: var(--kai-gray-dark);
    }

    .empty-icon {
        font-size: 4rem;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .empty-message {
        font-size: 1rem;
        opacity: 0.8;
    }
</style>

<div class="floating-elements">
    <div class="floating-item">🚂</div>
    <div class="floating-item">🏢</div>
    <div class="floating-item">📊</div>
    <div class="floating-item">🌐</div>
    <div class="floating-item">📋</div>
</div>

<div class="main-container">
    <div class="page-header">
        <h1 class="page-title">Data Daop</h1>
        <div class="decorative-line"></div>
        <p class="page-subtitle">Kelola Daerah Operasi</p>
    </div>

    <div class="data-card">
        <div class="card-header">
            <div class="header-info">
                <div class="header-icon">📊</div>
                <h2 class="header-title">Daftar Daop</h2>
            </div>
            <div class="header-actions">
                <a href="/home" class="btn btn-home">
                    <span>🏠</span>
                    Home
                </a>
                <a href="{{ route('daop.create') }}" class="btn btn-primary">
                    <span>➕</span>
                    Tambah Daop
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                {{ session('success') }}
            </div>
        @endif

        <div class="search-filter-section">
            <div class="search-container">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari data daop..." id="searchInput">
                    <span class="search-icon">🔍</span>
                </div>
                <select class="filter-select" id="filterSelect">
                    <option value="">Semua Data</option>
                    <option value="region1">Region 1</option>
                    <option value="region2">Region 2</option>
                    <option value="region3">Region 3</option>
                </select>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stats-info">
                <span>📈</span>
                Total: <strong>{{ $daops->total() }}</strong> data
            </div>
            <div class="stats-info">
                <span>📄</span>
                Halaman: <strong>{{ $daops->currentPage() }}</strong> dari <strong>{{ $daops->lastPage() }}</strong>
            </div>
        </div>

        <div class="table-container">
            @if($daops->count() > 0)
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Singkatan</th>
                            <th>Nomenklatur</th>
                            <th>Daop</th>
                            <th>ID Region</th>
                            <th>Bus Area</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daops as $index => $daop)
                            <tr>
                                <td>{{ ($daops->currentPage() - 1) * $daops->perPage() + $index + 1 }}</td>
                                <td>{{ $daop->nama }}</td>
                                <td>{{ $daop->singkatan }}</td>
                                <td>{{ $daop->nomenklatur }}</td>
                                <td>{{ $daop->daop }}</td>
                                <td>{{ $daop->id_region }}</td>
                                <td>{{ $daop->bus_area }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('daop.show', $daop->id) }}" class="btn btn-info btn-sm">
                                            <span>👁️</span>
                                            Lihat
                                        </a>
                                        <a href="{{ route('daop.edit', $daop->id) }}" class="btn btn-warning btn-sm">
                                            <span>✏️</span>
                                            Edit
                                        </a>
                                        <form action="{{ route('daop.destroy', $daop->id) }}" method="POST" class="action-form" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
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
            @else
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <div class="empty-title">Belum Ada Data</div>
                    <div class="empty-message">Data daop belum tersedia. Silakan tambah data baru.</div>
                </div>
            @endif
        </div>

        @if($daops->hasPages())
            <div class="pagination-container">
                {{ $daops->links() }}
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const filterSelect = document.getElementById('filterSelect');
    const tableRows = document.querySelectorAll('.data-table tbody tr');
    
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterValue = filterSelect.value.toLowerCase();
        
        tableRows.forEach(row => {
            const cells = row.querySelectorAll('td');
            const rowText = Array.from(cells).map(cell => cell.textContent.toLowerCase()).join(' ');
            
            const matchesSearch = rowText.includes(searchTerm);
            const matchesFilter = filterValue === '' || rowText.includes(filterValue);
            
            if (matchesSearch && matchesFilter) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterTable);
    filterSelect.addEventListener('change', filterTable);
    
    // Animate table rows on load
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Confirm delete with better styling
    document.querySelectorAll('.action-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const confirmation = confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?\n\nData yang sudah dihapus tidak dapat dikembalikan.');
            
            if (confirmation) {
                this.submit();
            }
        });
    });
});
</script>

@endsection