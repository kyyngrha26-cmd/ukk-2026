@extends ('layouts.app')

@section ('content')

<div class="container">
    <h1>Kategori</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Keterangan</th>
                <th></th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = ($data->currentPage() - 1) * $data->perPage()
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