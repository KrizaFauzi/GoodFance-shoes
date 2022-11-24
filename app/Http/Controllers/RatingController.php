<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Produk;
use App\Models\ProdukImage;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) 
    {
        $itemproduk = Produk::where('slug_produk', $id)
                            ->where('status', 'publish')
                            ->first();
        $gambar = ProdukImage::where('produk_id', $itemproduk->id)->get();
        $itemuser = Auth::user();
        if ($itemproduk) {
            if ($itemuser->rating(Auth::user()->id, $itemproduk->id)) {
                $rating = Rating::where('user_id', $itemuser->id)->where('produk_id', $itemproduk->id)->first();
                $data = array('title' => $itemproduk->nama_produk,
                        'itemproduk' => $itemproduk,
                        'gambar' => $gambar,
                        'user' => $itemuser,
                        'rating' => $rating);
            } else {
                $data = array('title' => $itemproduk->nama_produk,
                            'itemproduk' => $itemproduk, 
                            'gambar' => $gambar,
                            'user' => $itemuser);
            }
            return view('rating.index', $data)->with('no', 0) ;
        } else {
            return abort('404');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idp)
    {
        $user = $request->user();
        $this->validate($request, [
            'produk_id' => 'required',
            'rating' => 'required',
            'ulasan' => 'required'
        ]);

        if($user->rating($user->id, $idp)){
            return redirect()->back()->with('error', 'Hanya bisa memberi ulasan sekali');
        }
        $input = $request->all();
        $input['user_id'] = $user->id;
        Rating::create($input);
        return redirect()->back()->with('success', 'Ulasan terkirim');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
