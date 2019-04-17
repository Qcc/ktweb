<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // // 批量发布文章
        $schedule->command('batch:topics')->everyTenMinutes()->between('8:00', '23:00');
        $schedule->command('batch:zhik')->everyFifteenMinutes()->between('7:00', '20:00');
        $schedule->command('batch:hy')->everyFifteenMinutes()->between('7:00', '20:00');
        // 每天午夜生成sitemap
        $schedule->command('generate:sitemap')->twiceDaily(1, 13);
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
