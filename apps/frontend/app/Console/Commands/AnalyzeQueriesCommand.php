<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\Storage\EntryQueryOptions;
use ZMQ;
use ZMQContext;
use ZMQSocket;

class AnalyzeQueriesCommand extends Command
{
    protected $signature = 'app:analyze-queries {limit}';
    protected $description = 'Analyze SQL queries using pg_query_go.';

    public function handle(EntriesRepository $storage): void
    {
        $limit = $this->argument('limit');

        $entries = $storage->get(
            EntryType::QUERY,
            (new EntryQueryOptions)->limit($limit),
        )->reverse();

        $socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, 'app');
        $socket = $socket->connect(config('rpc.go_analyze_query'));
        
        foreach ($entries as $entry) {
            $this->info('-- ' . $entry->content['file'] . ':' . $entry->content['line']);
            $this->info($entry->content['sql'] . "\n");
            
            // Send and receive
            $send = $socket->send($entry->content['sql']);
            $result = $send->recv();

            $data = json_encode(json_decode($result), JSON_PRETTY_PRINT);

            $this->comment($data);
            $this->comment('');
        }
    }
}
