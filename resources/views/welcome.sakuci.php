@extends('layouts.app')

@section('title', config('app.name') . '')

@section('content')

    <style>
        .btn-brand {
            transition: all 0.2s ease;
        }

        .btn-brand:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(46, 204, 64, 0.4);
        }

        .step-badge {
            width: 26px;
            height: 26px;
            min-width: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.85rem;
        }

        .card-info {
            transition: transform 0.2s ease;
        }

        .card-info:hover {
            transform: translateY(-3px);
        }
    </style>

    {{-- Hero --}}
    <section class="text-center py-4 py-lg-5">

        <h1 class="display-5 fw-bold mb-3">
            Sarana & Prasarana Sekolah,<br class="d-none d-md-inline">
            <span class="text-brand">SMK Sangkuriang 1 Cimahi</span>
        </h1>

        <p class="lead text-secondary mx-auto mb-4" style="max-width: 620px;">
            Laporkan Kerusakan Fasilitas,sarana,prasarana di lingkungan sekolah secara langsung online
            .Pantau statusmu penanganan mu dengan mudah 
        </p>

        <div class="d-flex flex-wrap gap-2 justify-content-center mb-5">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Login Untuk Memulai</a>
        </div>

        <div class="col-lg-5 mx-auto mt-4">
            <div class="card card-info bg-dark text-white border-secondary p-4 shadow-lg">
                <h5 class="fw-bold mb-3 text-warning text-center">Cara Mengirim Pengaduan</h5>
                <ul class="list-unstyled mb-0 text-start">
                    <li class="mb-3 d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-2 step-badge">1</span>
                        <span>Klik tombol <strong>Buat Pengaduan Baru</strong>.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-2 step-badge">2</span>
                        <span>Pilih kategori sarana dan kerusakan.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-2 step-badge">3</span>
                        <span>Tuliskan deskripsi detail permasalahan.</span>
                    </li>
                    <li class="mb-0 d-flex align-items-start">
                        <span class="badge bg-warning text-dark rounded-circle me-2 step-badge">4</span>
                        <span>Kirim dan pantau statusnya di menu <strong>Riwayat</strong>.</span>
                    </li>
                </ul>
            </div>
        </div>

            <div class="row text-center mt-5 g-4">
                 <div class="col-md-4">
                 <h2 class="fw-bold text-brand">150+</h2>
                 <p class="text-secondary mb-0">Pengaduan Terselesaikan</p>
             </div>
             <div class="col-md-4">
                 <h2 class="fw-bold text-brand">24 Jam</h2>
                 <p class="text-secondary mb-0">Respon Cepat</p>
             </div>
                 <div class="col-md-4">
                 <h2 class="fw-bold text-brand">10+</h2>
                  <p class="text-secondary mb-0">Kategori Sarana</p>
            </div>
         </div>
    </section>

@endsection