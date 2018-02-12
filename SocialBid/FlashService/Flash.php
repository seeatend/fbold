<?php

namespace SocialBid\FlashService;
use Illuminate\Support\MessageBag;
use Illuminate\Session\SessionManager;
class Flash{
	public function __construct(MessageBag $messageBag,SessionManager $session){
		$this->session = $session;
		$this->messages = $messageBag;
	}
	/**
	 * adds flash message to container
	 * @param string $message message content
	 * @param string $type    type[success,danger,warning,info]
	 */
	public function add($message,$type){
		$this->messages->add($type,$message);
		$this->session->flash('flashMessages',$this->messages);
	}

	public function render($class=null){
		$markup = '';
		if($this->session->has('flashMessages')){
			$markup .= '<div class="container '.$class.'">';
			foreach($this->session->get('flashMessages')->toArray() as $type=>$messages){
				foreach($messages as $message){
					$markup .= '<div class="alert alert-'.$type.'">'.$message.' <a href="#" class="remove-alert"><ins class="fa fa-times"></ins></a></div>';
				}
			}
			$markup .= '</div>';
		}
		return $markup;
	}

	public function __call($name,$args){
		$message = $args[0];
		if(strpos($name,'add')!==false){
			$type = strtolower(substr($name,3));
			switch($type){
				case 'error':
					$this->add($message,'danger');
				break;
				default:
					$this->add($message,$type);
				break;
			}
		}
	}
}