@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    /* Styling Card Adaptif Light & Dark Mode */
    .theme-card {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
        border: 1px solid var(--bs-border-color);
        border-radius: 16px;
        transition: all 0.25s ease-in-out;
    }

    .theme-card-hover {
        transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
    }

    .theme-card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(168, 85, 247, 0.15) !important;
        border-color: rgba(168, 85, 247, 0.4) !important;
    }

    /* Badge Area Admin */
    .badge-admin {
        background-color: var(--brand-subtle);
        color: var(--brand-text);
        border: 1px solid rgba(168, 85, 247, 0.25);
    }

    /* Container untuk Icon Feature (Tema Soft Lavender) */
    .feature-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        background-color: var(--brand-subtle);
        color: var(--brand);
        border: 1px solid rgba(168, 85, 247, 0.2);
        transition: all 0.25s ease;
    }

    .theme-card-hover:hover .feature-icon {
        background-color: var(--brand);
        color: #ffffff;
        border-color: var(--brand);
    }

    /* Styling Teks Kode/Inline Code Adaptif */
    .code-badge {
        font-family: var(--bs-font-monospace);
        padding: 0.2em 0.45em;
        border-radius: 0.375rem;
        font-size: 0.875em;
        background-color: var(--brand-subtle);
        color: var(--brand-text);
        border: 1px solid rgba(168, 85, 247, 0.25);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-3">

    <!-- Welcome Card Area Admin -->
    <div class="card theme-card shadow-sm mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge badge-admin rounded-pill px-3 py-2 d-inline-flex align-items-center gap-1">
                    <i class="bi bi-shield-lock-fill"></i> Area Admin
                </span>
            </div>
            <h1 class="h3 fw-bold mb-2 text-body">Halo, {{ $user->username }} 👋</h1>
            <p class="text-secondary mb-0">
                Halaman ini hanya bisa diakses oleh role <code class="code-badge">admin</code> (middleware <code class="code-badge">admin</code>).
            </p>
        </div>
    </div>

    <!-- Quick Access Menu Admin -->
    <div class="row g-3 g-md-4">
        <!-- Manage Role -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Manage Role</h2>
                    <p class="text-secondary small mb-0">Tambah role baru untuk dipakai saat membuat user.</p>
                </div>
            </a>
        </div>

        <!-- Manage User -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.users.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Manage User</h2>
                    <p class="text-secondary small mb-0">Tambah user baru dan tentukan role-nya.</p>
                </div>
            </a>
        </div>

        <!-- Download Database -->
        <div class="col-12 col-md-6 col-lg-4">
            <a href="{{ route('admin.database.export') }}" class="card theme-card theme-card-hover text-decoration-none h-100 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-database-down"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Download Database</h2>
                    <p class="text-secondary small mb-0">Unduh seluruh isi database jadi satu file .sql, siap diimpor di server.</p>
                </div>
            </a>
        </div>
    </div>

</div>
@endsection