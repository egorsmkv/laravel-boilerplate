<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $iterations;

    public function __construct(int $iterations)
    {
        $this->iterations = $iterations;
    }

    /**
     * Executes the job for a given number of iterations.
     *
     * @return void
     */
    public function handle(): void
    {
        $iterations = $this->iterations;

        while (true) {
            if ($iterations == 0) {
                break;
            }

            // A new exception will cause a failed job, it will be saved into the database to failed_jobs table
            //if ($iterations == 4) {
            //   throw new \Exception('bug');
            //}

            echo "Executing this job...\n";

            $iterations--;
            sleep(1);
        }
    }
}
