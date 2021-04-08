<?php

namespace App\Modules\Notifications\Events;

use App\Modules\Notifications\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class SendNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    private $segment = 'all'; // force send all

    public function __construct(Notification $notification, ?string $segment = null)
    {
        $this->notification = $notification;
        // $this->segment = Str::slug($segment);
    }

    public function broadcastOn()
    {
        if ($this->segment) {
            return new PrivateChannel('notifications.' . $this->segment);
        }

        return new Channel('notification');
    }

    public function broadcastAs(): string
    {
        return 'SendNotification';
    }
}
