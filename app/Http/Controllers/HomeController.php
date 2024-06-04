<?php

namespace App\Http\Controllers;

use App\Models\BahanBaku;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $bahanBaku = BahanBaku::all();
        return view('layouts.home', compact('bahanBaku'));
    }
}