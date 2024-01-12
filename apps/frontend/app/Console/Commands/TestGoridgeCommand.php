<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spiral\Goridge;

class TestGoridgeCommand extends Command
{
    protected $signature = 'app:test-goridge {n_iters}';
    protected $description = 'Make a call to the Go service.';

    public function handle(): void
    {
        $nIters = $this->argument('n_iters');

        $rpc = new Goridge\RPC\RPC(
            Goridge\Relay::create('tcp://goridge_hello_dev:6001')
        );

        for ($i = 0; $i < $nIters; $i++) {
            $this->comment("Calling RPC #{$i}...");

            // $result = $rpc->call("App.Hi", sprintf("Antony, %s", $i));

            $result = $rpc->call('App.CurrentDate', '2006-01-02 15:04:05');

            /** @phpstan-ignore-next-line */
            $this->comment($result);
            $this->comment('');

            sleep(1);
        }
    }
}
