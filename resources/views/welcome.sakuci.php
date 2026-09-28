@php
    $totalAlat = \App\Models\Alat::count();
    $totalAspirasi = \App\Models\Aspirasi::count(); // Tambahkan ini untuk menghitung total aspirasi/pengaduan
    $totalKategori = \App\Models\Kategori::count();

    $semuaKategori = \App\Models\Kategori::all();
    $kategoriChart = [];

    foreach ($semuaKategori as $d) {
        $jumlah = \App\Models\Aspirasi::where('id_kategori', '=', $d->id_kategori)->count();
        $kategoriChart[] = ['nama' => $d->nama_kategori, 'jumlah' => $jumlah];
    }

    usort($kategoriChart, fn($a, $b) => $b['jumlah'] <=> $a['jumlah']);
    $maxjumlah = $kategoriChart ? max(array_column($kategoriChart, 'jumlah')) : 0;
@endphp


@extends('layouts.app')

@section('title', config('app.name') . ' - Beranda')

@section('content')
{{-- Hero Section --}}
<section class="py-4 py-lg-5">
    <div class="text-center mx-auto mb-5" style="max-width: 720px;">
        <span class="badge badge-brand mb-3 d-inline-flex align-items-center gap-2">
            <i class="bi bi-shield-check"></i>
            <span>Layanan Pengaduan Resmi</span>
        </span>
        
        <h1 class="display-5 fw-bold mb-3">
            Sarana & Prasarana Sekolah<br class="d-none d-md-inline">
            <span class="text-brand">SMK Sangkuriang 1 Cimahi</span>
        </h1>

        <p class="text-secondary mb-4 px-2 fs-5">
            Laporkan kerusakan fasilitas, sarana, dan prasarana di lingkungan sekolah secara langsung online. Pantau status penanganannya dengan mudah dan cepat.
        </p>

        <div class="d-flex flex-wrap gap-3 justify-content-center">
            <a class="btn btn-brand btn-lg px-4 py-2.5 d-inline-flex align-items-center gap-2" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right fs-5"></i>
                <span>Login Untuk Memulai</span>
            </a>
        </div>
    </div>

    {{-- Akses Cepat Menu Utama (Alat & Kategori) --}}
    <div class="container mb-5">
        <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
            <i class="bi bi-grid-1x2-fill text-brand fs-5"></i>
            <h4 class="fw-bold mb-0">Layanan Sarpras</h4>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- Card Alat & Fasilitas --}}
            <div class="col-md-5 col-sm-6">
                <div class="card card-info p-3 text-center h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="feature-icon bg-brand-subtle text-brand">
                            <i class="bi bi-tools"></i>
                        </div>
                        <h5 class="fw-bold card-title mb-2">Alat & Fasilitas</h5>
                        <p class="card-text text-secondary small mb-4">Lihat daftar alat dan inventaris sarana prasarana sekolah yang dapat dilaporkan.</p>
                        <a href="{{ route('alat.index') }}" class="btn btn-outline-brand btn-sm mt-auto w-100">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Daftar Alat
                        </a>
                    </div>
                </div>
            </div>

            {{-- Card Kategori Sarana --}}
            <div class="col-md-5 col-sm-6">
                <div class="card card-info p-3 text-center h-100">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="feature-icon bg-warning bg-opacity-10 text-warning">
                            <i class="bi bi-grid-fill"></i>
                        </div>
                        <h5 class="fw-bold card-title mb-2">Kategori Sarana</h5>
                        <p class="card-text text-secondary small mb-4">Kelompokkan fasilitas berdasarkan jenis, ruangan, dan unit bangunan sekolah.</p>
                        <a href="{{ route('kategori.index') }}" class="btn btn-outline-brand btn-sm mt-auto w-100">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Kategori
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Panduan Pengaduan --}}
    <div class="row g-4 justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="card card-info p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="step-badge me-3 bg-brand-subtle text-brand">
                        <i class="bi bi-journal-check fs-5"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-brand">Cara Mengirim Pengaduan</h5>
                </div>

                <ul class="list-unstyled mb-0 text-start">
                    <li class="mb-3 d-flex align-items-start">
                        <span class="step-badge me-3">1</span>
                        <div>
                            <strong class="d-block mb-1">Login ke Akun</strong>
                            <p class="text-secondary small mb-0">Klik tombol <code class="inline">Login Untuk Memulai</code> di bagian atas halaman.</p>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="step-badge me-3">2</span>
                        <div>
                            <strong class="d-block mb-1">Pilih Kategori & Alat</strong>
                            <p class="text-secondary small mb-0">Pilih dari menu <a href="{{ route('kategori.index') }}" class="text-brand fw-semibold text-decoration-none">Kategori</a> atau <a href="{{ route('alat.index') }}" class="text-brand fw-semibold text-decoration-none">Alat</a> untuk menentukan fasilitas yang rusak.</p>
                        </div>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="step-badge me-3">3</span>
                        <div>
                            <strong class="d-block mb-1">Tulis Deskripsi Detail</strong>
                            <p class="text-secondary small mb-0">Jelaskan kondisi permasalahan beserta lokasi/ruangan sekolah secara detail.</p>
                        </div>
                    </li>
                    <li class="mb-0 d-flex align-items-start">
                        <span class="step-badge me-3">4</span>
                        <div>
                            <strong class="d-block mb-1">Kirim & Pantau Status</strong>
                            <p class="text-secondary small mb-0">Kirim laporan dan cek perkembangan penanganannya di menu <strong>Riwayat</strong>.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    {{-- Baris Statistik --}}
    <div class="row text-center g-3 g-md-4">
        <div class="col-md-4">
            <div class="card card-info p-4 text-center h-100">
                <div class="fs-1 text-success mb-2">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $totalPengaduan ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-medium">Pengaduan Terselesaikan</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-info p-4 text-center h-100">
                <div class="fs-1 text-brand mb-2">
                    <i class="bi bi-tools"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $totalAlat ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-medium">Total Alat & Fasilitas</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-info p-4 text-center h-100">
                <div class="fs-1 text-warning mb-2">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </div>
                <h2 class="fw-bold mb-1">{{ $totalKategori ?? 0 }}</h2>
                <p class="text-secondary small mb-0 fw-medium">Total Kategori Sarana</p>
            </div>
        </div>
    </div>
</section>
@endsection
