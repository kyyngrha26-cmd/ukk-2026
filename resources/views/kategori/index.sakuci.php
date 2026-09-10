@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Kategori</h1>
    <a href="{{ route('kategori.create') }}" class=" btn btn-primary btn-sm mb-3">Tambah Categori</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>
                      <a href="" class="btn btn-success btn-sm">Edit</a>
                      <a href="" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $data->links() !!}
</div>
@endsection