<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Helpers\TestHelper;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /** @var string */
    protected $signature = 'app:test-command {var1} {var2}';

    /** @var string */
    protected $description = 'Tests a console output';

    public function handle(): void
    {
        /** @var string $v1 */
        $v1 = $this->argument('var1');
        /** @var string $v2 */
        $v2 = $this->argument('var2');

        $r = TestHelper::test($v1, $v2);

        $this->comment('Result: ' . $r);
    }
}
