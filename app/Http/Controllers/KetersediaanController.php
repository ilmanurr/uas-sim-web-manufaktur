<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use App\Models\Ketersediaan;
use App\Models\Pemesan;
use Illuminate\Http\Request;

class KetersediaanController extends Controller
{
    public function index()
    {
        $ketersediaan = Ketersediaan::with('bahanBaku')->get();
        return view('ketersediaan.index', compact('ketersediaan'));
    }

    public function create()
    {
        $bahanBaku = BahanBaku::all();
        return view('ketersediaan.create', compact('bahanBaku'));
    }

    public function store(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_bahanbaku' => 'required|exists:bahan_bakus,id_bahanbaku',
            'nm_pemesan' => 'required|string',
            'jml_pesanan' => 'required|integer|min:1',
        ]);

        // Ambil data bahan baku terkait
        $bahanBaku = BahanBaku::find($request->id_bahanbaku);

        // Ambil data ketersediaan terakhir untuk bahan baku yang dipilih
        $lastKetersediaan = Ketersediaan::where('id_bahanbaku', $request->id_bahanbaku)
            ->orderBy('created_at', 'desc')
            ->first();

        // Jika ada data ketersediaan sebelumnya, gunakan jumlah tersisa dari data tersebut sebagai jumlah persediaan saat ini
        $currentPersediaan = $lastKetersediaan ? $lastKetersediaan->jml_tersisa : $bahanBaku->jml_persediaan;

        // Cek ketersediaan bahan baku
        if ($currentPersediaan < $request->jml_pesanan) {
            return redirect()->back()->withErrors(['msg' => 'Persediaan bahan baku tidak mencukupi']);
        }

        // Hitung jumlah tersisa
        $jml_tersisa = $currentPersediaan - $request->jml_pesanan;

        // Simpan data ketersediaan
        $ketersediaan = new Ketersediaan();
        $ketersediaan->id_bahanbaku = $request->id_bahanbaku;
        $ketersediaan->nm_pemesan = $request->nm_pemesan;
        $ketersediaan->jml_pesanan = $request->jml_pesanan;
        $ketersediaan->jml_persediaan = $currentPersediaan;
        $ketersediaan->jml_ygdibutuhkan = $request->jml_pesanan;
        $ketersediaan->jml_tersisa = $jml_tersisa;
        $ketersediaan->save();

        // Kurangi jumlah persediaan bahan baku
        $bahanBaku->jml_persediaan = $jml_tersisa;
        $bahanBaku->save();

        return redirect()->route('ketersediaan.index')->with('success', 'Ketersediaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $ketersediaan = Ketersediaan::findOrFail($id);
        $bahanBaku = BahanBaku::all();
        return view('ketersediaan.edit', compact('ketersediaan', 'bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_bahanbaku' => 'required|integer',
            'nm_pemesan' => 'required|string|max:255',
            'jml_pesanan' => 'required|integer|min:1',
        ]);

        $ketersediaan = Ketersediaan::findOrFail($id);

        // Ambil data bahan baku terkait
        $bahanBaku = BahanBaku::find($request->id_bahanbaku);

        // Hitung perbedaan pesanan
        $old_jml_pesanan = $ketersediaan->jml_pesanan;
        $new_jml_pesanan = $request->jml_pesanan;
        $diff_pesanan = $new_jml_pesanan - $old_jml_pesanan;

        // Update data ketersediaan yang diedit
        $ketersediaan->update([
            'id_bahanbaku' => $request->id_bahanbaku,
            'nm_pemesan' => $request->nm_pemesan,
            'jml_pesanan' => $request->jml_pesanan,
            'jml_ygdibutuhkan' => $request->jml_pesanan,
            'jml_tersisa' => $ketersediaan->jml_persediaan - $new_jml_pesanan,
        ]);

        // Update ketersediaan berikutnya
        $nextKetersediaan = Ketersediaan::where('id_bahanbaku', $request->id_bahanbaku)
            ->where('created_at', '>', $ketersediaan->created_at)
            ->orderBy('created_at', 'asc')
            ->get();

        $previousTersisa = $ketersediaan->jml_tersisa;

        foreach ($nextKetersediaan as $next) {
            $next->jml_persediaan = $previousTersisa;
            $next->jml_tersisa = $previousTersisa - $next->jml_pesanan;
            $next->save();

            $previousTersisa = $next->jml_tersisa;
        }

        // Update jumlah persediaan bahan baku
        $bahanBaku->jml_persediaan = $previousTersisa;
        $bahanBaku->save();

        // Update nama pemesan di tabel pemesanan
        Pemesan::where('id_ketersediaan', $ketersediaan->id_ketersediaan)
        ->update(['nm_pemesan' => $request->nm_pemesan]);

        return redirect()->route('ketersediaan.index')->with('success', 'Ketersediaan berhasil diubah');
    }

    public function destroy($id)
    {
        $ketersediaan = Ketersediaan::findOrFail($id);
        $ketersediaan->delete();

        return redirect()->route('ketersediaan.index')->with('success', 'Ketersediaan berhasil dihapus');
    }
}