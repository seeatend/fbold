<?php
namespace Followback\Http\Controllers;

use Illuminate\Support\Facades\View;

class StaticPageController extends BaseController {
	public function getIndex()
	{
		$title = 'Your Social Media Task Provider';
		$description = "A marketplace to buy or sell social media actions. Get paid to like, post, share or comment!";
		$keywords = "followback,musicians,popstars,artists,actors, social,task,djs,joutnalist,stars,celebs, Follow, back, Like, Share, Tweet, comment, post, pin, social media";
		return View::make('static.home')->with(compact('title','description','keywords'));
	}

	public function getFaq()
	{
		$title = 'Support';
		$description = "Here's how Followback Works: First, search for a user that you would like to have complete a social media task.";
		$keywords = "signup,sender,receiver,works,social,task";
		return View::make('static.faq')->with(compact('title','description','keywords'));
	}

	public function getAboutPage() {
		$title = 'About us';
		$description = "Followback.com is a website that empowers people to monetize their likeness on social media.";
		$keywords = "how,works,bardia,pourkanan,about,social,task,provider,media,founder,seo,follow,back";
		return View::make('static.about')->with(compact('title','description','keywords'));
	}
	public function getHowItWorkPage() {
		$title = 'How it works';
		$description = "Here's how Followback Works: First, search for a user that you would like to have complete a social media task.";
		$keywords = "signup,sender,receiver,works,social,task";
		return View::make('static.howItWork')->with(compact('title','description','keywords'));
	}

	public function getPrivacyPolicy() {
		$title = 'Privacy Policy';
		$description = "This Privacy Policy is incorporated by reference into the Followback Inc. End User License Agreement and Terms of Use.";
		$keywords = "service,support,contact,changes,information,privacy,disclaimer";
		return View::make('static.privacyPolicy')->with(compact('title','description','keywords'));
	}


	public function getTermsService() {
		$title = 'Terms of Service';
		$description = "As provided in greater detail in the EULA (and without limiting the express language of the EULA), you acknowledge the following...";
		$keywords = "eula,general,scope,license,content,fees,payments,warranty,liability,learn";
		return View::make('static.termsService')->with(compact('title','description','keywords'));
	}


	public function getSitemap() {
		$title = 'Sitemap';
		$description = "Here's how Followback Works: First, search for a user that you would like to have complete a social media task.";
		$keywords = "signup,sender,receiver,works,social,task";
		return View::make('static.sitemap')->with(compact('title','description','keywords'));
	}

	public function getSupportPage() {
		$title = 'Support';
		$description = "Here's how Followback Works: First, search for a user that you would like to have complete a social media task.";
		$keywords = "signup,sender,receiver,works,social,task";
		return View::make('static.support')->with(compact('title','description','keywords'));;
	}
}