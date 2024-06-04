@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Ketersediaan</h1>
    <a href="{{ route('ketersediaan.create') }}" class="btn btn-primary mb-3">Tambah Ketersediaan</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 20%;">Nama Bahan Baku</th>
                    <th style="width: 10%;">Jumlah Pesanan</th>
                    <th style="width: 10%;">Jumlah Persediaan</th>
                    <th style="width: 15%;">Jumlah yang Dibutuhkan</th>
                    <th style="width: 10%;">Jumlah Tersisa</th>
                    <th style="width: 15%;">Nama Pemesan</th>
                    <th style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ketersediaan as $k)
                <tr>
                    <td>{{ $k->id_ketersediaan }}</td>
                    <td>{{ $k->bahanBaku->nm_bahanbaku }}</td> <!-- Menampilkan nama bahan baku -->
                    <td>{{ $k->jml_pesanan }}</td>
                    <td>{{ $k->jml_persediaan }}</td>
                    <td>{{ $k->jml_ygdibutuhkan }}</td>
                    <td>{{ $k->jml_tersisa }}</td>
                    <td>{{ $k->nm_pemesan }}</td>
                    <td>
                        <a href="{{ route('ketersediaan.edit', $k->id_ketersediaan) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <form action="{{ route('ketersediaan.destroy', $k->id_ketersediaan) }}" method="POST"
                            class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
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