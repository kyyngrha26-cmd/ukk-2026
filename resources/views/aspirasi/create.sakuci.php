@extends('layouts.app')

@section('title', 'Tambah Aspirasi')

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
            <h2 class="fw-bold mb-1 text-body">Tambah Aspirasi Baru</h2>
            <p class="text-body-secondary small mb-0">Sampaikan laporan pengaduan atau aspirasi Anda terkait sarana prasarana.</p>
        </div>
        <a href="{{ route('aspirasi.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 rounded-3 shadow-sm">
            <i class="bi bi-arrow-left"></i>
            <span>Kembali</span>
        </a>
    </div>

    {{-- Form Card --}}
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-8">
            <div class="card border bg-body-tertiary shadow-sm rounded-3">
                <div class="card-header bg-body border-bottom py-3 px-4">
                    <h5 class="card-title fw-bold text-body mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle-fill text-primary"></i> Form Pengajuan Aspirasi
                    </h5>
                </div>

                <div class="card-body p-4 bg-body">
                    <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- 1. Dropdown Kategori --}}
                        <div class="mb-3">
                            <label for="id_kategori" class="form-label fw-semibold text-body">
                                Kategori <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-tag-fill"></i></span>
                                <select name="id_kategori" id="id_kategori" class="form-select bg-body text-body border-secondary-subtle @error('id_kategori') is-invalid @enderror" required>
                                    <option value="" class="bg-body text-body">-- Pilih Kategori --</option>
                                    @foreach($kategori as $kat)
                                        <option value="{{ $kat->id_kategori }}" class="bg-body text-body" {{ old('id_kategori') == $kat->id_kategori ? 'selected' : '' }}>
                                            {{ $kat->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('id_kategori')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 2. Input Judul --}}
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold text-body">
                                Judul Aspirasi <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text input-group-text-theme"><i class="bi bi-type-h1"></i></span>
                                <input type="text" class="form-control bg-body text-body border-secondary-subtle @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Masukkan judul aspirasi..." required>
                            </div>
                            @error('judul')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 3. Input Deskripsi --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold text-body">
                                Deskripsi Detail <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control bg-body text-body border-secondary-subtle @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Jelaskan secara rinci pengaduan atau aspirasi Anda..." required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- 4. Upload Foto Bukti --}}
                        <div class="mb-4">
                            <label for="foto" class="form-label fw-semibold text-body">Foto Bukti Pendukung (Opsional)</label>
                            
                            {{-- Live Preview Image Container --}}
                            <div id="preview-container" class="mb-2 d-none text-start">
                                <span class="d-block text-primary small mb-1 fw-semibold">Pratinjau Foto Bukti:</span>
                                <img id="img-preview" src="#" alt="Pratinjau Foto" class="rounded border border-primary shadow-sm p-1" style="width: 120px; height: 120px; object-fit: cover;">
                            </div>

                            <input type="file" class="form-control bg-body text-body border-secondary-subtle @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/*" onchange="previewImage(event)">
                            <div class="form-text text-body-secondary">
                                <i class="bi bi-info-circle me-1"></i> Format yang didukung: JPG, JPEG, PNG (Maksimal 2MB).
                            </div>
                            @error('foto')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-3 border-top d-flex gap-2 justify-content-end">
                            <a href="{{ route('aspirasi.index') }}" class="btn btn-outline-secondary px-4 rounded-3 fw-semibold">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm hover-shadow">
                                <i class="bi bi-send-fill"></i>
                                <span>Kirim Aspirasi</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('preview-container');
        const imgPreview = document.getElementById('img-preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imgPreview.src = e.target.result;
                previewContainer.classList.remove('d-none');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            previewContainer.classList.add('d-none');
        }
    }
</script>
@endpush