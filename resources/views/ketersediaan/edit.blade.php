@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ketersediaan</h1>
    <form action="{{ route('ketersediaan.update', $ketersediaan->id_ketersediaan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="id_bahanbaku">Pilih Bahan Baku</label>
            <select class="form-control" id="id_bahanbaku" name="id_bahanbaku" required>
                @foreach($bahanBaku as $bahan)
                <option value="{{ $bahan->id_bahanbaku }}"
                    {{ $bahan->id_bahanbaku == $ketersediaan->id_bahanbaku ? 'selected' : '' }}>
                    {{ $bahan->nm_bahanbaku }} (Persediaan: {{ $bahan->jml_persediaan }})
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nm_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" id="nm_pemesan" name="nm_pemesan"
                value="{{ $ketersediaan->nm_pemesan }}" required>
        </div>
        <div class="form-group">
            <label for="jml_pesanan">Jumlah Pesanan</label>
            <input type="number" class="form-control" id="jml_pesanan" name="jml_pesanan"
                value="{{ $ketersediaan->jml_pesanan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection