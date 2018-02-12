<?php
namespace SocialBid\Mailers;
Use DB, Config;
class BidMailer extends Mailer {

	/**
	 * Notify bid receiver and bidder
	 */
	public function bidAuthorized($receiver, $bidder, $bid)
	{
	
		// This is sent when a successful paypal authorization is made.
		if ($receiver) {

			$status = $this->checkNotification($receiver);
			
			if($status) { 
			
				$this->queueTo($receiver->email, 'New Social Task', 'emails.bid.receiver.authorized', [
					'user' => $receiver,
					'bidderUsername' => $bid->findCreatorSocialUsername(),
					'bidderSocialUrl' => $bid->getCreatorSocialUrl(),
					'price' => $bid->present()->priceDecimal,
					'service_type' => $bid->present()->service_type,
					'service' => $bid->present()->service,
					'bidId' => $bid->id,
				]);
				
			}
		}

		$status = $this->checkNotification($bidder);
		if($status) {
			/*
			$this->queueTo($bidder->email, 'New Bid', 'emails.bid.bidder.authorized', [
				'user' => $bidder,
				'receiverUsername' => $bid->findReceiverSocialUsername(),
				'receiverSocialUrl' => $bid->getReceiverSocialUrl(),
				'price' => $bid->present()->priceDecimal,
				'service_type' => $bid->present()->service_type,
				'service' => $bid->present()->service,
				'bidId' => $bid->id,
			]);
			*/
		}
	}


	/* Bid is created */
	public function bidCreated($receiver, $bidder, $bid)
	{
		// we will not have receiver's email if he's not registered with us
		if ($receiver) {
			$status = $this->checkNotification($receiver);
			if($status) {
				/*
				$this->queueTo($receiver->email, 'New Bid', 'emails.bid.receiver.created', [
					'user' => $receiver,
					'bidderUsername' => $bid->findCreatorSocialUsername(),
					'bidderSocialUrl' => $bid->getCreatorSocialUrl(),
					'price' => $bid->present()->priceDecimal,
					'service_type' => $bid->present()->service_type,
					'service' => $bid->present()->service,
				]);
				*/
			}
		}

		$status = $this->checkNotification($bidder);
		if($bidder) {
			/*
			$this->queueTo($bidder->email, 'New Bid', 'emails.bid.bidder.created', [
				'user' => $bidder,
				'receiverUsername' => $bid->findReceiverSocialUsername(),
				'receiverSocialUrl' => $bid->getReceiverSocialUrl(),
				'price' => $bid->present()->priceDecimal,
				'service_type' => $bid->present()->service_type,
				'service' => $bid->present()->service,
			]);
			*/
		}
	}
	
	public function bidApproved($user, $bid)
	{
		$status = $this->checkNotification($user);
		if($status) {
		/*
			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($user->email, 'Bid approved', 'emails.bid.approved',['bidUser'=>$bid->user,'bidderUsername'=>$bidderUsername ,'bid'=>$bid]);
		*/
		}	
	}
	
	public function bidCancelled($user, $bid)
	{
		$status = $this->checkNotification($user);
		if($status) {
			/*
			return $this->queueTo($user->email, 'Bid cancelled', 'emails.bid.cancelled',['bidDescription'=>$bid->present()->service_type,'bid'=>$bid]);
			*/
		}
	}
	public function bidCountered($user, $bid, $newPrice)
	{
		$status = $this->checkNotification($user);
		if($status) {
			return $this->queueTo($user->email, 'Social Task Update', 'emails.bid.countered',['bidDescription'=>$bid->present()->service_type,'bid'=>$bid,'newPrice'=>$newPrice]);
		}
	}
	public function counterbidDenied($user, $bid)
	{
		$status = $this->checkNotification($user);
		if($status) {
		/*
			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($user->email, 'Counter bid denied', 'emails.bid.counterBidDenied',['bidDescription'=>$bid->present()->service_type,'bid'=>$bid,'bidderUsername'=>$bidderUsername]);
		*/
		}
	}
	public function counterBidAccepted($user, $bid)
	{
		$status = $this->checkNotification($user);
		if($status) {
		/*
			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($user->email, 'Counter bid accepted', 'emails.bid.counterBidAccepted',['bidDescription'=>$bid->present()->service_type,'bid'=>$bid,'bidderUsername'=>$bidderUsername]);
		*/
		}
	}
	public function counterBidCountered($user, $bid)
	{
		$status = $this->checkNotification($user);
		if($status) {
		/*
			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($user->email, 'Bid countered', 'emails.bid.counterBidCountered', ['user' => $user, 'bidderUsername'=>$bidderUsername ,'bid' => $bid, 'bidUser' =>$bid->user]);
		*/
		}
	}
	public function taskNotCompleted($receiver,$bid, $user) {
		$status = $this->checkNotification($receiver);
		if($status) {

			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($receiver->email, 'Social Task not completed', 'emails.bid.bidder.taskNotCompleted', 
				[
					'user' => $user, 
					'bidderUsername'=>$bidderUsername,
					'bid' => $bid, 
					'bidUser' =>$bid->user,
					'bidinstruction' => $bid->comment
				]
			);
			
		
		} 

	}
	
	/* Task Not Completed Receiver */
	public function warningOfBannAccount($bid, $user, $receiver) {
		$status = $this->checkNotification($user);
		if($status) {
		
			$receiverUsername = $bid->findReceiverSocialUsername();
			$bidderUsername = $bid->findCreatorSocialUsername();
			return $this->queueTo($receiver->email, 'Social Task not completed', 'emails.bid.receiver.warningTaskNotCompleted', 
				[
					'user' => $receiver, 
					'receiverUsername'=>$receiverUsername ,
					'bid' => $bid, 
					'bidUser' => $bidderUsername,
					'bidinstruction' => $bid->comment
				]
			);
		}
	}

	public function checkNotification($user) {
		
		//Initialize the status to be true until proven false
		$status = true;
		$notification = Config::get('notificationconstants');
		$notification_status = DB::table('users_profile_settings')->where('user_id',$user->id)->pluck('notification_status');
		//Check notification status  and make sure email is verified
		if($notification_status == 0 && $user->email_verified) {
				// true 
		}	else {
				// when notification is > 0 it means do not mail
				$status = false;
		}

		return $status;
	}  
}