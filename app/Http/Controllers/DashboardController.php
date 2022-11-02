<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $produk = Produk::where('user_id', $user->id)->get();
        $produkCount = count($produk);
        $data = array('title' => 'Dashboard','produkCount' => $produkCount);
        return view('dashboard.index', $data);
    }
}
