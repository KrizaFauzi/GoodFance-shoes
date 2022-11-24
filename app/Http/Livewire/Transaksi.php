<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Checkout;
use Illuminate\Http\Request;

class Transaksi extends Component
{
    public function render(Request $request)
    {
        $user = $request->user();
        $orderan = Checkout::where('user_id', $user->id)->get();
        $data = array('orderan' => $orderan);
        return view('livewire.transaksi', $data);
    }
}
