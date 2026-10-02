@php
    $totalAlat = \App\Models\Alat::count();
    $totalAspirasi = \App\Models\Aspirasi::count();
    $totalKategori = \App\Models\Kategori::count();

    // Cek status user login saat ini
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
        ? \App\Models\User::current() 
        : auth()->user();
@endphp

@extends('layouts.app')

@section('title', config('app.name') . ' - Beranda')

@push('styles')
<style>
    /* Keyframe Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(24px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulseSoft {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.08);
        }
    }

    /* Class Animasi Entry */
    .animate-fade-up {
        animation: fadeInUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    /* Stagger Delays */
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }

    /* Glow Effect menggunakan Variabel Branding Tema */
    .hero-glow {
        position: relative;
    }
    .hero-glow::before {
        content: '';
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, var(--brand-subtle) 0%, rgba(0, 0, 0, 0) 70%);
        z-index: -1;
        pointer-events: none;
        border-radius: 50%;
        filter: blur(40px);
    }

    /* Gradient Teks Branding */
    .gradient-text {
        background: var(--brand-mark-bg);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Pulse Icon Animation */
    .pulse-icon {
        display: inline-block;
        animation: pulseSoft 3s infinite ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="py-3 py-md-5">

    {{-- Hero Section --}}
    <section class="text-center mx-auto mb-5 px-3 animate-fade-up hero-glow" style="max-width: 820px;">
        {{-- Badge Status --}}
        <div class="d-inline-flex align-items-center gap-2 mb-4">
            <span class="badge-brand d-inline-flex align-items-center gap-2 shadow-sm">
                <i class="bi bi-shield-check fs-6"></i>
                <span class="small">Layanan Pengaduan Resmi Sekolah</span>
            </span>
        </div>
        
        {{-- Judul Utama --}}
        <h1 class="display-4 fw-extrabold mb-3 lh-sm">
            Sarana & Prasarana Sekolah<br class="d-none d-md-inline">
            <span class="gradient-text">SMK Sangkuriang 1 Cimahi</span>
        </h1>

        {{-- Deskripsi Ringkas --}}
        <p class="text-secondary fs-5 mb-4 px-md-4">
            Laporkan kerusakan fasilitas, sarana, dan prasarana sekolah secara online. Pantau status penanganannya dengan transparan, mudah, dan cepat.
        </p>

        {{-- Tombol Utama --}}
        <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
            @if ($currentUser)
                <a class="btn btn-brand btn-lg px-4 py-2.5 d-inline-flex align-items-center gap-2" href="{{ route('aspirasi.index') }}">
                    <i class="bi bi-pencil-square"></i>
                    <span>Buat & Lihat Laporan</span>
                </a>
            @else
                <a class="btn btn-brand btn-lg px-4 py-2.5 d-inline-flex align-items-center gap-2" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login Untuk Memulai</span>
                </a>
            @endif
        </div>
    </section>

    {{-- Akses Cepat Menu Utama --}}
    <section class="container mb-5">
        <div class="d-flex align-items-center justify-content-center gap-2 mb-4 animate-fade-up delay-1">
            <i class="bi bi-grid-1x2-fill text-brand fs-5"></i>
            <h4 class="fw-bold mb-0">Layanan Sarpras</h4>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Card Alat & Fasilitas --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-1">
                <div class="card card-info p-3 text-center h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center p-3">
                        <div class="feature-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Alat & Fasilitas</h5>
                        <p class="text-secondary small mb-4">Lihat daftar alat dan inventaris sarana prasarana sekolah yang dapat dilaporkan.</p>
                        <a href="{{ route('alat.index') }}" class="btn btn-outline-brand btn-sm mt-auto w-100 py-2">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Daftar Alat
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Kategori Sarana --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-2">
                <div class="card card-info p-3 text-center h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center p-3">
                        <div class="feature-icon">
                            <i class="bi bi-grid-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Kategori Sarana</h5>
                        <p class="text-secondary small mb-4">Kelompokkan fasilitas berdasarkan jenis, ruangan kelas, laboratorium, dan gedung sekolah.</p>
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-brand btn-sm mt-auto w-100 py-2">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Kategori
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Laporkan Aspirasi --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-3">
                <div class="card card-info p-3 text-center h-100 shadow-sm">
                    <div class="card-body d-flex flex-column align-items-center p-3">
                        <div class="feature-icon">
                            <i class="bi bi-chat-square-text-fill"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Laporkan Aspirasi</h5>
                        <p class="text-secondary small mb-4">Sampaikan pengaduan, keluhan kerusakan, atau usulan perbaikan sarana secara langsung.</p>
                        <a href="{{ route('aspirasi.index') }}" class="btn btn-outline-brand btn-sm mt-auto w-100 py-2">
                            <i class="bi bi-pencil-square me-1"></i> Buat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Panduan Pengaduan --}}
    <section class="container mb-5 animate-fade-up delay-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-info p-4 p-md-5 shadow-sm">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="step-badge">
                            <i class="bi bi-journal-check fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-brand">Cara Mengirim Pengaduan</h5>
                            <span class="text-secondary small">Ikuti 4 langkah mudah untuk melaporkan fasilitas sekolah</span>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="step-number shadow-sm">1</span>
                            <div>
                                <strong class="d-block mb-1">Login ke Akun Anda</strong>
                                <p class="text-secondary small mb-0">Klik tombol <code class="inline">Login Untuk Memulai</code> di bagian atas halaman.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="step-number shadow-sm">2</span>
                            <div>
                                <strong class="d-block mb-1">Pilih Kategori & Alat</strong>
                                <p class="text-secondary small mb-0">Pilih dari menu <a href="{{ route('kategori.index') }}" class="text-brand fw-semibold text-decoration-none">Kategori</a> atau <a href="{{ route('alat.index') }}" class="text-brand fw-semibold text-decoration-none">Alat</a> untuk menentukan fasilitas.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="step-number shadow-sm">3</span>
                            <div>
                                <strong class="d-block mb-1">Tulis Deskripsi Detail</strong>
                                <p class="text-secondary small mb-0">Jelaskan kondisi detail keluhan beserta lokasi atau ruangan sekolah secara spesifik.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="step-number shadow-sm">4</span>
                            <div>
                                <strong class="d-block mb-1">Kirim & Pantau Status</strong>
                                <p class="text-secondary small mb-0">Kirim laporan dan cek perkembangan penanganannya di menu <strong>Aspirasi / Riwayat</strong>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Ringkasan Statistik Utama (Angka Total) --}}
    <section class="container animate-fade-up delay-4">
        <div class="row g-3 g-md-4 text-center">
            <div class="col-md-4">
                <div class="card card-info p-4 text-center h-100 shadow-sm">
                    <div class="fs-1 text-brand mb-2 pulse-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-1 display-6">{{ $totalAspirasi ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Aspirasi / Pengaduan</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info p-4 text-center h-100 shadow-sm">
                    <div class="fs-1 text-brand mb-2 pulse-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h2 class="fw-bold mb-1 display-6">{{ $totalAlat ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Alat & Fasilitas</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-info p-4 text-center h-100 shadow-sm">
                    <div class="fs-1 text-brand mb-2 pulse-icon">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-1 display-6">{{ $totalKategori ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Kategori Sarana</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection