<?php

namespace App\Listeners;

use App\Events\OrderHistoryEvent;
use App\HistoryOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderHistoryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderHistoryEvent  $event
     * @return void
     */
    public function handle(OrderHistoryEvent $event)
    {
        HistoryOrder::create([
            'order_id'    => $event->orderId,
            'user_id'     => $event->userId,
            'status_id'   => $event->statusId,
            'change_name' => $event->changeName
        ]);
    }
}
