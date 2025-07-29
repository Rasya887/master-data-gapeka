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

    .btn-outline-secondary {
        background: transparent;
        color: var(--kai-blue);
        border: 2px solid var(--kai-gray-medium);
    }

    .btn-outline-secondary:hover {
        background: var(--kai-blue);
        color: var(--kai-white);
        border-color: var(--kai-blue);
    }

    .btn-outline-danger {
        background: transparent;
        color: var(--kai-danger);
        border: 2px solid var(--kai-danger);
    }

    .btn-outline-danger:hover {
        background: var(--kai-danger);
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

    .search-input, .form-control {
        width: 100%;
        padding: 12px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 10px;
        font-size: 1rem;
        color: var(--kai-blue);
        background: var(--kai-white);
        transition: all 0.3s ease;
    }

    .search-input:focus, .form-control:focus {
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

    .form-select {
        padding: 12px 20px;
        border: 2px solid var(--kai-gray-medium);
        border-radius: 10px;
        font-size: 1rem;
        color: var(--kai-blue);
        background: var(--kai-white);
        min-width: 150px;
        transition: all 0.3s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--kai-orange);
        box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.2);
    }

    .table-responsive {
        background: var(--kai-white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table {
        margin-bottom: 0;
        width: 100%;
        border-collapse: collapse;
    }

    .table-dark {
        background: linear-gradient(135deg, var(--kai-blue) 0%, var(--kai-dark-blue) 100%);
        color: var(--kai-white);
    }

    .table th {
        padding: 20px 15px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
        position: relative;
        white-space: nowrap;
        border: none;
    }

    .table th:first-child {
        padding-left: 30px;
    }

    .table th:last-child {
        padding-right: 30px;
        text-align: center;
    }

    .table tbody tr {
        transition: all 0.3s ease;
        border-bottom: 1px solid var(--kai-gray-medium);
    }

    .table tbody tr:hover {
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
        transform: scale(1.002);
    }

    .table-striped tbody tr:nth-child(even) {
        background: rgba(248, 250, 252, 0.5);
    }

    .table-striped tbody tr:nth-child(even):hover {
        background: linear-gradient(135deg, var(--kai-gray-light) 0%, rgba(59, 130, 246, 0.05) 100%);
    }

    .table td {
        padding: 15px;
        font-size: 1rem;
        color: var(--kai-blue);
        vertical-align: middle;
        border: none;
    }

    .table td:first-child {
        padding-left: 30px;
        font-weight: 600;
        color: var(--kai-orange);
    }

    .table td:last-child {
        padding-right: 30px;
        text-align: center;
    }

    .table td:nth-child(2) {
        font-weight: 600;
        color: var(--kai-dark-blue);
    }

    .alert {
        padding: 15px 25px;
        margin-bottom: 20px;
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

    .d-flex {
        display: flex;
    }

    .justify-content-between {
        justify-content: space-between;
    }

    .justify-content-center {
        justify-content: center;
    }

    .align-items-center {
        align-items: center;
    }

    .gap-1 {
        gap: 5px;
    }

    .mb-1 {
        margin-bottom: 0.25rem;
    }

    .mb-3 {
        margin-bottom: 1rem;
    }

    .mb-4 {
        margin-bottom: 1.5rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .text-muted {
        color: var(--kai-gray-dark);
    }

    .text-center {
        text-align: center;
    }

    .w-100 {
        width: 100%;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-left: -0.75rem;
        margin-right: -0.75rem;
    }

    .col-md-2,
    .col-md-4 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        margin-bottom: 1rem;
    }

    .col-md-2 {
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }

    .col-md-4 {
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }

    .g-3 > * {
        margin-bottom: 1rem;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
        background: var(--kai-white);
        border-radius: 15px;
        margin-top: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
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

        .row {
            flex-direction: column;
        }

        .col-md-2,
        .col-md-4 {
            flex: 1;
            max-width: 100%;
        }
        
        .table {
            font-size: 0.8rem;
        }
        
        .table th,
        .table td {
            padding: 10px 8px;
        }
        
        .d-flex.gap-1 {
            flex-direction: column;
            gap: 3px;
        }
        
        .btn-sm {
            min-width: 60px;
            padding: 6px 12px;
        }

        .container {
            margin: 10px;
            padding: 15px;
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

<div class="main-container">
    <div class="page-header">
        <h1 class="page-title">Data Daop</h1>
        <p class="page-subtitle">Kelola Daerah Operasi</p>
        <div class="decorative-line"></div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="mb-1">Data Daop</h1>
                <p class="text-muted">Kelola Daerah Operasi</p>
            </div>
            <div>
                <a href="{{ route('daop.create') }}" class="btn btn-primary">
                    ➕ Tambah Daop
                </a>
            </div>
        </div>

        <!-- Alert -->
        @if (session('success'))
            <div class="alert alert-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <!-- Filter & Search -->
        <form method="GET" action="{{ route('daop.index') }}" class="row g-3 mb-3">
            <div class="col-md-4">
                <select name="region" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Region --</option>
                    <option value="1" {{ request('region') == '1' ? 'selected' : '' }}>Jawa</option>
                    <option value="2" {{ request('region') == '2' ? 'selected' : '' }}>Sumatera</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Cari Daop..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-outline-secondary w-100">🔍 Cari</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('daop.index') }}" class="btn btn-outline-danger w-100">↺ Reset</a>
            </div>
        </form>

        <!-- Statistik -->
        <div class="mb-3">
            <span>📈 Total: <strong>{{ $daops->total() }}</strong> data</span> |
            <span>📄 Halaman: <strong>{{ $daops->currentPage() }}</strong> dari <strong>{{ $daops->lastPage() }}</strong></span>
        </div>

        <!-- Tabel Daop -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
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
                    @forelse ($daops as $daop)
                    <tr>
                        <td>{{ ($daops->currentPage() - 1) * $daops->perPage() + $loop->iteration }}</td>
                        <td>{{ $daop->nama }}</td>
                        <td>{{ $daop->singkatan }}</td>
                        <td>{{ $daop->nomenklatur }}</td>
                        <td>{{ $daop->daop }}</td>
                        <td>{{ $daop->id_region == 1 ? 'Jawa' : 'Sumatera' }}</td>
                        <td>{{ $daop->bus_area }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('daop.show', $daop->id) }}" class="btn btn-info btn-sm">👁️</a>
                                <a href="{{ route('daop.edit', $daop->id) }}" class="btn btn-warning btn-sm">✏️</a>
                                <form action="{{ route('daop.destroy', $daop->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">📋 Belum ada data Daop.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($daops->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $daops->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate table rows on load
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.5s ease';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Enhanced delete confirmation
    document.querySelectorAll('form[onsubmit*="confirm"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const confirmation = confirm('⚠️ Apakah Anda yakin ingin menghapus data ini?\n\nData yang sudah dihapus tidak dapat dikembalikan.');
            
            if (confirmation) {
                // Remove the onsubmit attribute to prevent infinite loop
                this.removeAttribute('onsubmit');
                this.submit();
            }
        });
    });

    // Auto-submit on region change
    const regionSelect = document.querySelector('select[name="region"]');
    if (regionSelect) {
        regionSelect.addEventListener('change', function() {
            this.form.submit();
        });
    }
});
</script>

@endsection