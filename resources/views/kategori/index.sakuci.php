@extends('layouts.app')

@section('title', 'Daftar Kategori')

@push('styles')
<style>
    .hover-shadow {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-shadow:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-2">

    {{-- Header & Tombol Tambah --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="fw-bold mb-1 text-body">Data Kategori</h2>
            <p class="text-body-secondary small mb-0">Kelola daftar kategori pengelompokan alat dan aspirasi.</p>
        </div>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 fw-semibold px-3 py-2 rounded-3 shadow-sm hover-shadow">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Kategori</span>
        </a>
    </div>

    {{-- Alert Success / Error Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Card Tabel --}}
    <div class="card border bg-body-tertiary shadow-sm rounded-3">
        <div class="card-header bg-body border-bottom py-3 px-4">
            <h5 class="card-title fw-bold text-body mb-0 d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill text-primary"></i> Daftar Kategori Terdaftar
            </h5>
        </div>

        <div class="card-body p-0 bg-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary text-body-secondary">
                        <tr class="border-bottom">
                            <th scope="col" class="text-center py-3 px-4" style="width: 80px;">NO</th>
                            <th scope="col" class="py-3 px-4">NAMA KATEGORI</th>
                            <th scope="col" class="text-center py-3 px-4" style="width: 200px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $d)
                            <tr class="border-bottom">
                                {{-- Nomor Urut --}}
                                <td class="text-center py-3 px-4 fw-semibold text-body-secondary">
                                    <span class="badge bg-body-tertiary text-body border rounded-circle p-2" style="min-width: 32px;">
                                        {{ $data->firstItem() ? $data->firstItem() + $index : $index + 1 }}
                                    </span>
                                </td>

                                {{-- Nama Kategori --}}
                                <td class="py-3 px-4">
                                    <div class="fw-bold text-body d-flex align-items-center gap-2">
                                        <i class="bi bi-tag text-primary"></i>
                                        <span>{{ $d->nama_kategori }}</span>
                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="text-center py-3 px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategori.edit', ['kategori' => $d->id_kategori]) }}" class="btn btn-sm btn-outline-warning d-inline-flex align-items-center gap-1 rounded-2 px-3 fw-semibold">
                                            <i class="bi bi-pencil-square"></i>
                                            <span>Edit</span>
                                        </a>

                                        <form action="{{ route('kategori.destroy', ['kategori' => $d->id_kategori]) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1 rounded-2 px-3 fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori {{ $d->nama_kategori }}?')">
                                                <i class="bi bi-trash-fill"></i>
                                                <span>Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-5 text-body-secondary">
                                    <i class="bi bi-folder-x fs-1 text-secondary opacity-50 d-block mb-2"></i>
                                    <p class="mb-0 fw-semibold">Belum ada data kategori yang tersimpan.</p>
                                    <small>Klik tombol <strong>Tambah Kategori</strong> di atas untuk menambahkan data baru.</small>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer & Paginasi --}}
        @if ($data->hasPages())
            <div class="card-footer bg-body border-top py-3 px-4 d-flex justify-content-end">
                {!! $data->links() !!}
            </div>
        @endif
    </div>
</div>
@endsection