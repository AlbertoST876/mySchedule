<?php

namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Mail\RememberEmail;
use App\Models\Event;

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
            $events = Event::where("remember", "<=", DB::raw("NOW()")) -> where("isRemembered", false) -> get();

            foreach ($events as $event) {
                Mail::to($event -> user -> email) -> send(new RememberEmail($event));
                Event::where("id", $event -> id) -> update(["isRemembered" => true]);
            }
        }) -> everyMinute();
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
