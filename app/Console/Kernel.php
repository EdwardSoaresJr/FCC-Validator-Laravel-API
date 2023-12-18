<?php

namespace App\Console;

use DateTimeZone;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        return 'America/Denver';
    }

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        //$schedule->command('app:daily-hd-task')->dailyAt('03:00');
        //$schedule->command('app:daily-en-task')->dailyAt('03:30');

//        $schedule->call('App\Http\Controllers\WeeklyGmrsController@dn');
//        $schedule->call('App\Http\Controllers\WeeklyGmrsController@hd');
//        $schedule->call('App\Http\Controllers\WeeklyGmrsController@en');

        $schedule->call('App\Http\Controllers\DailyGmrsController@hd')->dailyAt('03:00');
        $schedule->call('App\Http\Controllers\DailyGmrsController@en')->dailyAt('03:30');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
