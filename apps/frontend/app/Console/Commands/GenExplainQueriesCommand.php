<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Laravel\Telescope\Contracts\EntriesRepository;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\Storage\EntryQueryOptions;

class GenExplainQueriesCommand extends Command
{
    protected $signature = 'app:gen-explain-queries {time_min_ms} {format}';
    protected $description = 'Generate EXPLAIN ANALYZE queries from Telescope entries.';

    /**
     * @var string[] We ignore SQL queries that contain any of these substrings.
     */
    protected $ignoredSubStrings = [
        'telescope_entries',
        'information_schema.tables',
    ];

    public function handle(EntriesRepository $storage): void
    {
        $timeMin = $this->argument('time_min_ms');
        $format = $this->argument('format');

        $entries = $storage->get(
            EntryType::QUERY,
            (new EntryQueryOptions)->limit(50),
        )->reverse();

        if ($format === 'json') {
            $prependSQL = 'EXPLAIN (ANALYZE, COSTS, VERBOSE, BUFFERS, FORMAT JSON)';
        } else {
            $prependSQL = 'EXPLAIN (ANALYZE, COSTS, VERBOSE, BUFFERS)';
        }

        foreach ($entries as $entry) {
            if ($entry->content['time'] < $timeMin) {
                continue;
            }

            if (Str::contains($entry->content['sql'], $this->ignoredSubStrings)) {
                continue;
            }

            $this->info("\t" . '-- ' . $entry->content['file'] . ':' . $entry->content['line']);
            $this->info("\t" . $prependSQL . ' ' . $entry->content['sql']);
            $this->comment("\n\n***");
            $this->comment('');
        }
    }
}
