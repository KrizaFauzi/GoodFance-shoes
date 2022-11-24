<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Image;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Wishlist;
use App\Models\CartDetail;
use App\Models\Checkout;
use App\Models\ProdukImage;
use App\Models\ProdukPromo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\ImageController;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemuser = $request->user();
        $itemproduk = Produk::orderBy('created_at', 'desc')->where('user_id', $itemuser->id )->paginate(20);
        $data = array('title' => 'Produk',
                    'itemproduk' => $itemproduk);
        return view('produk.index', $data)->with('no', ($request->input('page', 1) - 1));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Produk Baru',
                    'itemkategori' => $itemkategori);
        return view('produk.create', $data);
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
            'kode_produk' => 'required|unique:produk',
            'nama_produk' => 'required',
            'slug_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $itemuser = $request->user();//ambil data user yang login
        $slug = \Str::slug($request->slug_produk);//buat slug dari input slug produk
        $inputan = $request->all();
        $inputan['slug_produk'] = $slug;
        $inputan['user_id'] = $itemuser->id;
        $inputan['status'] = 'publish';
        $itemproduk = Produk::create($inputan);
        return redirect()->route('produk.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $produkImage = ProdukImage::where('produk_id', $id)->get();
        $data = array('title' => 'Foto Produk',
                'itemproduk' => $itemproduk, 
                'produkImage' => $produkImage);
        return view('produk.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $data = array('title' => 'Form Edit Produk',
                'itemproduk' => $itemproduk,
                'itemkategori' => $itemkategori);
        return view('produk.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'deskripsi_produk' => 'required',
            'kategori_id' => 'required',
            'qty' => 'required|numeric',
            'satuan' => 'required',
            'harga' => 'required|numeric'
        ]);
        $itemproduk = Produk::findOrFail($id);
        $inputan = $request->all();
        $itemproduk->update($inputan);
        return redirect()->route('produk.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itemproduk = Produk::findOrFail($id);
        $produkImage = ProdukImage::where('produk_id', $id)->get();
        if (!$itemproduk) {
            return back()->with('error', 'Data gagal dihapus');
        }
        if($itemproduk->promoted_produk){
            return back()->with('error', 'Error');
        }
        if($itemproduk->checkout){
            if($itemproduk->checkout->where('status', '!=','Selesai')->first()){
                return back()->with('error', 'Error');
            }
            if($itemproduk->checkout->where('status','diterima')->first()){
                foreach($itemproduk->checkout->where('status','Selesai') as $checkout) {
                    $checkout = Checkout::find($checkout->id);
                    $cartD = Cart::where('produk_id', $checkout->produk_id)->first();
                    $cartDetail = CartDetail::where('cart_id', $cartD->id)->first();
                    $rating = Rating::where('produk_id', $checkout->produk_id)->first();
                    $rating->delete();
                    $checkout->delete();
                    $cartDetail->delete();
                    $cartD->delete();
                }
            }
        }
        if($itemproduk->cart->where('status', 'cart')->first()){
            foreach($itemproduk->cart->where('status', 'cart') as $cart) {
                $cartD = Cart::find($cart->id);
                $cartDetail = CartDetail::where('cart_id', $cart->id)->first();
                $cartDetail->delete();
                $cartD->delete();
            }
        }
        if($itemproduk->wishlist){
            foreach($itemproduk->wishlist as $wishlist) {
                $wish = Wishlist::where('produk_id', $wishlist->id)->first();
                $wish->delete();
            }
        }
        if($produkImage){
            foreach($produkImage as $imageProduk) {
                Storage::delete($imageProduk->foto);
                $itemgambar = Image::where('url','=', $imageProduk->foto)->first();
                $itemgambar->delete();
                $imageProduk->delete();
            }
        }
        $itemproduk->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
    
    public function uploadimage(Request $request) {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'produk_id' => 'required',
        ]);   
        $itemuser = $request->user();
        $itemproduk = Produk::where('user_id', $itemuser->id)
                                ->where('id', $request->produk_id)
                                ->first();
        if ($itemproduk) {
            $fileupload = $request->file('image');
            $itemgambar = (new ImageController)->upload($fileupload, $itemuser);
            // simpan ke table produk_images
            $inputan = $request->all();
            $inputan['foto'] = $itemgambar->url;//ambil url file yang barusan diupload
            // simpan ke produk image
            \App\Models\ProdukImage::create($inputan);
            // update banner produk
            $itemproduk->update(['foto' => $itemgambar->url]);
            // end update banner produk
            return back()->with('success', 'Image berhasil diupload');
        } else {
            return back()->with('error', 'Image gagal upload');
        }
    }

    public function deleteimage(Request $request, $id) {
        $itemuser = $request->user();
        $itemproduk = Produk::where('user_id', $itemuser->id)
                                ->where('id', $id)
                                ->first();
        $produkImage = ProdukImage::where('produk_id', $id)->first();
        if ($itemproduk) {
            // kita cari dulu database berdasarkan url gambar
            $itemgambar = \App\Models\Image::where('url', $itemproduk->foto)->first();
            // hapus imagenya
            if ($itemgambar) {
                \Storage::delete($itemgambar->url);
                $itemgambar->delete();
                $produkImage->delete();
            }
            // baru update foto kategori
            $itemproduk->update(['foto' => null]);
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }

    public function loadasync($idproduk, $idpromo) {
        $itemproduk = Produk::findOrFail($idproduk);
        $itempromo = ProdukPromo::findOrFail($idpromo);
        $respon = [
            'status' => 'success',
            'msg' => 'Data ditemukan',
            'itemproduk' => $itemproduk,
            'itempromo' => $itempromo
        ];
        return response()->json($respon, 200);
    }
}
