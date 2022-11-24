<?php

namespace App\Http\Controllers;

use App\Models\about;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function create()
    {
        $about = About::first();
        $data = array('title' => 'About', 'about' => $about);
        return view('admin.about.create', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'about' => 'required'
        ]);

        $input = $request->all();
        About::create($input);
        return redirect()->back();
    }

    public function destroy( $id)
    {
        $about = About::findOrFail($id);
        $about->delete();
        return redirect()->back();
    }
}
