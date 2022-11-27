<?php

namespace App\Http\Controllers;

use App\Models\ukuran;
use Illuminate\Http\Request;

class UkuranController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'seller_id' => 'required',
            'produk_id' => 'required',
            'ukuran' => 'required'
        ]);

        $input = $request->all();
        ukuran::create($input);
        return back()->with('success', 'Ukuran Ditambahan');
    }

    public function destroy($id)
    {
        $ukuran = ukuran::find($id);
        $ukuran->delete();
        return back()->with('success', 'Pilihan Ukuran Dihapus');
    }
}
