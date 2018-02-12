<?php

namespace SocialBid\Mailers;

abstract class Mailer {
	public function sendTo($email, $subject, $view, $data = array())
	{
		return \Mail::send($view,$data, function($message) use($email, $subject){
			$message->to($email)->subject($subject);
		});
	}
	public function queueTo($email, $subject, $view, $data = array())
	{
		return \Mail::queue($view,$data, function($message) use($email, $subject){
			$message->to($email)->subject($subject);
		});
	}
}