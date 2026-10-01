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
            transform: translateY(20px);
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
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    /* Stagger Delays */
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }

    /* Hover Micro-interactions */
    .hover-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06) !important;
    }

    .hover-btn {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-btn:hover {
        transform: translateY(-2px);
    }

    /* Pulse Icon Animation */
    .pulse-icon {
        display: inline-block;
        animation: pulseSoft 3s infinite ease-in-out;
    }
</style>
@endpush

@section('content')
<div class="py-3 py-md-4">

    {{-- Hero Section --}}
    <section class="text-center mx-auto mb-5 px-3 animate-fade-up" style="max-width: 800px;">
        {{-- Badge Status --}}
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1.5 rounded-pill bg-primary-subtle text-primary border border-primary-subtle mb-3">
            <i class="bi bi-shield-check"></i>
            <span class="small fw-semibold">Layanan Pengaduan Resmi Sekolah</span>
        </div>
        
        {{-- Judul Utama --}}
        <h1 class="display-5 fw-bold mb-3">
            Sarana & Prasarana Sekolah<br class="d-none d-md-inline">
            <span class="text-primary">SMK Sangkuriang 1 Cimahi</span>
        </h1>

        {{-- Deskripsi Ringkas --}}
        <p class="text-secondary fs-5 mb-4 px-md-3">
            Laporkan kerusakan fasilitas, sarana, dan prasarana di lingkungan sekolah secara online. Pantau status penanganannya dengan transparan, mudah, dan cepat.
        </p>

        {{-- Tombol Utama --}}
        <div class="d-flex flex-wrap gap-3 justify-content-center align-items-center">
            @if ($currentUser)
                <a class="btn btn-primary btn-lg px-4 py-2.5 rounded-3 d-inline-flex align-items-center gap-2 fw-semibold hover-btn" href="{{ route('aspirasi.index') }}">
                    <i class="bi bi-pencil-square"></i>
                    <span>Buat & Lihat Laporan</span>
                </a>
            @else
                <a class="btn btn-primary btn-lg px-4 py-2.5 rounded-3 d-inline-flex align-items-center gap-2 fw-semibold hover-btn" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Login Untuk Memulai</span>
                </a>
            @endif
        </div>
    </section>

    {{-- Akses Cepat Menu Utama --}}
    <section class="container mb-5">
        <div class="d-flex align-items-center justify-content-center gap-2 mb-4 animate-fade-up delay-1">
            <i class="bi bi-grid-1x2-fill text-primary fs-5"></i>
            <h4 class="fw-bold mb-0">Layanan Sarpras</h4>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Card Alat & Fasilitas --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-1">
                <div class="card border p-3 text-center h-100 rounded-3 hover-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="rounded-3 bg-primary bg-opacity-10 text-primary p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-tools fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Alat & Fasilitas</h5>
                        <p class="text-secondary small mb-4">Lihat daftar alat dan inventaris sarana prasarana sekolah yang dapat dilaporkan.</p>
                        <a href="{{ route('alat.index') }}" class="btn btn-outline-primary btn-sm rounded-2 mt-auto w-100 fw-semibold hover-btn">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Daftar Alat
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Kategori Sarana --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-2">
                <div class="card border p-3 text-center h-100 rounded-3 hover-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="rounded-3 bg-warning bg-opacity-10 text-warning p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-grid-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Kategori Sarana</h5>
                        <p class="text-secondary small mb-4">Kelompokkan fasilitas berdasarkan jenis, ruangan kelas, laboratorium, dan gedung sekolah.</p>
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary btn-sm rounded-2 mt-auto w-100 fw-semibold hover-btn">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Kategori
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Laporkan Aspirasi --}}
            <div class="col-lg-4 col-md-6 animate-fade-up delay-3">
                <div class="card border p-3 text-center h-100 rounded-3 hover-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="rounded-3 bg-success bg-opacity-10 text-success p-3 mb-3 d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                            <i class="bi bi-chat-square-text-fill fs-4"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Laporkan Aspirasi</h5>
                        <p class="text-secondary small mb-4">Sampaikan pengaduan, keluhan kerusakan, atau usulan perbaikan sarana secara langsung.</p>
                        <a href="{{ route('aspirasi.index') }}" class="btn btn-outline-primary btn-sm rounded-2 mt-auto w-100 fw-semibold hover-btn">
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
                <div class="card border p-4 rounded-3 hover-card">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-2 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-journal-check fs-5"></i>
                        </div>
                        <h5 class="fw-bold mb-0 text-primary">Cara Mengirim Pengaduan</h5>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 28px; height: 28px; flex-shrink: 0;">1</span>
                            <div>
                                <strong class="d-block mb-1">Login ke Akun Anda</strong>
                                <p class="text-secondary small mb-0">Klik tombol <code class="px-1.5 py-0.5 rounded bg-body-tertiary border text-body">Login Untuk Memulai</code> di bagian atas.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 28px; height: 28px; flex-shrink: 0;">2</span>
                            <div>
                                <strong class="d-block mb-1">Pilih Kategori & Alat</strong>
                                <p class="text-secondary small mb-0">Pilih dari menu <a href="{{ route('kategori.index') }}" class="text-primary fw-medium text-decoration-none">Kategori</a> atau <a href="{{ route('alat.index') }}" class="text-primary fw-medium text-decoration-none">Alat</a> untuk menentukan fasilitas yang rusak.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 28px; height: 28px; flex-shrink: 0;">3</span>
                            <div>
                                <strong class="d-block mb-1">Tulis Deskripsi Detail</strong>
                                <p class="text-secondary small mb-0">Jelaskan kondisi permasalahan beserta lokasi/ruangan sekolah secara spesifik.</p>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex align-items-start gap-3">
                            <span class="badge bg-primary rounded-circle d-flex align-items-center justify-content-center p-0" style="width: 28px; height: 28px; flex-shrink: 0;">4</span>
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
                <div class="card border p-4 text-center h-100 rounded-3 hover-card">
                    <div class="fs-2 text-success mb-2 pulse-icon">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalAspirasi ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Aspirasi / Pengaduan</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border p-4 text-center h-100 rounded-3 hover-card">
                    <div class="fs-2 text-primary mb-2 pulse-icon">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalAlat ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Alat & Fasilitas</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border p-4 text-center h-100 rounded-3 hover-card">
                    <div class="fs-2 text-warning mb-2 pulse-icon">
                        <i class="bi bi-grid-3x3-gap-fill"></i>
                    </div>
                    <h2 class="fw-bold mb-1">{{ $totalKategori ?? 0 }}</h2>
                    <p class="text-secondary small mb-0 fw-medium">Total Kategori Sarana</p>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection