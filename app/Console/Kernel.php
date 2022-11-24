<?php

namespace App\Console;

use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $mytime = Carbon::now()->format('y-m-d');
            $c = DB::table('cart_detail')->join('cart', 'cart_detail.cart_id', '=' , 'cart.id')->join('produk', 'cart.produk_id', '=', 'produk.id')->join('promoted_produk', 'promoted_produk.produk_id', '=', 'produk.id')->join('promo', 'promoted_produk.promo_id', '=', 'promo.id')->join('event', 'promo.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->select('cart.id as cart_id', 'promoted_produk.harga_awal as harga_awal')->get();
            foreach($c as $c){
                $cd = CartDetail::where('cart_id', $c->cart_id)->first();
                $cd->update(['harga' => $c->harga_awal, 'total' => $cd->qty * $c->harga_awal]);
            }
            $promoted_produk = DB::table('promoted_produk')->leftJoin('promo', "promoted_produk.promo_id", "=", "promo.id")->leftJoin('event', 'promo.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime);
            $promoted_produk->delete();
            DB::table('promo')->join('event', 'promo.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->delete();
            DB::table('daftar_event')->join('event', 'daftar_event.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->delete();
            DB::table('event')->where('tanggal_akhir',"<=", $mytime)->delete();
        })->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
