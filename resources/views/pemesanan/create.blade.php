@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Pemesanan</h1>
    <form action="{{ route('pemesanan.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="id_ketersediaan">Pilih Pemesanan</label>
            <select class="form-control" id="id_ketersediaan" name="id_ketersediaan" required>
                <option value="" disabled selected>Pilih Pemesanan</option>
                @foreach($ketersediaan as $item)
                <option value="{{ $item->id_ketersediaan }}" data-nm_pemesan="{{ $item->nm_pemesan }}"
                    data-jml_pesanan="{{ $item->jml_pesanan }}">
                    {{ $item->nm_pemesan }} - Jumlah Pesanan: {{ $item->jml_pesanan }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nm_pemesan">Nama Pemesan</label>
            <input type="text" class="form-control" id="nm_pemesan" name="nm_pemesan" required readonly>
        </div>
        <div class="form-group">
            <label for="jml_pesanan">Jumlah Pesanan</label>
            <input type="number" class="form-control" id="jml_pesanan" name="jml_pesanan" required readonly>
        </div>
        <div class="form-group">
            <label for="tgl_pemesanan">Tanggal Pemesanan</label>
            <input type="date" class="form-control" id="tgl_pemesanan" name="tgl_pemesanan" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah Pemesanan</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ketersediaanSelect = document.getElementById('id_ketersediaan');
    const nmPemesanInput = document.getElementById('nm_pemesan');
    const jmlPesananInput = document.getElementById('jml_pesanan');

    ketersediaanSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nmPemesan = selectedOption.getAttribute('data-nm_pemesan');
        const jmlPesanan = selectedOption.getAttribute('data-jml_pesanan');

        nmPemesanInput.value = nmPemesan;
        jmlPesananInput.value = jmlPesanan;
    });
});
</script>

@endsection