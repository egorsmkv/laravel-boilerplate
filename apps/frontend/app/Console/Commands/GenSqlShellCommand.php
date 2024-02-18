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
        $dbConn = config('database.default');
        $db = config("database.connections.{$dbConn}");

        // Show the command for development
        if (app()->isLocal()) {
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
        } else {
            $dsn = sprintf(
                '%s://%s:%s@%s:%s/%s?sslcert=%s&sslkey=%s&sslrootcert=%s&sslmode=require',
                'postgresql',
                $db['username'],
                $db['password'],
                $db['write']['host'][0],
                $db['port'],
                $db['database'],
                Str::replace('/app/', '/', $db['options']['sslcert']),
                Str::replace('/app/', '/', $db['options']['sslkey']),
                Str::replace('/app/', '/', $db['options']['sslrootcert']),
            );
    
            $command = sprintf('docker exec -it cockroachdb_prod cockroach sql --url "%s"', $dsn);
        }

        $this->info($command);
    }
}
