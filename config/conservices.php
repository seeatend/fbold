<?php  
	return array(

		'Followback' => array(

			'name'		  => 'Followback',
			'icon_name'   => 'fa-facebook',
			'icon_url' 	  => 'assets/images/homepage/icon/followback-icon.png',
			'identifier'  => 'followback',
			'class_name'  => 'btn-default',
			'route'		  => 'auth_social_login',	
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-facebook-square',
			'display_flag' => false
		),

		'Instagram' => array(
			'name' 		  => 'Instagram',
			'icon_name'   => 'fa-instagram',
			'icon_url' 	  => 'assets/images/homepage/icon/instagram-icon.png',
			'identifier'  => 'instagram',
			'class_name'  => 'btn-brown',
			'route'		  => 'auth_social_login',
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-instagram',
			'display_flag' => true
		),

		'Twitter' =>  array(
			'name' 		  => 'Twitter',
			'icon_name'   => 'fa-twitter',
			'icon_url'    => 'assets/images/homepage/icon/twitter-icon.png',
			'identifier'  => 'twitter',
			'class_name'  => 'btn-info',
			'route'		  => 'auth_social_login',
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-twitter',
			'display_flag' => true
		),

		'Facebook' => array(

			'name'		  => 'Facebook',
			'icon_name'   => 'fa-facebook',
			'icon_url' 	  => 'assets/images/homepage/icon/facebook-icon.png',
			'identifier'  => 'facebook',
			'class_name'  => 'btn-blue',
			'route'		  => 'auth_social_login',	
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-facebook-square',
			'display_flag' => true
		),
		
		'Youtube' => array(
			'name' 		  => 'Youtube',
			'icon_name'   => 'fa-youtube',
			'icon_url' 	  => 'assets/images/homepage/icon/youtube-icon.png',
			'identifier'  => 'youtube',
			'class_name'  => 'btn-red',
			'route'		  => 'auth_social_login',
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-youtube',
			'display_flag' => true
		),
		'Vine' => array(
			'name' 		  => 'Vine',
			'icon_name'   => 'fa-vine',
			'icon_url' 	  => 'assets/images/homepage/icon/vine-icon.png',
			'identifier'  => 'vine',
			'class_name'  => 'btn-green',
			'route'		  => 'social_login_custom_vine_form',
			'auth_connect_route' => 'auth_connect',
			'auth_disconnect_route' => 'auth_disconnect',
			'set_task_pricesocial_icon' => 'fa-vine',
			'display_flag' => true
		),
	);
