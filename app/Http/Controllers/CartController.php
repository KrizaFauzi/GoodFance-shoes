<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AlamatPengiriman;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status', 'cart')
                        ->get();
        $cartTrue = Cart::where('user_id', $itemuser->id)
                        ->where('status', 'cart')
                        ->first();
        if (isset($cartTrue) && $cartTrue){
            $data = array('title' => 'Shopping Cart',
                        'itemcart' => $itemcart);
            return view('cart.index', $data)->with('no', 1);
        } else {
            $data = array('title' => 'Shopping Cart');
            return view('cart.kosong', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'produk_id' => 'required',
            'seller_id' => 'required'      
        ]);
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->where('produk_id', $request->produk_id)->where('status', 'cart')->first();
        if($cart){
            return redirect('cart');
        }else{
            $input['produk_id'] = $request->produk_id;
            $input['user_id'] = $user->id;
            $input['seller_id'] = $request->seller_id;
            $input['status'] = 'cart';
            $itemcart = Cart::create($input);
            if($itemcart){
                $this->validate($request, [
                    'produk_id' => 'required',
                    'seller_id' => 'required',
                    'qty' => 'required',
                    'harga' => 'required'
                ]);
                $input2 = $request->all();
                $produk = Produk::find($request->produk_id);
                $input2['user_id'] = $user->id;
                $input2['cart_id'] = $itemcart->id;
                $input2['nama_produk'] = $produk->nama_produk;
                $input2['nama_pembeli'] = $user->name;
                $input2['nama_seller'] = User::find($request->seller_id)->name;
                $total = (int) $request->harga * $request->qty;
                $input2['total'] = $total;
                $cartDetail = CartDetail::create($input2);
            }
            return redirect('cart');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cart = CartDetail::where('cart_id', $id)->first();
        $param = $request->param;

        if ($param == 'tambah') {
            $stok = (int) $cart->cart->produk->qty;
            if($cart->qty >= $stok){
                $tambah = $stok;
            }else{
                $tambah = $cart->qty + 1;
            }
            if(isset($cart->cart->produk->promoted_produk->harga_akhir)){
                $total = $tambah * $cart->cart->produk->promoted_produk->harga_akhir;
            }else{
                $total = $tambah * $cart->cart->produk->harga;
            }
            $cart->update(['qty' => $tambah, 'total' => $total]);
            return back();
        }
        if ($param == 'kurang') {
            if($cart->qty > 1){
                $kurang = $cart->qty - 1;
            }else{
                $kurang = 1;
            }
            if(isset($cart->cart->produk->promoted_produk->harga_akhir)){
                $total = $kurang * $cart->cart->produk->promoted_produk->harga_akhir;
            }else{
                $total = $kurang * $cart->cart->produk->harga;
            }
            $cart->update(['qty' => $kurang, 'total' => $total]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cartDetail = CartDetail::where('cart_id', $cart->id);
        $cartDetail->delete();
        $cart->delete();
        return back();
    }

    public function kosongkan(Request $request) {
        $user = $request->user();
        $itemcart = Cart::where('user_id', $user->id)->where('status','cart');
        $cart = Cart::where('user_id', $user->id)->where('status','cart')->get();
        foreach($cart as $cart){
            $cartDetail = CartDetail::where('cart_id', $cart->id);
            $cartDetail->delete();
        }
        $itemcart->delete();
        return back()->with('success', 'Cart berhasil dikosongkan');
    }

    public function checkout(Request $request) {
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status_cart', 'cart')
                        ->first();
        $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)
                                                ->where('status', 'utama')
                                                ->first();
        if ($itemcart) {
            $data = array('title' => 'Checkout',
                        'itemcart' => $itemcart,
                        'itemalamatpengiriman' => $itemalamatpengiriman);
            return view('cart.checkout', $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }
}