<!-- resources/views/bahanbaku/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Bahan Baku</h1>
    <form action="{{ route('bahanbaku.update', $bahanBaku->id_bahanbaku) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nm_bahanbaku" class="form-label">Nama Bahan Baku</label>
            <input type="text" class="form-control" id="nm_bahanbaku" name="nm_bahanbaku"
                value="{{ $bahanBaku->nm_bahanbaku }}" required>
        </div>
        <div class="mb-3">
            <label for="jml_persediaan" class="form-label">Jumlah Persediaan</label>
            <input type="number" class="form-control" id="jml_persediaan" name="jml_persediaan"
                value="{{ $bahanBaku->jml_persediaan }}" required>
        </div>
        <div class="mb-3">
            <label for="satuan" class="form-label">Satuan</label>
            <input type="text" class="form-control" id="satuan" name="satuan" value="{{ $bahanBaku->satuan }}" required>
        </div>
        <div class="mb-3">
            <label for="wkt_produksi" class="form-label">Waktu Produksi</label>
            <input type="number" class="form-control" id="wkt_produksi" name="wkt_produksi"
                value="{{ $bahanBaku->wkt_produksi }}" required>
        </div>
        <div class="mb-3">
            <label for="kpsts_produksi" class="form-label">Kapasitas Produksi</label>
            <input type="number" class="form-control" id="kpsts_produksi" name="kpsts_produksi"
                value="{{ $bahanBaku->kpsts_produksi }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection