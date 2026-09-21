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
            <a class="btn btn-brand btn-lg px-4" href="#langkah">Mulai dari sini</a>
        </div>

       
    </section>

   
@endsection
