@extends('layouts.app')

@section('content')
<h1>Tambah Kategori</h1>
<form action="{{ route('kategori.store') }}" method="POST" class="d-flex flex-column gap-2">
    @csrf
    <label>Keterangan</label>
    <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ old('keterangan') }}" required>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection