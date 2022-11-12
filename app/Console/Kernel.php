<?php

namespace App\Console;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use id;

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
            DB::table('promoted_produk')->leftJoin('promo', "promoted_produk.promo_id", "=", "promo.id")->leftJoin('event', 'promo.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->delete();
            DB::table('promo')->join('event', 'promo.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->delete();
            DB::table('daftar_event')->join('event', 'daftar_event.event_id', '=', 'event.id')->where('event.tanggal_akhir', $mytime)->delete();
            DB::table('event')->where('tanggal_akhir', $mytime)->delete();
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
