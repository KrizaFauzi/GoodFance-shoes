<?php

namespace App\Http\Controllers;

use App\Models\toko;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class TokoController extends Controller
{
    public function create(Request $request)
    {
        $user = $request->user();
        $toko = Toko::where('seller_id', $user->id)->first();
        $data = array('title' => 'Profile Toko', 'toko' => $toko);
        return view('dashboard.toko.create', $data);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $this->validate($request, [
            'seller_id' => 'required|unique:toko,seller_id',
            'nama_toko' => 'required',
            'waktu_buka' => 'required',
            'waktu_tutup' => 'required',
            'photo_profile' => 'required',
            'background' => 'required'
        ]);

        $isToko = Toko::where('seller_id', $user->id)->first();

        if($isToko){
            return redirect()->back()->with('error', 'Hanya bisa membuat sekali profile');
        }
        $background = $request->file('background');
        $photo_profile = $request->file('photo_profile');
        $bg = (new ImageController)->upload( $background, $user);
        $pp = (new ImageController)->upload( $photo_profile, $user);
        $input = $request->all();
        $input['photo_profile'] = $pp->url;
        $input['background'] = $bg->url;
        Toko::create($input);
        return redirect()->back()->with('success', 'Profile Toko berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $toko = Toko::findOrFail($id);
        
        if($toko->photo_profile){
            Storage::delete($toko->photo_profile);
            $pp = Image::where('url', $toko->photo_profile)->first();
            Image::delete($pp);
        }
        if($toko->background){
            Storage::delete($toko->background);
            $bg = Image::where('url', $toko->photo_profile)->first();
            Image::delete($bg);
        }
        $toko->delete();
        return back()->with('success', 'Profile Toko berhasil dihapus');
    }
}
