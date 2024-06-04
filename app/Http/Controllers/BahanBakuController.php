<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    public function index()
    {
        $bahanBaku = BahanBaku::all();
        return view('bahanbaku.index', compact('bahanBaku'));
    }

    public function create()
    {
        return view('bahanbaku.create');
    }

    public function store(Request $request)
    {
        BahanBaku::create($request->all());
        return redirect()->route('bahanbaku.index');
    }

    public function edit(BahanBaku $bahanBaku, $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        return view('bahanbaku.edit', compact('bahanBaku'));
    }

    public function update(Request $request, $id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->update($request->all());
        return redirect()->route('bahanbaku.index')->with('success', 'Bahan baku updated successfully');
    }

    public function destroy($id)
    {
        $bahanBaku = BahanBaku::findOrFail($id);
        $bahanBaku->delete();

        return redirect()->route('bahanbaku.index')->with('success', 'Bahan baku deleted successfully');
    }
}