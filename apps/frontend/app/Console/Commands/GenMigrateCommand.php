<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenMigrateCommand extends Command
{
    protected $signature = 'app:gen-migrate-command';
    protected $description = 'Generates a migration command for go-migrate';

    public function handle(): void
    {
        /** @var array<string, string> $db */
        $db = config('database.connections.pgsql');

        /** @var array<string, string> $options */
        $options = config('database.connections.pgsql.options');

        /** @var array<int, string> $hosts */
        $hosts = config('database.connections.pgsql.write.host');

        $dsn = sprintf(
            'cockroachdb://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=%s',
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

        $command = sprintf('migrate -database "%s" -path database/migrations up', $dsn);

        $this->info($command);
    }
}
