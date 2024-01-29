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
     *
     * @var array<int, string>
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(TestScheduleCommand::class)->everyMinute();

        $schedule->command('horizon:snapshot')->everyFiveMinutes();
    }

    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return DateTimeZone|string|null
     */
    protected function scheduleTimezone(): DateTimeZone|string|null
    {
        /** @var string $tz */
        $tz = config('app.timezone');
        return $tz;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
