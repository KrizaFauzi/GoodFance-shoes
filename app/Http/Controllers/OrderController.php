<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\AlamatPengiriman;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function index(){
        return abort('404');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);
        $input = $request->all();
        $input['status'] = 'checkout';
        $order = Order::create($input);
        return redirect()->route('cekout.show', $order->id);
    }

    public function show(Request $request,$id)
    {
        $oId = $id;
        $itemuser = $request->user();
        $itemcart = Cart::where('user_id', $itemuser->id)
                        ->where('status', 'cart')
                        ->get();
        $cart2 = Cart::where('user_id', $itemuser->id)
                        ->where('status', 'cart')
                        ->first();
        $itemalamatpengiriman = AlamatPengiriman::where('user_id', $itemuser->id)->where('status', 'utama')->first();
        if ($itemcart) {
            $data = array('title' => 'Checkout',
                        'oId' => $oId,
                        'itemcart' => $itemcart,
                        'itemalamatpengiriman' => $itemalamatpengiriman,
                        'cart2' => $cart2 );
            return view('cart.checkout', $data)->with('no', 1);
        } else {
            return abort('404');
        }
    }

    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, Order $order)
    {
        //
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('cart.index');
    }
}
