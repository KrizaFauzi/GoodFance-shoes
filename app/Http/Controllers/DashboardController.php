<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Produk;
use App\Models\Checkout;
use App\Models\DaftarEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $produkCount = Produk::where('status','publish')->get()->count();
        $event = Event::where('status', 'publish')->get();
        $pesanan = Checkout::where('seller_id', $user->id)->where('status', 'Diproses')->get()->count();
        $orderan = Checkout::where('seller_id', $user->id)->where('status', 'Diproses')->get();
        $transaksi = Checkout::where('seller_id', $user->id)->where('status', 'Telah Datang')->get()->count();
        $eventCount = count($event);
        $userCount = User::where('status', 'aktif')->where('level', 'member')->get()->count();
        $sellerCount = User::where('status', 'aktif')->where('level', 'seller')->get()->count();
        $data = array('title' => 'Dashboard','eventCount' => $eventCount, 'event' => $event, 'userCount' => $userCount, 'sellerCount' => $sellerCount, 'produkCount' => $produkCount, 'pesanan' => $pesanan, 'transaksi' => $transaksi, 'orderan' => $orderan);
        if($user->level == "seller"){
            return view('dashboard.index', $data)->with('no', ($request->input('page', 1) - 1));
        }else if($user->level == "admin"){
            return view('admin.dashboard.index', $data);
        }
    }

    public function terima(Request $request, $id){
        $checkout = Checkout::findOrFail($id);
        $checkout->update(['status' => 'Diterima seller']);
        return redirect()->route('order.orderan')->with('success', 'Barang diterima');
    }

    public function tolak(Request $request, $id){
        $checkout = Checkout::findOrFail($id);
        $stok = $checkout->cart->Produk;
        $stok->update(['qty' => $stok->qty +  $checkout->qty]);
        $checkout->cart->update(['status' => 'ditolak']);
        $checkout->update(['status' => 'ditolak']);
        return back()->with('success', 'Barang ditolak');
    }

    public function orderan(Request $request){
        $user = $request->user();
        $orderan = Checkout::where('seller_id', $user->id)->where('status', 'Diterima Seller')->get();
        $data = array('title' => 'Orderan', 'orderan' => $orderan);
        return view('order.orderan', $data)->with('no', ($request->input('page', 1) - 1));
    }

    public function orderanold(){
        $user = $request->user();
        $orderan = Checkout::where('seller_id', $user->id)->where('status', 'Diterima member')->get();
        $data = array('title' => 'Orderan', 'orderan' => $orderan);
        return view('order.orderanold', $data)->with('no', ($request->input('page', 1) - 1));
    }
}
