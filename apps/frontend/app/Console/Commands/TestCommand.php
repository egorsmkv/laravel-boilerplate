<?php

namespace App\Console\Commands;

use App\Helpers\TestHelper;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'app:test-command {var1} {var2}';
    protected $description = 'Tests a console output';

    public function handle(): void
    {
        $v1 = $this->argument('var1');
        $v2 = $this->argument('var2');

        $r = TestHelper::test($v1, $v2);

        $this->comment('Result: ' . $r);
    }
}
