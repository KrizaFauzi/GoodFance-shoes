<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\DaftarEvent;
use App\Models\ProdukPromo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $itemevent = Event::where('user_id', $user->id)->get();
        $data = array('title' => 'Event', 'itemevent' => $itemevent);
        return view('event.index' , $data)->with('no', ($request->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array('title' => 'Event Form');
        return view('event.create', $data);
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
            'nama_event' => 'required',
            'slug_event' => 'required|unique:event',
            'deskripsi' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required'
        ]);
        $cekEvent = Event::where('slug_event', $request->slug_event)->where('status','publish')->first();
        if ($cekEvent) {
            return back()->with('error','Data Sudah Ada');
        }else{
            $user = $request->user();
            $slug = Str::slug($request->slug_event);
            $input = $request->all();
            $input['slug_event'] = $slug;
            $input['user_id'] = $user->id;
            $input['status'] = 'publish';
            $event = Event::create($input);
            return redirect()->route('event.index')->with('success','Event telah terbuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrfail($id);
        $data = array('title' => 'Event Detail',
                    'event' => $event);
        return view('event.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrfail($id);
        $data = array('title' => 'Event Edit Form',
                    'event' => $event);
        return view('event.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        $this->validate($request,[
            'nama_event' => 'required',
            'deskripsi' => 'required',
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required'
        ]);
        $input = $request->all();
        $event->update($input);
        return redirect()->route('event.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $daftarEvent = DaftarEvent::where('event_id', $id);
        $promo = ProdukPromo::where('event_id', $id);
        if($daftarEvent) {
            if ($promo) {
                $promo->delete();
            }
            $daftarEvent->delete();
        }
        $event->delete();
        return redirect()->route('event.index')->with('success', 'Event Telah Terhapus');
    }
}
