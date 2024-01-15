<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestScheduleCommand extends Command
{
    protected $signature = 'app:test-schedule-command';
    protected $description = 'Test command';

    public function handle(): void
    {
        $this->comment('Hello!');
    }
}
