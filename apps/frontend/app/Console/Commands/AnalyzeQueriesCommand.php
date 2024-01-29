<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\Storage\EntryQueryOptions;
use ZMQ;
use ZMQContext;
use ZMQSocket;
use ZMQSocketException;

class AnalyzeQueriesCommand extends Command
{
    protected $signature = 'app:analyze-queries {limit}';
    protected $description = 'Analyze SQL queries using pg_query_go.';

    public function handle(EntriesRepository $storage): void
    {
        $limit = (int) $this->argument('limit');

        $entries = $storage->get(
            EntryType::QUERY,
            (new EntryQueryOptions)->limit($limit),
        )->reverse();

        try {
            $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'app');

            /** @var string $zmqHost */
            $zmqHost = config('rpc.go_analyze_query');
            $socket = $socket->connect($zmqHost);

            foreach ($entries as $entry) {
                $this->info('-- ' . $entry->content['file'] . ':' . $entry->content['line']);
                $this->info($entry->content['sql'] . "\n");

                // Send and receive
                $send = $socket->send($entry->content['sql']);
                $result = $send->recv();

                $data = json_encode(json_decode($result), JSON_PRETTY_PRINT);
                if (!$data) {
                    $this->error('Failed to decode JSON');
                    $this->error($result);
                    continue;
                }

                $this->comment($data);
                $this->comment('');
            }
        } catch (ZMQSocketException $e) {
            Log::error($e);
        }
    }
}
