<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Produk;
use App\Models\ProdukImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(Request $request) {
        $itemuser = $request->user();
        $itemgambar = Image::paginate(20);
        $data = array('title' => 'Data Image',
                    'itemgambar' => $itemgambar);
        if($itemuser->level == "seller"){
            return view('image.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        }else if($itemuser->level == "admin"){
            return view('admin.image.index', $data)->with('no', ($request->input('page', 1) - 1) * 20);
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $itemuser = $request->user();
        $fileupload = $request->file('image');
        $folder = 'assets/images';
        $itemgambar = $this->upload($fileupload, $itemuser, $folder);
        return back()->with('success', 'Image berhasil diupload');
    }

    public function destroy(Request $request, $id) {
        $itemuser = $request->user();
        $itemgambar = Image::where('id', $id)
                            ->first();
        $gambarProduk = ProdukImage::where('foto', $itemgambar->url)->first();
        $produkImage = Produk::where('foto', $itemgambar->url)->first();
        if ($itemgambar) {
            \Storage::delete($itemgambar->url);
            $itemgambar->delete();
            if($gambarProduk){
                if($produkImage){
                    $produkImage->update(['foto' => null]);
                }
                $gambarProduk->delete();
            }
            return back()->with('success', 'Data berhasil dihapus');
        } else {
            return back()->with('error', 'Data tidak ditemukan');
        }
    }
    
    public function upload($fileupload, $itemuser) {
        $path = $fileupload->store('files');
        $inputangambar['url'] = $path;
        $inputangambar['user_id'] = $itemuser->id;
        return Image::create($inputangambar);
    }
}