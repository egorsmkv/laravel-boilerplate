<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'app:test-command {var1} {var2}';
    protected $description = 'Tests a console output';

    public function handle()
    {
        $v1 = $this->argument('var1');
        $v2 = $this->argument('var2');

        $this->comment('Var1: ' . $v1);
        $this->comment('Var2: ' . $v2);
    }
}
