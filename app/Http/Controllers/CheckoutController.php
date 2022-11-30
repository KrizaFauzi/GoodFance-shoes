<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Produk;
use App\Models\checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AlamatPengiriman;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
         return abort('404');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cart' => 'required',
            'alamat' => 'required',
            'order_id' => 'required',
        ]);
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status', 'cart')
                        ->get();
        $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                                                ->where('status', 'utama')
                                                ->first();
        Order::find($request->order_id)->update(['status' => 'menunggu pembayaran']);
        if( $itemcart != null && $request->param == "checkout"){
            $no_invoice = Checkout::where('user_id', $itemuser->id)->count();
            foreach($itemcart as $cart){
                $input['user_id'] = $itemuser->id;
                $input['produk_id'] = $cart->produk_id;
                $input['order_id'] = $request->order_id;
                $date = Carbon::now()->format('d');
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
                $input['invoice'] = 'INV'. "/". $month.$date.$year. "/". $cart->produk->kode_produk . "/" .str_pad(($no_invoice + 1),'3', '0', STR_PAD_LEFT).$itemuser->id;
                $input['cart_id'] = $cart->id;
                $input['seller_id'] = $cart->seller_id;
                $input['alamat_id'] = $itemalamatpengiriman->id;
                $input['nama_pembeli'] = $cart->CartDetail->nama_pembeli;
                $input['nama_seller'] = $cart->CartDetail->nama_seller;
                $input['nama_produk'] = $cart->CartDetail->nama_produk;
                $input['alamat'] = $itemalamatpengiriman->provinsi . " ," . $itemalamatpengiriman->kota . "," . $itemalamatpengiriman->kecamatan . "," . $itemalamatpengiriman->kelurahan . "," . $itemalamatpengiriman->alamat;
                $input['qty'] = $cart->CartDetail->qty;
                $input['harga'] = $cart->CartDetail->harga;
                $input['total'] = $cart->CartDetail->total;
                $input['status'] = 'menunggu pembayaran';
                $produk = Produk::findOrFail($cart->produk_id);
                if($produk->qty == 0){
                    return back()->with('error', 'tidak ada barang');
                }
                Checkout::create($input);
                $produk->update(['qty' => $produk->qty - $cart->CartDetail->qty]);
                $cart->update(['status' => 'belum dibayar']);
            }
            return redirect()->route('homepage.transaksi')->with('success', 'Checkout berhasil');
        }
       return back()->with('error', 'tidak ada barang');
    }

    public function show(checkout $checkout)
    {
        //
    }

    public function edit(checkout $checkout)
    {
        //
    }

    public function update(Request $request, checkout $checkout)
    {
        //
    }

    public function destroy(checkout $checkout)
    {
        //
    }
}
