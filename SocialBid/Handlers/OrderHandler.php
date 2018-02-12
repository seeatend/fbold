<?php
namespace SocialBid\Handlers;

use Followback\Order;
use Followback\ServiceBid;
use SocialBid\Mailers\OrderMailer;
use SocialBid\Mailers\BidMailer;

class OrderHandler {
    public function __construct(
        Order $order,
        OrderMailer $orderMailer,
        BidMailer $bidMailer
    ) {
        $this->order = $order;
        $this->orderMailer = $orderMailer;
        $this->bidMailer = $bidMailer;
    }

    public function subscribe($events)
    {
        $events->listen(
            'order.finished',
            'SocialBid\Handlers\OrderHandler@onFinished'
        );
        $events->listen(
            'order.voided',
            'SocialBid\Handlers\OrderHandler@onVoided'
        );
    }

    public function onFinished($order)
    {
        $bid = $order->bid()->first();
        $bid->status = ServiceBid::STATUS_ACCEPTED;
        $bid->save();
    }

    public function onVoided($order)
    {
        $order->status = 'voided';
        $order->save();
    }
}