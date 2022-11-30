<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\checkout;
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

    public function pay(Request $request, $id)
    {
        $user = $request->user(); 
        $order = Order::find($id);
        if(!$order){
            return redirect()->back();
        }
        
        $checkout = Checkout::where('order_id', $order->id)->where('user_id', $user->id)->where('status', 'menunggu pembayaran')->get();
        foreach($checkout as $co){
            $total = $co->cart->totalCheckout($order->id, $user->id);
        }
        \Midtrans\Config::$serverKey = 'SB-Mid-server-pUSo2Wg4nhf4hVR1YVO3DS2f';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id.rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ),
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $data = array('checkout' => $checkout, 'order' => $order, 'snapToken' => $snapToken);
        return view('payment.index', $data)->with('no', 1);
    }

    public function payyed(Request $request, $id){
        if($request->param != "pay"){
            return back()->with('error', 'pembayaran error');
        }
        $user = $request->user();
        $order = Order::find($id);
        $order->update(['status' => 'menunggu konfirmasi']);
        $checkout = Checkout::where('order_id', $order->id)->get();
        foreach($checkout as $checkout) {
            $checkout->update(['status' => 'menunggu konfirmasi']);
            $cart = Cart::where('produk_id',$checkout->produk_id)->where('user', $user->id);
            foreach($cart as $cart){
                $cart->update(['status' => 'menunggu konfirmasi']);
            }
        }
    return redirect()->route('homepage.transaksi');    
    }
}
