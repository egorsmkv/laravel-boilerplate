<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenSqlShellCommand extends Command
{
    protected $signature = 'app:gen-sql-shell-command';
    protected $description = 'Generates a command to enter CockroachDB SQL shell';

    public function handle(): void
    {
        $dbConn = config('database.default');
        $db = config("database.connections.{$dbConn}");

        $dsn = sprintf(
            '%s://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=require',
            'postgresql',
            $db['username'],
            $db['password'],
            $db['write']['host'][0],
            $db['port'],
            $db['database'],
            $db['options']['sslcert'],
            $db['options']['sslkey'],
            $db['options']['sslrootcert'],
        );

        $command = sprintf('docker exec -it cockroachdb_dev cockroach sql --url "%s"', $dsn);

        $this->info($command);
    }
}
