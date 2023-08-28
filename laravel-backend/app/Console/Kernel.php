<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('jtq:scrape')->dailyAt('02:00');
        $schedule->command('jtq:discord-webhook')->dailyAt('07:00');

        // Egyelőre ezt még nem engedélyezem, gyűjtsünk inkább több, de felesleges adatot.
        //$schedule->command('jtq:remove-unused-job-listings')->weekly();
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
