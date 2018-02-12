<?php

namespace SocialBid\ViewComposers;
use SocialBid\Helpers\ArrayHelper;
use Sentry;
class SearchBarComposer {
	public function __construct(ArrayHelper $arrayHelper)
	{
		$this->arrayHelper = $arrayHelper;
	}
	public function compose($view)
	{
		$userSocialAccountTypes = Sentry::getUser()->getSocialAccountsTypes();
		$searchOptions = $this->arrayHelper->valuesToUpperFirst($this->arrayHelper->valuesAsKeys($userSocialAccountTypes));
		$view->with(compact('searchOptions'));
	}
}