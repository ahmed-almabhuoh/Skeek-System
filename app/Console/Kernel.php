<?php

namespace App\Console;

use App\Jobs\RememberUnVerifyedAcound;
use App\Jobs\SendNotVerifyedUserEmail;
use App\Jobs\SendReminderUserEmail;
use App\Jobs\SendSheeksMailWeeklyCreated;
use App\Models\Admin;
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
        // $schedule->command('inspire')->hourly();
        // $schedule->job(new RememberUnVerifyedAcound())->everyMinute();
        $schedule->job(new SendReminderUserEmail())->everyMinute();
        $schedule->job(new SendSheeksMailWeeklyCreated())->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
