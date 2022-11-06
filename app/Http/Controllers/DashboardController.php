<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Produk;
use App\Models\DaftarEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $produk = Produk::where('user_id', $user->id)->get();
        $event = Event::where('status', 'publish')->get();
        $produkCount = count($produk);
        $data = array('title' => 'Dashboard','produkCount' => $produkCount, 'produk' => $produk, 'event' => $event);
        return view('dashboard.index', $data);
    }
}
