<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule the 'app:push-categories-to-project2' command to run hourly
        $schedule->command('app:push-categories-to-project2')
            ->hourly()
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        // Load custom command classes from the 'Commands' directory
        $this->load(__DIR__ . '/Commands');

        // Include console routes file if it exists
        require base_path('routes/console.php');
    }
}
