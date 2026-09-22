@extends('layouts.app')

@section('title', config('app.name') . '')

@section('content')

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

        <div class="d-flex flex-wrap gap-2 justify-content-center">
            <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Login Untuk Memulai</a>
        </div>

        <div class="col-lg-5">
            <div class="card bg-dark text-white border-secondary p-3">
               <h5 class="fw-bold mb-3 text-warning"> Cara Mengirim Pengaduan </h5>
               <ul class="list-unstyled mb-0">
                     <li class="mb-2">1, Klik tombol <strong>Buat Pengaduan Baru</strong>.</li>
                     <li class="mb-2">2, Pilih kategori sarana dan kerusakan.</li>
                     <li class="mb-2">3, Tuliskan deskripsi detail permasalahan</li>
                     <li class="mb-2">4, Kirim dan pantau statusnya di menu <strong>Riwayat</strong>.</li>
               </ul>
            </div>
        </div>
    </section>

   
@endsection
