@extends('layouts.app')

@section('content')
<form action="{{ route('admin.kategori.update', ['id_kategori' => $kategori->id]) }}" method="PUT">
    @csrf
    @method('PUT')
            <label>Keterangan</label>
            <input type="text" name="keterangan" value="{{ $kategori->keterangan }}" class="form-control mb-3" required>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
@endsection