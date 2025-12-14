<?php

namespace App\Console;

use App\Console\Commands\TestScheduleCommand;
use DateTimeZone;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(TestScheduleCommand::class)->everyMinute();

        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        /** @var string $tz */
        $tz = config('app.timezone');

        return $tz;
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
