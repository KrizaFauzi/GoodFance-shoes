<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Cart;
use App\Models\Event;
use App\Models\Rating;
use App\Models\Produk; 
use App\Models\Checkout;
use App\Models\Kategori;
use App\Models\Wishlist;
use App\Models\Slideshow;
use App\Models\CartDetail;
use App\Models\DaftarEvent;
use App\Models\ProdukImage;
use App\Models\ProdukPromo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\promoted_produk;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(Request $request) {
        $mytime = Carbon::now()->format('y-m-d');
        $itemproduk = Produk::orderBy('created_at', 'desc')->limit(5)->get();
        $itempromo = promoted_produk::orderBy('created_at', 'desc')->limit(5)->get();
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->limit(4)->get();
        $itemslide = Slideshow::get();
        $data = array('title' => 'Homepage',
            'itemproduk' => $itemproduk,
            'itempromo' => $itempromo,
            'itemkategori' => $itemkategori,
            'itemslide' => $itemslide
        );
        return view('homepage.index', $data);
    }

    public function about() {
        $about = About::first();
        $data = array('title' => 'Tentang Kami', 'about' => $about);
        return view('homepage.about', $data);
    }

    public function kontak() {
        $data = array('title' => 'Kontak Kami');
        return view('homepage.kontak', $data);
    }

    public function kategori() 
    {
        $itemproduk = Produk::orderBy('created_at', 'desc')->get();
        $itempromo = ProdukPromo::orderBy('created_at', 'desc')->get();
        $itemkategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        $itemslide = Slideshow::get();
        $data = array('title' => 'Homepage',
            'itemproduk' => $itemproduk,
            'itempromo' => $itempromo,
            'itemkategori' => $itemkategori,
        );
        return view('homepage.kategori', $data);
    }

    public function kategoribyslug(Request $request, $slug) 
    {
        $itemproduk = Produk::orderBy('nama_produk', 'desc')
                            ->where('status', 'publish')
                            ->whereHas('kategori', function($q) use ($slug) {
                                $q->where('slug_kategori', $slug);
                            })
                            ->paginate(18);
        $listkategori = Kategori::orderBy('nama_kategori', 'asc')
                                ->where('status', 'publish')
                                ->get();
        $itemkategori = Kategori::where('slug_kategori', $slug)
                                ->where('status', 'publish')
                                ->first();
        if (!$itemkategori) {
            return abort('404');
        }
        $data = array('title' => $itemkategori->nama_kategori,
                        'itemproduk' => $itemproduk,
                        'listkategori' => $listkategori,
                        'itemkategori' => $itemkategori);
        return view('homepage.produk', $data)->with('no', ($request->input('page') - 1) * 18);            
    }

    public function produk(Request $request) 
    {
        $itemproduk = Produk::orderBy('nama_produk', 'desc')
                            ->where('status', 'publish')
                            ->paginate(18);
        $listkategori = Kategori::orderBy('nama_kategori', 'asc')
                                ->where('status', 'publish')
                                ->get();
        $data = array('title' => 'Produk',
                    'itemproduk' => $itemproduk,
                    'listkategori' => $listkategori);
        return view('homepage.produk', $data);
    }

    public function produkdetail($id) 
    {
        $itemuser = Auth::user();
        $itemproduk = Produk::where('slug_produk', $id)
                            ->where('status', 'publish')
                            ->first();
        $gambar = ProdukImage::where('produk_id', $itemproduk->id)->get();
        $rating = Rating::where('produk_id', $itemproduk->id)->get();
        $ratingCount = $rating->avg('rating');
        $penilaian = $rating->count();
        $terjual = Checkout::where('produk_id', $itemproduk->id)->where('status', 'diterima')->count();
        if ($itemproduk) {
            $data = array('title' => $itemproduk->nama_produk,
                        'itemproduk' => $itemproduk, 
                        'gambar' => $gambar,
                        'rating' => $rating,
                        'ratingCount' => $ratingCount,
                        'terjual' => $terjual,
                        'penilaian' => $penilaian);
            return view('homepage.produkdetail', $data)->with('no', 0) ;
        } else {
            // kalo produk ga ada, jadinya tampil halaman tidak ditemukan (error 404)
            return abort('404');
        }
    }

    public function searching(Request $request)
    {
        $search = $request['search'];
        $urutan = $request['urutan'];
        $min = (int) $request['min'];
        $max = (int) $request['max'];
        if ($search == "") {
            $produk = Produk::all();
            
        }
        if( $search != ''){
            $produk = Produk::where('nama_produk','LIKE', '%'.$search.'%')
                            ->orWhereRelation('kategori','nama_kategori','LIKE', '%'.$search.'%')
                            ->get();
        }
        if($urutan != null){
            if($urutan == "Terendah - Tertinggi"){
                $produk = Produk::where('nama_produk','LIKE', '%'.$search.'%')
                            ->orWhereRelation('kategori','nama_kategori','LIKE', '%'.$search.'%')
                            ->orderBy('harga', 'ASC')
                            ->get();
            }
            if($urutan == "Tertinggi - Terendah"){
                $produk = Produk::where('nama_produk','LIKE', '%'.$search.'%')
                                        ->orWhereRelation('kategori','nama_kategori','LIKE', '%'.$search.'%')
                                        ->orderBy('harga', 'DESC')
                                        ->get();
            }
        }
        if($min != null){
            $produk = Produkwhere('nama_produk','LIKE', '%'.$search.'%')
                            ->Where('harga','>=', (int) $min)
                            ->get();
        }
        if($max != null){
            $produk = Produkwhere('nama_produk','LIKE', '%'.$search.'%')
                            ->Where('harga','<=', (int) $max)
                            ->get();              
        }
        $data = array('produk' => $produk, 'search'=> $search);
        return view('homepage.search', $data);
    }

    public function allProduk()
    {
        $itemproduk = Produk::orderBy('created_at', 'desc')->get();
        $itempromo = ProdukPromo::orderBy('created_at', 'desc')->get();
        $data = array( 'itemproduk' => $itemproduk, 'itempromo' => $itempromo,);
        return view('homepage.semua_produk', $data);
    }

    public function slide(Request $request, $id){
        if($id == null){
            return back();
        }
        $event = DaftarEvent::where('event_id', $id)->first();
        $slideshow = Slideshow::where('event_id', $id)->first();
        $event = Event::find($id);
        if(!$event){
            return back();
        }
        if(!$slideshow->event->promo){
            return back();
        }
        $promo = $slideshow->event->promo;
        $data = array('promo' => $promo, 'event' => $event);
        return view('homepage.slideshow', $data);
    }
    
    public function transaksi(Request $request){
        $user = $request->user();
        $all = Checkout::where('user_id', $user->id)->get();
        $menunggu = Checkout::where('user_id', $user->id)->where('status', 'menunggu konfirmasi')->get();
        $diproses = Checkout::where('user_id', $user->id)->where('status', 'Diproses')->get();
        $dikirim = Checkout::where('user_id', $user->id)->where('status', 'dikirim')->get();
        $tiba = Checkout::where('user_id', $user->id)->where('status', 'tiba')->get();
        $dibatalkan = Checkout::where('user_id', $user->id)->where('status', 'dibatalkan')->get();
        $ditolak = Checkout::where('user_id', $user->id)->where('status', 'ditolak')->get();
        $data = array('all' => $all, 
                    'menunggu' => $menunggu,
                    'diproses' => $diproses,
                    'dikirim' => $dikirim,
                    'tiba' => $tiba, 
                    'dibatalkan' => $dibatalkan,
                    'ditolak' => $ditolak);
        return view('homepage.transaksi', $data);
    }

    public function batal(Request $request, $id){
        $checkout = Checkout::findOrFail($id);
        $stok = $checkout->cart->Produk;
        $stok->update(['qty' => $stok->qty +  $checkout->qty]);
        $checkout->cart->update(['status' => 'dibatalkan']);
        $checkout->update(['status' => 'dibatalkan']);
        return back()->with('success', 'Barang dibatalkan');
    }

    public function diterima(Request $request, $id){
        $checkout = Checkout::findOrFail($id);
        $stok = $checkout->cart->Produk;
        $stok->update(['qty' => $stok->qty +  $checkout->qty]);
        $checkout->cart->update(['status' => 'diterima']);
        $checkout->update(['status' => 'diterima']);
        return back()->with('success', 'Barang Telah Diterima');
    }

    public function history(Request $request){
        $user = $request->user();
        $checkout = Checkout::where('user_id', $user->id)->where('status', 'diterima')->get();
        $data = array('checkout' => $checkout);
        return view('homepage.history', $data);
    }
}
