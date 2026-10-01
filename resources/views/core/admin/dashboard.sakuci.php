@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    /* Styling Card Adaptif Light & Dark Mode */
    .theme-card {
        background-color: var(--bs-card-bg, #ffffff);
        color: var(--bs-body-color, #212529);
        border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08)) !important;
        transition: all 0.25s ease-in-out;
    }

    .theme-card-hover {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .theme-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12) !important;
        border-color: rgba(13, 110, 253, 0.3) !important;
    }

    /* Container untuk Icon Feature */
    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        transition: all 0.25s ease;
    }

    .theme-card-hover:hover .feature-icon {
        background-color: #0d6efd;
        color: #ffffff;
    }

    /* Styling Teks Kode/Inline Code Adaptif */
    .code-badge {
        font-family: var(--bs-font-monospace);
        padding: 0.2em 0.4em;
        border-radius: 0.375rem;
        font-size: 0.875em;
        background-color: var(--bs-tertiary-bg, rgba(0, 0, 0, 0.05));
        color: var(--bs-danger, #dc3545);
        border: 1px solid var(--bs-border-color, rgba(0, 0, 0, 0.08));
    }

    /* Penyesuaian khusus Dark Mode */
    [data-bs-theme="dark"] .feature-icon {
        background-color: rgba(13, 110, 253, 0.2);
        color: #6ea8fe;
    }

    [data-bs-theme="dark"] .theme-card-hover:hover .feature-icon {
        background-color: #0d6efd;
        color: #ffffff;
    }

    [data-bs-theme="dark"] .code-badge {
        background-color: rgba(255, 255, 255, 0.1);
        color: #ea868f;
    }
</style>
@endpush

@section('content')

    <!-- Welcome Card Area Admin -->
    <div class="card theme-card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge rounded-pill bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-3 py-2">
                    <i class="bi bi-shield-lock-fill me-1"></i> Area Admin
                </span>
            </div>
            <h1 class="h3 fw-bold mb-2">Halo, {{ $user->username }} 👋</h1>
            <p class="text-body-secondary mb-0">
                Halaman ini hanya bisa diakses oleh role <code class="code-badge">admin</code> (middleware <code class="code-badge">admin</code>).
            </p>
        </div>
    </div>

    <!-- Quick Access Menu Admin -->
    <div class="row g-3 g-md-4">
        <!-- Manage Role -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 rounded-4 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Manage Role</h2>
                    <p class="text-body-secondary small mb-0">Tambah role baru untuk dipakai saat membuat user.</p>
                </div>
            </a>
        </div>

        <!-- Manage User -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.users.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 rounded-4 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Manage User</h2>
                    <p class="text-body-secondary small mb-0">Tambah user baru dan tentukan role-nya.</p>
                </div>
            </a>
        </div>

        <!-- Download Database -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.database.export') }}" class="card theme-card theme-card-hover text-decoration-none h-100 rounded-4 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-database-down"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Download Database</h2>
                    <p class="text-body-secondary small mb-0">Unduh seluruh isi database jadi satu file .sql, siap diimpor di server.</p>
                </div>
            </a>
        </div>
    </div>

@endsection