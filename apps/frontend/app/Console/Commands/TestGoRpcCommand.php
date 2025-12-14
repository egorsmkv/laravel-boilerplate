<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use ZMQ;
use ZMQContext;
use ZMQSocket;
use ZMQSocketException;

class TestGoRpcCommand extends Command
{
    /** @var string */
    protected $signature = 'app:test-go-rpc {n_iters}';

    /** @var string */
    protected $description = 'Make a call to the Go service.';

    public function handle(): void
    {
        /** @var int $nIters */
        $nIters = $this->argument('n_iters');

        try {
            $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'MySocket-console-test1');

            /** @var string $zmqHost */
            $zmqHost = config('rpc.go_hello_addr');
            $socket = $socket->connect($zmqHost);

            for ($i = 0; $i < $nIters; $i++) {
                $this->comment("Calling RPC #$i...");

                try {
                    // Send and receive
                    $send = $socket->send('2006-01-02 15:04:05');
                    $result = $send->recv();

                    $this->comment($result);
                } catch (ZMQSocketException $e) {
                    $this->comment('ERROR:', $e->getCode());
                }

                $this->comment('');

                sleep(1);
            }
        } catch (ZMQSocketException $e) {
            Log::error($e);
        }
    }
}
