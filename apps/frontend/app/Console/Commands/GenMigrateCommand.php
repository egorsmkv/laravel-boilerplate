<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenMigrateCommand extends Command
{
    protected $signature = 'app:gen-migrate-command';
    protected $description = 'Generates a migration command for go-migrate';

    public function handle(): void
    {
        $dbConn = config('database.default');
        $db = config("database.connections.{$dbConn}");

        $dsn = sprintf(
            '%s://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=require',
            'cockroachdb',
            $db['username'],
            $db['password'],
            $db['write']['host'][0],
            $db['port'],
            $db['database'],
            $db['options']['sslcert'],
            $db['options']['sslkey'],
            $db['options']['sslrootcert'],
        );

        $command = sprintf('migrate -database "%s" -path database/migrations up', $dsn);

        $this->info($command);
    }
}
