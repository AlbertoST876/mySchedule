<?php

namespace App\Console;

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
        $schedule -> call(function() {
            $events = DB::select("SELECT events.id, users.email, events.name, events.description, events.date FROM events LEFT JOIN users ON events.user_id = users.id WHERE events.remember <= NOW() AND events.isRemembered = false");

            foreach ($events as $event) {
                mail($event -> email, $event -> name, $event -> description);

                DB::update("UPDATE events SET isRemembered = true WHERE id = ?", [$event -> id]);
            }
        }) -> everyTwoMinute();
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
