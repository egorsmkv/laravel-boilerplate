<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenSqlShellCommand extends Command
{
    protected $signature = 'app:gen-sql-shell-command';
    protected $description = 'Generates a command to enter CockroachDB SQL shell';

    public function handle(): void
    {
        /** @var array<string, string> $db */
        $db = config('database.connections.pgsql');

        /** @var array<string, string> $options */
        $options = config('database.connections.pgsql.options');

        /** @var array<int, string> $hosts */
        $hosts = config('database.connections.pgsql.write.host');

        if (app()->isLocal()) {
            $dsn = sprintf(
                'postgresql://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=%s',
                $db['username'],
                $db['password'],
                $hosts[0],
                $db['port'],
                $db['database'],
                $options['sslcert'],
                $options['sslkey'],
                $options['sslrootcert'],
                $db['sslmode'],
            );

            $container = 'cockroachdb_dev';
        } else {
            $dsn = sprintf(
                'postgresql://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=%s',
                $db['username'],
                $db['password'],
                $hosts[0],
                $db['port'],
                $db['database'],
                Str::replace('/app/', '/', $options['sslcert']),
                Str::replace('/app/', '/', $options['sslkey']),
                Str::replace('/app/', '/', $options['sslrootcert']),
                $db['sslmode'],
            );

            $container = 'cockroachdb_prod';
        }

        $command = sprintf('docker exec -it %s cockroach sql --url "%s"', $container, $dsn);

        $this->info($command);
    }
}
