<?php
namespace SocialBid\Services\Forms\Bid;
use SocialBid\Services\Forms\BaseForm;
use Illuminate\Support\MessageBag;
class CounterBidForm extends BaseForm {
	public function isValidForReceiver($input, $bid)
	{
		$bid->offer_price = str_replace(',', '',$bid->offer_price);
		//$offer_price = floatval(str_replace(',','', $bid->offer_price)) - 1;
		$offer_price = floatval(str_replace(',','', $bid->offer_price)) + 1;
		
		$this->setInput($input);
		
		$rules = [
			'price' => ['required','regex:/^\d+([\.]\d+)?$/', 'numeric', 'min:'.$offer_price],
		];
		return $this->validate($rules);
	}
	public function isValidForCreator($input, $bid)
	{

	    $bid->offer_price = str_replace(',', '',$bid->offer_price);
		$offer_price = floatval(str_replace(',','', $bid->offer_price));
		$this->setInput($input);
		$rules = [
			'price' => ['required','regex:/^\d+([\.]\d+)?$/', 'numeric', 'max:'.$offer_price, 'min: 5' ],
		];
		return $this->validate($rules);
	}
}