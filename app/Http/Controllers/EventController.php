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
        $userCount = DaftarEvent::get();
        $data = array('title' => 'Event', 'itemevent' => $itemevent, 'userCount' => $userCount);
        return view('event.index' , $data);
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
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required'
        ]);
        $cekEvent = Event::where('slug_event', $request->slug_event)->where('status','publish');
        if ($cekEvent) {
            return back()->with('error','Data Sudah Ada');
        }else{
            $user = $request->user();
            $slug = Str::slug($request->slug_event);
            $input['slug_event'] = $slug;
            $input['user_id'] = $user->id;
            $input['status'] = 'publish';
            $event = Event::create($Input);
            return redirect()->route('event.index')->with('success','Event telah terbuat');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->where('status','publish')->get();
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
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required'
        ]);
        $event->update($request);
        return redirect()->route('event.index');
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
        $promo = ProdukPromo::where('event_id',$id);
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
