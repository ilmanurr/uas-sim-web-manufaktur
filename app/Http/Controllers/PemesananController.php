<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Ketersediaan;
use App\Models\Pemesan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanan = Pemesan::all();
        return view('pemesanan.index', compact('pemesanan'));
    }

    public function create()
    {
        $ketersediaan = Ketersediaan::all();
        return view('pemesanan.create', compact('ketersediaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ketersediaan' => 'required|exists:ketersediaans,id_ketersediaan',
            'nm_pemesan' => 'required|string',
            'jml_pesanan' => 'required|integer|min:1',
            'tgl_pemesanan' => 'required|date',
        ]);

        $ketersediaan = Ketersediaan::find($request->id_ketersediaan);

        // Hapus validasi jumlah tersisa
        // if ($ketersediaan->jml_tersisa < $request->jml_pesanan) {
        //     return redirect()->back()->withErrors(['msg' => 'Persediaan bahan baku tidak mencukupi']);
        // }

        // Hapus pengurangan jumlah tersisa
        // $ketersediaan->jml_tersisa -= $request->jml_pesanan;
        // $ketersediaan->save();

        $pemesanan = new Pemesan();
        $pemesanan->id_ketersediaan = $request->id_ketersediaan;
        $pemesanan->nm_pemesan = $request->nm_pemesan;
        $pemesanan->jml_pesanan = $request->jml_pesanan;
        $pemesanan->tgl_pemesanan = $request->tgl_pemesanan;

        $bahanBaku = BahanBaku::find($ketersediaan->id_bahanbaku);
        $totalProductionDays = $bahanBaku->calculateTotalProductionTime($request->jml_pesanan);
        $tgl_penyelesaian = Carbon::parse($request->tgl_pemesanan)->addDays($totalProductionDays);

        $pemesanan->tgl_penyelesaian = $tgl_penyelesaian;
        $pemesanan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pemesanan = Pemesan::findOrFail($id);
        $ketersediaan = Ketersediaan::all();
        return view('pemesanan.edit', compact('pemesanan', 'ketersediaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_ketersediaan' => 'required|exists:ketersediaans,id_ketersediaan',
            'nm_pemesan' => 'required|string',
            'jml_pesanan' => 'required|integer|min:1',
            'tgl_pemesanan' => 'required|date',
        ]);

        $pemesanan = Pemesan::findOrFail($id);
        $ketersediaan = Ketersediaan::find($request->id_ketersediaan);
        $bahanBaku = BahanBaku::find($ketersediaan->id_bahanbaku);

        $jumlahPesananBaru = $request->jml_pesanan;
        $jumlahPesananLama = $pemesanan->jml_pesanan;
        $selisihPesanan = $jumlahPesananBaru - $jumlahPesananLama;

        // Hapus validasi jumlah tersisa
        // if ($ketersediaan->jml_persediaan < $selisihPesanan) {
        //     return redirect()->back()->withErrors(['msg' => 'Persediaan bahan baku tidak mencukupi untuk perubahan pesanan']);
        // }

        $totalProductionDays = $bahanBaku->calculateTotalProductionTime($jumlahPesananBaru);
        $tgl_pemesanan = Carbon::parse($request->tgl_pemesanan);
        $tgl_penyelesaian = $tgl_pemesanan->addDays($totalProductionDays);

        $pemesanan->id_ketersediaan = $request->id_ketersediaan;
        $pemesanan->nm_pemesan = $request->nm_pemesan;
        $pemesanan->jml_pesanan = $jumlahPesananBaru;
        $pemesanan->tgl_pemesanan = $request->tgl_pemesanan;
        $pemesanan->tgl_penyelesaian = $tgl_penyelesaian;
        $pemesanan->save();

        // Hapus pengurangan jumlah tersisa
        // $ketersediaan->jml_persediaan -= $selisihPesanan;
        // $ketersediaan->save();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil diubah');
    }

    public function destroy($id)
    {
        $pemesanan = Pemesan::findOrFail($id);
        $pemesanan->delete();

        return redirect()->route('pemesanan.index')->with('success', 'Pemesanan berhasil dihapus');
    }
}