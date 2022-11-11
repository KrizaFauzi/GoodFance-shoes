<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\DaftarEvent;
use App\Models\promoted_produk;
use App\Models\ProdukPromo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
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
        if($user->level == "seller"){
            return view('event.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        }else if($user->level == "admin"){
            return view('admin.event.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array('title' => 'Event Form');
        return view('admin.event.create', $data);
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
    public function show(Request $request, $id)
    {
        $user  = $request->user();
        $event = Event::findOrfail($id);
        $itempromo = ProdukPromo::where('user_id', $user->id)->where('event_id', $id)->get();
        $data = array('title' => 'Event Detail',
                    'event' => $event, 
                    'itempromo' => $itempromo);
        return view('admin.event.show', $data)->with('no', ($request->input('page', 1) - 1));
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
        return view('admin.event.edit', $data);
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
        return redirect()->route('admin.event.index')->with('success', 'Data berhasil diupdate');
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
        return redirect()->route('admin.event.index')->with('success', 'Event Telah Terhapus');
    }

    public function storeIt(Request $request){
        $this->validate($request, [
            'nama_promo' => 'required',
            'diskon_persen' => 'required',
        ]);
        // cek dulu apakah sudah ada, produk hanya bisa masuk 1 promo
        $cekpromo = ProdukPromo::where('nama_promo', $request->kode_promo)->where('user_id', '=', $request->user()->id )->first();
        if ($cekpromo) {
            return back()->with('error', 'Data sudah ada');
        } else {
            $itemuser = $request->user();
            $inputan = $request->all();
            $inputan['user_id'] = $itemuser->id;
            $inputan['event_id'] = $request->id;
            $itempromo = ProdukPromo::create($inputan);
            return redirect()->back()->with('success', 'Data berhasil disimpan');
        }
    }

    public function destroyIt($id){
        $promoted_produk = promoted_produk::where('promo_id', $id);
        $itempromo = ProdukPromo::findOrFail($id);
        if ($itempromo) {
            $promoted_produk->delete();
            $itempromo->delete();
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data gagal dihapus');
        }
    }
}
