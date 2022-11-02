<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\promoted_produk;
use App\Models\ProdukPromo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProdukPromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itempromo = ProdukPromo::orderBy('id','desc')->paginate(20);
        $data = array('title' => 'Promo',
                    'itempromo'=>$itempromo);
        return view('promo.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // kita ambil data produk
        $data = array('title' => 'Form Promo');
        return view('promo.create',$data);
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
            $itempromo = ProdukPromo::create($inputan);
            return redirect()->route('promo.index')->with('success', 'Data berhasil disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itempromo = ProdukPromo::findOrFail($id);
        $data = array('title' => 'Detail Promo',
                    'itempromo' => $itempromo);
        return view('promo.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_promo' => 'required',
            'diskon_persen' => 'required',
        ]);
        $itempromo = ProdukPromo::findOrFail($id);
        $itemuser = $request->user();
        $inputan = $request->all();
        $inputan['user_id'] = $itemuser->id;
        $itempromo->update($inputan);
        return redirect()->route('promo.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProdukPromo  $produkPromo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promoted_produk = promoted_produk::where('promo_id', $id)->get();
        $itempromo = ProdukPromo::findOrFail($id);
        if(is_countable($promoted_produk)  && count($promoted_produk)){
            return back()->with('error', 'Hapus dulu produk berpromo di dalam promo produk, proses diberhentikan');
        }else{
            if ($itempromo->delete()) {
                return back()->with('success', 'Data berhasil dihapus');
            } else {
                return back()->with('error', 'Data gagal dihapus');
            }
        }
    }
}