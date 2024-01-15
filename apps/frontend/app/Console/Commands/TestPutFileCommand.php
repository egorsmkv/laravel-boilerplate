<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestPutFileCommand extends Command
{
    protected $signature = 'app:test-put-file-command';
    protected $description = 'Test command to put a file to the S3 storage';

    public function handle(): void
    {
        $content = 'Some content';

        $exists = Storage::disk('s3')->exists('first.txt');
        if ($exists) {
            $this->comment('The file exists.');

            return;
        }

        $result = Storage::disk('s3')->put('first.txt', $content);

        dump($result);

        $this->comment('Result of upload is dumped.');

        $fileURL = Storage::disk('s3')->url('first.txt');

        $this->comment('The file URL:');
        $this->comment($fileURL);
    }
}
