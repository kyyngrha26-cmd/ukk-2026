@extends('layouts.app')

@section('title', 'Edit Pengguna')

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    /* Penyesuaian Input Group Icon agar fleksibel di Dark/Light Mode */
    .input-group-text-theme {
        background-color: var(--bs-tertiary-bg);
        color: var(--bs-secondary-color);
        border-color: var(--bs-border-color);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">

    {{-- Header & Tombol Kembali --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">Edit Data Pengguna</h2>
            <p class="text-body-secondary small mb-0">Perbarui informasi profil pengguna/siswa dalam sistem.</p>
        </div>
        <a href="{{ route('pengguna.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 rounded-3 shadow-sm">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-6">
            <div class="card border bg-body-tertiary shadow-sm rounded-3">
                <div class="card-header bg-body border-bottom py-3 px-4">
                    <h5 class="card-title fw-bold text-body mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-primary"></i> Form Perubahan Pengguna
                    </h5>
                </div>

                <div class="card-body p-4 bg-body">
                    <form action="{{ route('pengguna.update', ['pengguna' => $siswa->id_siswa]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- 1. Nama Lengkap --}}
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold text-body">
                                Nama Lengkap <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-person-fill"></i></span>
                                <input type="text" class="form-control bg-body text-body border-secondary-subtle @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" placeholder="Masukkan nama lengkap..." required>
                            </div>
                            @error('nama')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. NIS --}}
                        <div class="mb-3">
                            <label for="nis" class="form-label fw-semibold text-body">
                                NIS (Nomor Induk Siswa) <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-card-heading"></i></span>
                                <input type="text" class="form-control bg-body text-body border-secondary-subtle @error('nis') is-invalid @enderror" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" placeholder="Masukkan NIS..." required>
                            </div>
                            @error('nis')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. Kelas --}}
                        <div class="mb-4">
                            <label for="kelas" class="form-label fw-semibold text-body">
                                Kelas <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-mortarboard-fill"></i></span>
                                <input type="text" class="form-control bg-body text-body border-secondary-subtle @error('kelas') is-invalid @enderror" id="kelas" name="kelas" value="{{ old('kelas', $siswa->kelas) }}" placeholder="Contoh: XII RPL 1" required>
                            </div>
                            @error('kelas')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-3 border-top d-flex gap-2 justify-content-end">
                            <a href="{{ route('pengguna.index') }}" class="btn btn-outline-secondary px-4 rounded-3 fw-semibold">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm hover-shadow">
                                <i class="bi bi-floppy-fill"></i>
                                <span>Simpan Perubahan</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection