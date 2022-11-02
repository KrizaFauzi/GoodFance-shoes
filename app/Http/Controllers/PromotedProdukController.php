<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukPromo;
use Illuminate\Http\Request;
use App\Models\promoted_produk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PromotedProdukController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $itemproduk = DB::table('promoted_produk')
                ->join('produk', 'produk.id', '=', 'promoted_produk.produk_id')
                ->join('promo', 'promo.id', '=', 'promoted_produk.promo_id')
                ->select('promoted_produk.id','produk.nama_produk','promo.nama_promo','promo.diskon_persen','promoted_produk.diskon_nominal','promoted_produk.harga_awal','promoted_produk.harga_akhir' )
                ->get();
        $data = array('title' => 'Promo Produk',
                    'itemproduk' => $itemproduk);
        return view('promoted_produk.index', $data)->with('no', ($request->input('page', 1) - 1));
    }

    public function create(Request $request)
    {
        $user = $request->user();
        $itemproduk = Produk::orderBy('nama_produk', 'desc')
                    ->where('status', 'publish')
                    ->where('user_id','=', $user->id)
                    ->get();
        $itempromo = ProdukPromo::orderBy('nama_promo', 'desc')
                    ->where('user_id', '=', $user->id )
                    ->get();
        $data = array('title' => 'Form Promo Produk', 
                    'itemproduk' => $itemproduk, 
                    'itempromo' => $itempromo);
        return view('promoted_produk.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'produk_id' => 'required',
            'promo_id' => 'required',
            'harga_awal' => 'required',
            'harga_akhir' => 'required'
        ]);
        $cekpromo = promoted_produk::where('produk_id', $request->produk_id)->first();
        if($cekpromo){
            return redirect()->back()->with('Produk sudah promo');
        }else{
            $user = $request->user();
            $input = $request->all();
            $input['user_id'] = $user->id;
            $promoted_produk = promoted_produk::create($input);
            return redirect()->route('promoted_produk.index')->with('success', 'Data Berhasil Disimpan');
        }

    }
    
    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $produk = DB::table('promoted_produk')
                            ->join('produk', 'produk.id', '=', 'promoted_produk.produk_id')
                            ->join('promo', 'promo.id', '=', 'promoted_produk.promo_id')
                            ->select('*')
                            ->where('promoted_produk.id', $id)
                            ->select('promoted_produk.id','produk.id as produkId','produk.nama_produk','produk.kode_produk','promo.id as promoId','promo.nama_promo','promo.diskon_persen','promoted_produk.diskon_nominal','promoted_produk.harga_awal','promoted_produk.harga_akhir' )
                            ->first();
        $itempromo = ProdukPromo::orderBy('nama_promo', 'desc')
                            ->where('user_id', '=', $user->id )
                            ->where('id', '!=', $request->promo_id )
                            ->get();
        $data = array('title' => 'Detail Promo Produk',
                    'itempromo' => $itempromo,
                    'produk' => $produk);
        
        return view('promoted_produk.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'produk_id' => 'required',
            'promo_id' => 'required',
            'harga_awal' => 'required',
            'harga_akhir' => 'required'
        ]);
        $produk = DB::table('promoted_produk')
                            ->join('produk', 'produk.id', '=', 'promoted_produk.produk_id')
                            ->join('promo', 'promo.id', '=', 'promoted_produk.promo_id')
                            ->select('*')
                            ->where('promoted_produk.id', $id)
                            ->first();
        $promoted_produk = promoted_produk::findOrFail($id);
        $user = $request->user();
        $input = $request->all();
        $input['user_id'] = $user->id;
        $promoted_produk->update($input);
        return redirect()->route('promoted_produk.index')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $promoted_produk = promoted_produk::findOrFail($id);
        if ($promoted_produk->delete()) {
            return back()->with('success', 'Data berhasil Dihapus');
        }else{
            return back()->with('error', 'Data gagal dihapus');
        }
    }
}
