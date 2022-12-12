<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\DietExpire;
class Kernel extends ConsoleKernel
{

    // protected $commands = [
    //     DietExpire::class,
    // ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('user_diet:active')->everyMinute();
        $schedule->command('meal:reminder')->everyMinute();
        $schedule->command('exercise:reminder')->dailyAt('6:00');;
    }


    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
