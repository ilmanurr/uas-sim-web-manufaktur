<!-- resources/views/pemesanan/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pemesanan</h1>
    <a href="{{ route('pemesanan.create') }}" class="btn btn-primary mb-3">Tambah Pemesanan</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID Pemesan</th>
                    <th>Nama Pemesan</th>
                    <th>Jumlah Pesanan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Penyelesaian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanan as $p)
                <tr>
                    <td>{{ $p->id_pemesan }}</td>
                    <td>{{ $p->nm_pemesan }}</td>
                    <td>{{ $p->jml_pesanan }}</td>
                    <td>{{ $p->tgl_pemesanan }}</td>
                    <td>{{ $p->tgl_penyelesaian }}</td>
                    <td>
                        <a href="{{ route('pemesanan.edit', $p->id_pemesan) }}" class="btn btn-warning">
                            <i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('pemesanan.destroy', $p->id_pemesan) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection