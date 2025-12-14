<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestScheduleCommand extends Command
{
    /** @var string */
    protected $signature = 'app:test-schedule-command';

    /** @var string */
    protected $description = 'Test command';

    public function handle(): void
    {
        $this->comment('Hello!');
    }
}
