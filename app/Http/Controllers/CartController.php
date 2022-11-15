<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
                        ->get();
        $cartTrue = Cart::where('user_id', $itemuser->id)
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
            'seller_id' => 'required',
            'qty' => 'required'
        ]);
        $user = $request->user();
        $cart = Cart::where('user_id', $user->id)->where('produk_id', $request->produk_id)->first();
        if($cart){
            $total = $cart->qty + $request->qty;
            $cart->update(['qty' => $total]);
            return redirect('cart');
        }else{
            $input = $request->all();
            $input['user_id'] = $user->id;
            $itemcart = Cart::create($input);
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
        $cart = Cart::findOrFail($id);
        $param = $request->param;

        if ($param == 'tambah') {
            $stok = (int) $cart->produk->qty;
            if($cart->qty >= $stok){
                $tambah = $stok;
            }else{
                $tambah = $cart->qty + 1;
            }
            $cart->update(['qty' => $tambah]);
            return back();
        }
        if ($param == 'kurang') {
            if($cart->qty > 1){
                $kurang = $cart->qty - 1;
            }else{
                $kurang = 1;
            }
            $cart->update(['qty' => $kurang]);
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
        $cart->delete();
        return back();
    }

    public function kosongkan(Request $request) {
        $user = $request->user();
        $itemcart = Cart::where('user_id', $user->id);
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