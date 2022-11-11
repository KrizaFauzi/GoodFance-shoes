<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Produk;
use App\Models\DaftarEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();
        $event = Event::where('status', 'publish')->get();
        $eventCount = count($event);
        $userCount = User::where('status', 'aktif')->where('level', 'member')->get()->count();
        $sellerCount = User::where('status', 'aktif')->where('level', 'seller')->get()->count();
        $data = array('title' => 'Dashboard','eventCount' => $eventCount, 'event' => $event, 'userCount' => $userCount, 'sellerCount' => $sellerCount);
        if($user->level == "seller"){
            return view('dashboard.index', $data);
        }else if($user->level == "admin"){
            return view('admin.dashboard.index', $data);
        }
    }
}
