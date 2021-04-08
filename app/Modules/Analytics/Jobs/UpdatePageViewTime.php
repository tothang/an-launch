<?php

namespace App\Modules\Analytics\Jobs;

use App\Modules\Analytics\Models\PageView;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdatePageViewTime implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $pageView;

    public $timeSpent;

    public function __construct(int $pageView, int $timeSpent)
    {
        $this->pageView = $pageView;
        $this->timeSpent = $timeSpent;
    }

    public function handle(): void
    {
        PageView::find($this->pageView)->update([
            'time_spent' => $this->timeSpent,
        ]);
    }
}
