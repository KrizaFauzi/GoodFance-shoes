<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\DaftarEvent;
use App\Models\ProdukPromo;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DaftarEventController extends Controller
{
    public function index($event_id)
    {
        $event = Event::findOrFail($event_id);
        $data = array('title' => 'Daftar Event', 
                    'event' => $event);
        return view('daftar_event.daftar', $data);
    }

    public function detail(Request $request, $event_id)
    {
        $user = $request->user();
        $event = Event::findOrFail($event_id);
        $promo = ProdukPromo::where('event_id', $event_id)->get();
        $produk = Produk::where('user_id', $user->id)->get();
        $data = array('title' => 'Daftar Event',
                    'event' => $event, 
                    'promos' => $promo, 
                    'produks' => $produk);
        return view('daftar_event.detail', $data);
    }

    public function store(Request $request, $event_id)
    {
        $cekEvent = DaftarEvent::where('user_id', '=', $request->user()->id )->where('event_id', $event_id)->first();
        if ($cekEvent) {
            return back()->with('error', 'Anda sudah daftar di event ini');
        } else {
            $itemuser = $request->user();
            $inputan = $request->all();
            $inputan['user_id'] = $itemuser->id;
            $inputan['user_name'] = $itemuser->name;
            $inputan['event_id'] = $event_id;
            $event = DaftarEvent::create($inputan);
            return redirect()->back()->with('success', 'Berhasil Daftar Event');
        }
    }

    public function all(Request $request){
        $user = $request->user();
        $event = DaftarEvent::where('user_id', $user->id )->get();
        $data = array('title' => 'Event yang diikuti' ,'event'=> $event);
        return view('daftar_event.all', $data);
    }

}
