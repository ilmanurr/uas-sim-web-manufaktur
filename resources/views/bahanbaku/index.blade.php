<!-- resources/views/bahanbaku/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Bahan Baku</h1>
    <a href="{{ route('bahanbaku.create') }}" class="btn btn-primary mb-3">Tambah Bahan Baku</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Bahan Baku</th>
                    <th>Jumlah Persediaan</th>
                    <th>Satuan</th>
                    <th>Waktu Produksi</th>
                    <th>Kapasitas Produksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bahanBaku as $bahan)
                <tr>
                    <td>{{ $bahan->id_bahanbaku }}</td>
                    <td>{{ $bahan->nm_bahanbaku }}</td>
                    <td>{{ $bahan->jml_persediaan }}</td>
                    <td>{{ $bahan->satuan }}</td>
                    <td>{{ $bahan->wkt_produksi }}</td>
                    <td>{{ $bahan->kpsts_produksi }}</td>
                    <td>
                        <a href="{{ route('bahanbaku.edit', $bahan->id_bahanbaku) }}" class="btn btn-warning">
                            <i class="fas fa-pencil-alt"></i></a>
                        <form action="{{ route('bahanbaku.destroy', $bahan->id_bahanbaku) }}" method="POST"
                            class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data bahan baku ini?');">
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