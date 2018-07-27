<?php

namespace App\Console;

use App\Console\Commands\MailToWebinar;
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
        Commands\Sitemap::class,
        Commands\MailToWebinar::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('webinar:mail')
            ->everyMinute();

        $schedule->command('mailchimp:update')
            ->everyMinute()
            ->between('00:00', '03:00');

        $schedule->command('currency:usd')
            ->dailyAt('10:00');
        $schedule->command('currency:usd')
            ->dailyAt('14:00');
        $schedule->command('currency:usd')
            ->dailyAt('17:00');
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
