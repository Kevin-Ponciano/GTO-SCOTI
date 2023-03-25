<?php

namespace App\Console;

use App\Console\Commands\scheduleTask;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        scheduleTask::class,
    ];


    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('tasks:create-tasks-schedule')
            ->everyMinute();
        //$schedule->command('inspire')->hourly();
        //$schedule->call(function () {
        //Tasks::status_controller();
        //})->daily();
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected
    function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
