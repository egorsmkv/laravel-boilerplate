<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class TestPutFileCommand extends Command
{
    /** @var string */
    protected $signature = 'app:test-put-file-command';

    /** @var string */
    protected $description = 'Test command to put a file to the S3 storage';

    public function handle(): void
    {
        $content = 'Some content';

        /** @var \Illuminate\Filesystem\AwsS3V3Adapter $s3 */
        $s3 = Storage::disk('s3');

        $exists = $s3->exists('first.txt');
        if ($exists) {
            $this->comment('The file exists.');

            return;
        }

        $result = $s3->put('first.txt', $content);

        dump($result);

        $this->comment('Result of upload is dumped.');

        $fileURL = $s3->url('first.txt');

        $this->comment('The file URL:');
        $this->comment($fileURL);
    }
}
