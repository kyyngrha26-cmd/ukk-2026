@extends('layouts.app')

@section('title', 'Dashboard Siswa')

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
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
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

    /* Penyesuaian khusus Dark Mode */
    [data-bs-theme="dark"] .feature-icon {
        background-color: rgba(13, 110, 253, 0.2);
        color: #6ea8fe;
    }

    [data-bs-theme="dark"] .theme-card-hover:hover .feature-icon {
        background-color: #0d6efd;
        color: #ffffff;
    }
</style>
@endpush

@section('content')

    <!-- Welcome Card -->
    <div class="card theme-card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="d-flex align-items-center gap-2 mb-3">
                <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 px-3 py-2">
                    Role: {{ ucfirst($user->role) }}
                </span>
            </div>
            <h1 class="h3 fw-bold mb-2">Selamat Datang, {{ $user->username }}! 👋</h1>
            <p class="text-body-secondary mb-0 max-w-xl">
                Selamat datang di Sistem Pengaduan Sarana & Prasarana. Gunakan menu di bawah ini untuk menyampaikan aspirasi atau melihat daftar sarana.
            </p>
        </div>
    </div>

    <!-- Quick Access Menu -->
    <div class="row g-3 g-md-4">
        <!-- Card Pengaduan / Aspirasi -->
        <div class="col-12 col-md-6">
            <a href="{{ route('aspirasi.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 rounded-4 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Aspirasi / Pengaduan</h2>
                    <p class="text-body-secondary small mb-0">Sampaikan pengaduan, laporan kerusakan, atau aspirasi sarana prasarana.</p>
                </div>
            </a>
        </div>

        <!-- Card Data Alat & Sarana -->
        <div class="col-12 col-md-6">
            <a href="{{ route('alat.index') }}" class="card theme-card theme-card-hover text-decoration-none h-100 rounded-4 shadow-sm">
                <div class="card-body p-4 text-center d-flex flex-column align-items-center justify-content-center">
                    <div class="feature-icon mb-3">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h2 class="h5 fw-bold mb-2 text-body">Data Alat & Sarana</h2>
                    <p class="text-body-secondary small mb-0">Lihat daftar alat dan fasilitas sarana prasarana yang tersedia di sekolah.</p>
                </div>
            </a>
        </div>
    </div>

@endsection