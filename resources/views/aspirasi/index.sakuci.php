@extends('layouts.app')

@section('title', 'Daftar Aspirasi')

@php
    $currentUser = class_exists('\App\Models\User') && method_exists('\App\Models\User', 'current') 
        ? \App\Models\User::current() 
        : auth()->user();
    $isAdmin = $currentUser && isset($currentUser->role) && $currentUser->role === 'admin';
@endphp

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
    .img-preview {
        object-fit: cover;
        width: 60px;
        height: 60px;
        border-radius: 8px;
        border: 1px solid var(--bs-border-color);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">
    
    {{-- Header & Tombol Tambah --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">Daftar Aspirasi</h2>
            <p class="text-body-secondary small mb-0">Kelola dan pantau seluruh laporan pengaduan sarana prasarana.</p>
        </div>
        <a href="{{ route('aspirasi.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 rounded-3 shadow-sm hover-shadow">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Tambah Aspirasi</span>
        </a>
    </div>

    {{-- Alert Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="card border bg-body-tertiary shadow-sm rounded-3 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom">
                        <tr class="text-body-secondary small fw-semibold text-uppercase">
                            <th class="ps-4 py-3" style="width: 50px;">No</th>
                            <th class="py-3" style="width: 80px;">Foto</th>
                            <th class="py-3" style="min-width: 150px;">Judul</th>
                            <th class="py-3" style="min-width: 120px;">Kategori</th>
                            <th class="py-3" style="min-width: 200px;">Deskripsi</th>
                            <th class="py-3" style="min-width: 180px;">Tanggapan Admin</th>
                            <th class="py-3 text-center" style="width: 100px;">Status</th>
                            <th class="pe-4 py-3 text-end" style="min-width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $item)
                            <tr>
                                <td class="ps-4 fw-medium text-body-secondary">{{ $index + 1 }}</td>
                                
                                {{-- Foto Aspirasi --}}
                                <td>
                                    @if($item->foto)
                                        <a href="{{ asset('uploads/aspirasi/' . $item->foto) }}" target="_blank">
                                            <img src="{{ asset('uploads/aspirasi/' . $item->foto) }}" alt="Foto Aspirasi" class="img-preview hover-shadow">
                                        </a>
                                    @else
                                        <div class="bg-body-tertiary border rounded d-flex align-items-center justify-content-center text-body-secondary" style="width: 60px; height: 60px; font-size: 0.8rem;">
                                            <i class="bi bi-image fs-5"></i>
                                        </div>
                                    @endif
                                </td>

                                {{-- Judul & Kategori --}}
                                <td>
                                    <span class="fw-semibold text-body d-block mb-0">{{ $item->judul }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-body-tertiary text-body border px-2 py-1 fw-normal">
                                        <i class="bi bi-tag-fill me-1 text-primary"></i>
                                        {{ $item->kategori->nama_kategori ?? '-' }}
                                    </span>
                                </td>

                                {{-- Deskripsi --}}
                                <td>
                                    <p class="text-body-secondary small mb-0 text-break" style="max-width: 280px;">
                                        {{ $item->deskripsi }}
                                    </p>
                                </td>

                                {{-- Tanggapan Admin --}}
                                <td>
                                    @if(!empty($item->tanggapan))
                                        <div class="p-2 rounded bg-body-tertiary text-body small border-start border-3 border-success">
                                            <i class="bi bi-chat-left-text text-success me-1"></i>
                                            {{ $item->tanggapan }}
                                        </div>
                                    @else
                                        <span class="text-body-tertiary small fst-italic">Belum ditanggapi</span>
                                    @endif
                                </td>

                                {{-- Status Badges --}}
                                <td class="text-center">
                                    @if(strtolower($item->status) === 'selesai')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i> Selesai
                                        </span>
                                    @elseif(strtolower($item->status) === 'proses')
                                        <span class="badge bg-info-subtle text-info border border-info-subtle px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-hourglass-split"></i> Proses
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2.5 py-1.5 rounded-pill fw-medium d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-clock"></i> Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- Tombol Aksi --}}
                                <td class="pe-4 text-end">
                                    <div class="d-inline-flex gap-1">
                                        @if($isAdmin)
                                            {{-- Tombol Tanggapi --}}
                                            <button type="button" class="btn btn-sm btn-info text-white rounded-2 d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalTanggapan{{ $item->id_aspirasi }}" title="Tanggapi">
                                                <i class="bi bi-reply-fill"></i>
                                                <span class="d-none d-xl-inline">Tanggapi</span>
                                            </button>

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.aspirasi.edit', ['id_aspirasi' => $item->id_aspirasi]) }}" class="btn btn-sm btn-warning text-dark rounded-2 d-inline-flex align-items-center gap-1" title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                                <span class="d-none d-xl-inline">Edit</span>
                                            </a>
                                        @endif

                                        @php
                                            $destroyRoute = $isAdmin 
                                                ? route('admin.aspirasi.destroy', ['id_aspirasi' => $item->id_aspirasi]) 
                                                : route('aspirasi.destroy', ['id_aspirasi' => $item->id_aspirasi]);
                                        @endphp

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ $destroyRoute }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data aspirasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger rounded-2 d-inline-flex align-items-center gap-1" title="Hapus">
                                                <i class="bi bi-trash-fill"></i>
                                                <span class="d-none d-xl-inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>

                                    {{-- Modal Tanggapan Admin --}}
                                    @if($isAdmin)
                                    <div class="modal fade text-start" id="modalTanggapan{{ $item->id_aspirasi }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border bg-body shadow rounded-3">
                                                <div class="modal-header border-bottom bg-body-tertiary">
                                                    <h5 class="modal-title fw-bold text-body d-flex align-items-center gap-2">
                                                        <i class="bi bi-chat-left-dots text-primary"></i>
                                                        Beri Tanggapan Aspirasi
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.aspirasi.tanggapi', ['id_aspirasi' => $item->id_aspirasi]) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body p-4 bg-body">
                                                        <div class="mb-3 p-3 bg-body-tertiary rounded-3 border">
                                                            <label class="form-label fw-bold text-body-secondary small text-uppercase mb-1">Judul Aspirasi</label>
                                                            <p class="fw-semibold text-body mb-0">{{ $item->judul }}</p>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggapan" class="form-label fw-bold text-body">Isi Tanggapan <span class="text-danger">*</span></label>
                                                            <textarea class="form-control bg-body text-body border-secondary-subtle rounded-2" name="tanggapan" id="tanggapan" rows="4" placeholder="Tuliskan tindakan atau jawaban yang relevan..." required>{{ $item->tanggapan }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer bg-body-tertiary border-top">
                                                        <button type="button" class="btn btn-outline-secondary rounded-2" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary rounded-2 d-inline-flex align-items-center gap-1">
                                                            <i class="bi bi-send-fill"></i> Kirim & Selesai
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <div class="text-body-secondary">
                                        <i class="bi bi-inbox fs-1 d-block mb-2 text-body-tertiary"></i>
                                        <h6 class="fw-semibold text-body">Belum Ada Data Aspirasi</h6>
                                        <p class="small mb-0">Klik tombol "Tambah Aspirasi" untuk membuat laporan pertama.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection