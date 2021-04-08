<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Redis;

class ClearQueue extends Command
{
    protected $signature = 'envx:clear:queue {queue-name}';

    protected $description = 'Clears the queue specified of jobs';

    public function handle(): void
    {
        Redis::connection()->del('queues:' . $this->argument('queue-name'));

        Queue::size($this->argument('queue-name')) === 0
            ? $this->info('Queue cleared!')
            : $this->warn('Unable to clear queue!');
    }
}
