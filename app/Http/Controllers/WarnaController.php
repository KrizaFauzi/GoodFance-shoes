<?php

namespace App\Http\Controllers;

use App\Models\warna;
use Illuminate\Http\Request;

class WarnaController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required',
            'produk_id' => 'required',
            'warna' => 'required'
        ]);

        $input = $request->all();
        Warna::create($input);
        return back()->with('success', 'Pilihan Warna Ditambahan');
    }

    public function destroy($id)
    {
        $warna = Warna::find($id);
        $warna->delete();
        return back()->with('success', 'Pilihan Warna Dihapus');
    }
}
