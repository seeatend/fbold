<?php
namespace SocialBid\Handlers;

use Followback\ServiceBid;
use Followback\SocialAccount;
use SocialBid\Mailers\BidMailer;
use Sentry;

class BidHandler {
    public function __construct(
        ServiceBid $serviceBid,
        SocialAccount $socialAccount,
        BidMailer $mailer
    ) {
        $this->serviceBid = $serviceBid;
        $this->socialAccount = $socialAccount;
        $this->mailer = $mailer;
    }

    public function subscribe($events)
    {
        $events->listen(
            'bid.authorized',
            'SocialBid\Handlers\BidHandler@onAuthorized'
        );
        $events->listen(
            'bid.created',
            'SocialBid\Handlers\BidHandler@onCreated'
        );
        $events->listen(
            'bid.rejected',
            'SocialBid\Handlers\BidHandler@onRejected'
        );
        $events->listen(
            'bid.approved',
            'SocialBid\Handlers\BidHandler@onApproved'
        );
        $events->listen(
            'bid.cancelled',
            'SocialBid\Handlers\BidHandler@onCancelled'
        );
        $events->listen(
            'bid.counteredByReceiver',
            'SocialBid\Handlers\BidHandler@onCounteredByReceiver'
        );
        $events->listen(
            'bid.counterbid.denied',
            'SocialBid\Handlers\BidHandler@onCounterBidDenied'
        );
        $events->listen(
            'bid.counterbid.accepted',
            'SocialBid\Handlers\BidHandler@onCounterBidAccepted'
        );
        $events->listen(
            'bid.counteredByCreator',
            'SocialBid\Handlers\BidHandler@onCounteredByCreator'
        );
        $events->listen(
            'bid.taskNotCompleted',
            'SocialBid\Handlers\BidHandler@onTaskNotCompleted'
        );

    }

    public function onAuthorized($bid)
    {
        $socialUser = $this->socialAccount->byTypeAndId(
            $bid->service,
            $bid->identifier
        )->with('user')->first();
        $receiver = isset($socialUser->user) ? $socialUser->user : null;

        // send notification emails
        $this->mailer->bidAuthorized($receiver, Sentry::getUser(), $bid);
    }

    public function onCreated($bid)
    {
        $socialUser = $this->socialAccount->byTypeAndId(
            $bid->service,
            $bid->identifier
        )->with('user')->first();
        $receiver = isset($socialUser->user) ? $socialUser->user : null;

        // send notification emails
        $this->mailer->bidCreated($receiver, Sentry::getUser(), $bid);
    }

    public function onRejected($bid)
    {
        $bid->status = ServiceBid::STATUS_DENIED;
        $bid->save();
    }

    public function onApproved($bid)
    {
        $this->mailer->bidApproved(Sentry::getUser(), $bid);
    }

    public function onCancelled($bid)
    {
        $this->mailer->bidCancelled(Sentry::getUser(), $bid);
        //$bid->status = ServiceBid::STATUS_BID_CANCELLED;
        //$bid->save();
        $bid->delete();
    }

    public function onCounteredByReceiver($bid, $newPrice)
    {
        $this->mailer->bidCountered($bid->user, $bid, $newPrice);
        $bid->status = ServiceBid::STATUS_COUNTERED_BY_RECEIVER;
        $bid->counterbids_count++;
        $bid->offer_price = $newPrice;
        $bid->save();
    }

    public function onCounterBidDenied($bid)
    {
        $bid->status = ServiceBid::STATUS_COUNTERBID_DENIED;
        $bid->save();

        $socialUser = $this->socialAccount->byTypeAndId(
            $bid->service,
            $bid->identifier
        )->with('user')->first();
        if ($socialUser) {
            $user = $socialUser->user;
            //send an notification email
            $this->mailer->counterbidDenied($user, $bid);
        }
    }

    public function onCounterBidAccepted($bid)
    {
        $bid->status = ServiceBid::STATUS_COUNTERBID_ACCEPTED;
        $bid->save();
        $socialUser = $this->socialAccount->byTypeAndId(
            $bid->service,
            $bid->identifier
        )->with('user')->first();

        if ($socialUser) {
            $user = $socialUser->user;
            //send an notification email
            $this->mailer->counterbidAccepted($user, $bid);
        }
    }

    public function onCounteredByCreator($bid)
    {
        $bid->status = ServiceBid::STATUS_COUNTERED_BY_CREATOR;
        $bid->counterbids_count++;
        $bid->save();
        $socialUser = $this->socialAccount->byTypeAndId(
            $bid->service,
            $bid->identifier
        )->with('user')->first();
        if ($socialUser) {
            $user = $socialUser->user;
            //send an notification email
            $this->mailer->counterBidCountered($user, $bid);
        }
    }
}