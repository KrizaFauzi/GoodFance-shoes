<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\DaftarEvent;
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

    public function store(Request $request, $event_id)
    {
        $cekEvent = DaftarEvent::where('user_id', '=', $request->user()->id )->first();
        if ($cekEvent) {
            return back()->with('error', 'Anda sudah daftar di event ini');
        } else {
            $itemuser = $request->user();
            $inputan = $request->all();
            $inputan['user_id'] = $itemuser->id;
            $inputan['user_name'] = $itemuser->name;
            $inputan['event_id'] = $event_id;
            $event = DaftarEvent::create($inputan);
            return redirect()->route('/')->with('success', 'Berhasil Daftar Event');
        }
    }
}
