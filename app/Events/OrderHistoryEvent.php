<?php

namespace App\Events;

use App\Order;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderHistoryEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $userId;
    public $orderId;
    public $statusId;
    public $changeName;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order, $changeName)
    {
        $this->userId     = $user->id;
        $this->orderId    = $order->id;
        $this->statusId   = $order->status_id;
        $this->changeName = $changeName;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
