<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(
    [],
    function () {
        Route::get(
              '/',
              function () {
                    return view('marketing.index');
              }
        )->name('index');;
        Route::get(
              'trust',
              function () {
                    return view('marketing.trust');
              }
        );
        Route::get(
              'verify',
              function () {
                    return view('marketing.verify');
              }
        );
        Route::get(
              'seller-faq',
              function () {
                    return view('marketing.seller-faq');
              }
        );
        Route::get(
              'buyer-faq',
              function () {
                    return view('marketing.buyer-faq');
              }
        );
        Route::get(
              'become-seller',
              function () {
                    return view('marketing.become-seller');
              }
        );
        Route::get(
              'about',
              function () {
                    return view('marketing.about');
              }
        );
        Route::get(
              'search',
              function () {
                    return view('marketing.search');
              }
        );
    }
);



Route::group(
    ['prefix' => 'admin','middleware' => 'auth'],
    function () {
        Route::get(
            '/',
            array(
                'as' => 'admin_dashboard',
                'uses' => 'Admin\DashboardController@getDashboard'
            )
        );
        Route::get(
            'verfied/{type}',
            array(
                'as' => 'admin_user_verfied',
                'uses' => 'Admin\UserController@verfiedUser'
            )
        );
        Route::post(
            'change-username',
            array(
                'as' => 'do_admin_change_username',
                'uses' => 'Admin\UserController@postAdminChangeUsername'
            )
        );
     	 Route::post(
            'change-reach',
            array(
                'as' => 'do_change_reach',
                'uses' => 'Admin\UserController@postChangeReach'
            )
        );
        Route::post(
            'change-category',
            array(
                'as' => 'do_change_category',
                'uses' => 'Admin\UserController@postChangeCategory'
            )
        );
        Route::post(
            'change-tags',
            array(
                'as' => 'do_change_tags',
                'uses' => 'Admin\UserController@postChangeTags'
            )
        );

        Route::get(
            'change-password',
            array(
                'as' => 'admin_change_password',
                'uses' => 'Admin\UserController@getAdminChangePassword'
            )
        );
        Route::post(
            'change-password',
            array(
                'as' => 'do_admin_change_password',
                'uses' => 'Admin\UserController@postAdminChangePassword'
            )
        );
        Route::post(
            'change-profile-image',
            array(
                'as' => 'do_update_profile_image',
                'uses' => 'Admin\UserController@saveFollowbackProfileImage'
            )
        );
        Route::get(
            'create-social-urls',
            array(
                'as' => 'create_social_urls',
                'uses' => 'Admin\UserController@createSocialUrls'
            )
        );

        Route::post(
            'store-social-urls',
            array(
                'as' => 'store_social_urls',
                'uses' => 'Admin\UserController@storeSocialUrls'
            )
        );
        Route::get(
            'users',
            array(
                'as' => 'admin_users_index',
                'uses' => 'Admin\UserController@getIndex'
            )
        );
        Route::get(
            'user/delete/{id}',
            array(
                'as' => 'admin_user_delete',
                'uses' => 'Admin\UserController@getDelete'
            )
        );

        Route::get(
            'bids',
            array(
                'as' => 'admin_bids_index',
                'uses' => 'Admin\BidController@getIndex'
            )
        );
        Route::get(
            'settings',
            array(
                'as' => 'admin_settings_index',
                'uses' => 'Admin\SettingsController@getIndex'
            )
        );
        Route::get(
            'bids-delete/{id}',
            array(
                'as' => 'admin_bid_delete',
                'uses' => 'Admin\BidController@doDeleteBid'
            )
        );

        Route::get(
            'most-search-user-settings',
            array(
                'as' => 'admin_most_search_user_settings_index',
                'uses' => 'Admin\MostSearchUserController@getIndex'
            )
        );
        Route::get(
            'most-search-user',
            array(
                'as' => 'admin_most_search_user',
                'uses' => 'Admin\MostSearchUserController@getMostSearchUser'
            )
        );
        Route::post(
            'post-search-user',
            array(
                'as' => 'admin_post_most_search_user',
                'uses' => 'Admin\MostSearchUserController@postSearchUser'
            )
        );
        Route::get(
            'delete-most-search-user/{id}',
            array(
                'as' => 'admin_delete_most_search_user',
                'uses' => 'Admin\MostSearchUserController@deleteUser'
            )
        );
        Route::get(
            'add-most-search-user',
            array(
                'as' => 'admin_most_search_user_add',
                'uses' => 'Admin\MostSearchUserController@addUser'
            )
        );
        Route::post(
            'rename-most-search-user',
            array(
                'as' => 'admin_most_search_user_rename',
                'uses' => 'Admin\MostSearchUserController@renameUser'
            )
        );

        //Admin Verify Users
        Route::get(
            'verified-users',
            array(
                'as' => 'admin_verified_users_index',
                'uses' => 'Admin\VerifyUserController@getIndex'
            )
        );
        Route::get(
            'verify-users',
            array(
                'as' => 'admin_verify_user',
                'uses' => 'Admin\VerifyUserController@getVerifyUser'
            )
        );
        Route::post(
            'post-verify-user',
            array(
                'as' => 'admin_post_verify_user',
                'uses' => 'Admin\VerifyUserController@postVerifyUser'
            )
        );
        Route::get(
            'remove-verified-user/{id}',
            array(
                'as' => 'remove_verify_most_search_user',
                'uses' => 'Admin\VerifyUserController@removeVerifyUser'
            )
        );
        Route::get(
            'add-verify-user',
            array(
                'as' => 'admin_add_verify_user',
                'uses' => 'Admin\VerifyUserController@addVerifyUser'
            )
        );

        //Admin Bind Users
        /*
        Route::get(
            'link-users',
            array(
                'as' => 'admin_link_users_index',
                'uses' => 'Admin\LinkUserController@getIndex'
            )
        );
        Route::get(
            'add-email',
            array(
                'as' => 'admin_add_link_email',
                'uses' => 'Admin\LinkUserController@getEmail'
            )
        );
        Route::post(
            'post-email',
            array(
                'as' => 'admin_post_email',
                'uses' => 'Admin\LinkUserController@doPostEmail'
            )
        );
        Route::get(
            'add-link-user/{type}',
            array(
                'as' => 'admin_add_link_user',
                'uses' => 'Admin\LinkUserController@getAddUserLink'
            )
        );
        //  Route::get('post-link-user',array('as'=>'admin_post_link_user','uses'=>'Admin\LinkUserController@getSocialSearchUser'));
        Route::post(
            'post-link-user',
            array(
                'as' => 'admin_post_link_user',
                'uses' => 'Admin\LinkUserController@postLinkUser'
            )
        );
*/
        Route::group(
            ['middleware' => 'Followback\Http\Middleware\VerifyCsrfToken'],
            function () {
                Route::post(
                    'settings/payments/save',
                    array(
                        'as' => 'do_admin_settings_payment_save',
                        'uses' => 'Admin\SettingsController@postPaymentSave'
                    )
                );
                Route::post(
                    'settings/bid/save',
                    array(
                        'as' => 'do_admin_settings_bid_save',
                        'uses' => 'Admin\SettingsController@postBidSave'
                    )
                );
            }
        );
    }
);

Route::get(
    'encode-status',
    array(
        'as' => 'encode_status',
        'uses' => 'BidController@getEncodeStatus'
    )
);

/* CATEGORIES */
Route::get(
    'sort/{category?}',
    array(
        'as' => 'sort',
        'uses' => 'UserController@getSorted'
    )
);

/* FOLLOWERS */
Route::get(
    'followers/{followers}',
    array(
        'as' => 'sort',
        'uses' => 'UserController@getFollowers'
    )
);


/* SOCIAL CONNECT
----------------------------*/
Route::get(
    'auth/social-login/{type}',
    array(
        'as' => 'auth_social_login',
        'middleware' => 'oauth_token',
        'uses' => 'AuthController@getSocialLogin'
    )
);
// Route::get(
//     'about',
//     array(
//         'as' => 'static_about_us_page',
//         'uses' => 'StaticPageController@getAboutPage'
//     )
// );
Route::get(
    'how-it-works',
    array(
        'as' => 'static_how_it_work_page',
        'uses' => 'StaticPageController@getHowItWorkPage'
    )
);
Route::get(
    'support',
    array(
        'as' => 'static_support_page',
        'uses' => 'StaticPageController@getSupportPage'
    )
);
Route::get(
    'view-all-users',
    array(
        'as' => 'view_all_users',
        'uses' => 'MostSearchUserController@getIndex'
    )
);
Route::any(
    'privacy-policy',
    array(
        'as' => 'static_privacy_policy_page',
        'uses' => 'StaticPageController@getPrivacyPolicy'
    )
);
Route::get(
    'terms-of-service',
    array(
        'as' => 'static_terms_of_service',
        'uses' => 'StaticPageController@getTermsService'
    )
);
Route::get(
    'sitemap',
    array(
        'as' => 'static_sitemap_page',
        'uses' => 'StaticPageController@getSitemap'
    )
);
Route::get(
    'social_auth/other-social-login/{type}',
    array(
        'as' => 'social_login_custom_vine_form',
        'uses' => 'AuthController@getCustomSocialVineLogin'
    )
);
Route::post(
    'social_auth/custom_social_login',
    array(
        'as' => 'do_custom_social_vine_login',
        'uses' => 'AuthController@postVineLogin'
    )
);
Route::get(
    'loginPopup',
    array('as' => 'get_login_popup', 'uses' => 'AuthController@getLoginPopup')
);
Route::get(
    'registerPopup',
    array(
        'as' => 'get_register_popup',
        'uses' => 'AuthController@getRegisterPopup'
    )
);

// Route::group(['prefix' =>'social_auth'], function(){

// 	Route::get('vine', array('as'=>'social_login_custom_vine_form', 'uses'=>'AuthController@getCustomSocialVineLogin'));
// 	Route::post('custom_social_login', array('as' => 'do_custom_social_vine_login', 'uses' => 'AuthController@postVineLogin'));
// 	// Route::post('custom_social_vine_login', array('as' => 'do_custom_social_vine_login', 'uses' => 'AuthController@postVineLogin'));

// });

/* REGISTRATION
----------------------------*/
Route::get(
    'register-success',
    array(
        'as' => 'register_success',
        'uses' => 'RegistrationController@getRegisterSuccess'
    )
);
Route::group(
    [],
    function () {
        Route::get(
            'login',
            array('as' => 'auth_login', 'uses' => 'AuthController@getLogin')
        );
        Route::get(
            'register',
            array(
                'as' => 'register',
                'uses' => 'RegistrationController@getIndex'
            )
        );
        Route::post(
            'register/upload-reg-profile-pic',
            array(
                'as' => 'upload_reg_profile_pic',
                'uses' => 'RegistrationController@uploadRegProfilePic'
            )
        );
        Route::post(
            'register/save-reg-profile-image',
            array(
                'as' => 'save_reg_profile_image',
                'uses' => 'RegistrationController@saveRegProfileImage'
            )
        );
        //Route::get('register-success',array('as'=>'register_success','uses'=>'RegistrationController@getRegisterSuccess'));
        Route::get(
            'remind-password',
            array(
                'as' => 'remind_password',
                'uses' => 'RemindPasswordController@getRemindPassword'
            )
        );
        Route::get(
            'remind-password-complete',
            array(
                'as' => 'remind_password_complete',
                'uses' => 'RemindPasswordController@getRemindPasswordComplete'
            )
        );
        Route::get(
            'reset-password',
            array(
                'as' => 'reset_password',
                'uses' => 'RemindPasswordController@getResetPassword'
            )
        );
        Route::group(
        /*['middleware' => 'csrf'],*/
            [],
            function () {
                //Both(remind-password and change-password) route having same functionality but use in different place
                Route::post(
                    'remind-password',
                    array(
                        'as' => 'do_remind_password',
                        'uses' => 'RemindPasswordController@postRemindPassword'
                    )
                );
                Route::post(
                    'change-password',
                    array(
                        'as' => 'do_change_password',
                        'uses' => 'RemindPasswordController@postChangePassword'
                    )
                );
                Route::post(
                    'change-notification',
                    array(
                        'as' => 'do_change_notification',
                        'uses' => 'ProfileController@postChangeNotification'
                    )
                );
                Route::post(
                    'settings/upload-profile-pic',
                    array(
                        'as' => 'upload_profile_pic',
                        'uses' => 'ProfileController@uploadProfilePic'
                    )
                );
                Route::post(
                    'settings/upload-save-profile-pic',
                    array(
                        'as' => 'upload_and_save_profile_pic',
                        'uses' => 'ProfileController@uploadAndSaveProfilePic'
                    )
                );
                Route::post(
                    'settings/update-profile-pic',
                    array(
                        'as' => 'do_update_profile_pic',
                        'uses' => 'ProfileController@postUpdateProfilePic'
                    )
                );
                Route::post(
                    'settings/update-twitter',
                    array(
                        'as' => 'do_update_twitter',
                        'uses' => 'ProfileController@updateTwitter'
                    )
                );
                Route::post(
                    'settings/update-facebook',
                    array(
                        'as' => 'do_update_facebook',
                        'uses' => 'ProfileController@updateFacebook'
                    )
                );   
                Route::post(
                    'settings/update-linkedin',
                    array(
                        'as' => 'do_update_linkedin',
                        'uses' => 'ProfileController@updateLinkedin'
                    )
                );
                 Route::post(
                    'settings/update-soundcloud',
                    array(
                        'as' => 'do_update_soundcloud',
                        'uses' => 'ProfileController@updateSoundcloud'
                    )
                );   
                Route::post(
                    'settings/update-youtube',
                    array(
                        'as' => 'do_update_youtube',
                        'uses' => 'ProfileController@updateYoutube'
                    )
                );
                Route::post(
                    'settings/update-googleplus',
                    array(
                        'as' => 'do_update_googleplus',
                        'uses' => 'ProfileController@updateGoogleplus'
                    )
                );  
                Route::post(
                    'settings/update-instagram',
                    array(
                        'as' => 'do_update_instagram',
                        'uses' => 'ProfileController@updateInstagram'
                    )
                );         
                Route::post(
                    'settings/update-web',
                    array(
                        'as' => 'do_update_web',
                        'uses' => 'ProfileController@updateWeb'
                    )
                );   
                 Route::post(
                    'settings/update-about',
                    array(
                        'as' => 'do_update_about',
                        'uses' => 'ProfileController@updateAbout'
                    )
                );   
                 Route::post(
                    'settings/update-reach',
                    array(
                        'as' => 'do_update_reach',
                        'uses' => 'ProfileController@updateReach'
                    )
                );                                           
                Route::get(
                    'profile/delete-profile-image/{id}',
                    array(
                        'as' => 'delete_profile_image',
                        'uses' => 'AuthController@deleteProfileImage'
                    )
                );
                Route::post(
                    'reset-password',
                    array(
                        'as' => 'do_reset_password',
                        'uses' => 'RemindPasswordController@postResetPassword'
                    )
                );
                Route::post(
                    'register',
                    array(
                        'as' => 'do_register',
                        'uses' => 'RegistrationController@postRegister'
                    )
                );
                Route::post(
                    'login',
                    array(
                        'as' => 'do_auth_login',
                        'uses' => 'AuthController@postLogin'
                    )
                );
            }
        );
        /* USER SEARCH */
        Route::get(
            '/old-index',
            array('as' => 'old-index', 'uses' => 'StaticPageController@getIndex')
        );
    }
);

/* USER SEARCH WITHOUT AUTHENTICATION
---------------------------------------------*/
Route::get(
    'search-social-users',
    array(
        'as' => 'search_users_without_auth',
        'uses' => 'SearchController@getSocialSearch'
    )
);

Route::group(
    ['middleware' => 'auth'],
    function () {
        //For Bubble for ajax request
        Route::get(
            'count-bubble',
            array(
                'as' => 'count_bubble',
                'uses' => 'BaseController@countBubble'
            )
        );

        /*Route::get('profile/dashboard',array('as'=>'profile_dashboard','uses'=>'ProfileController@getDashboard'));*/
        Route::get(
            'profile/dashboard',
            array(
                'as' => 'profile_dashboard',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'my-prices',
            array(
                'as' => 'profile_services_prices',
                'uses' => 'ProfileController@getServicesPrices'
            )
        );
        Route::get(
            'settings',
            array(
                'as' => 'profile_followback_profile',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'settings/connect',
            array(
                'as' => 'profile_connect',
                'uses' => 'ProfileController@getConnect'
            )
        );
        //for payments
        Route::get(
            'settings/receiving-payments',
            array(
                'as' => 'profile_payment',
                'uses' => 'ProfileController@getReceivingPayments'
            )
        );
        Route::get(
            'settings/followback-profile',
            array(
                'as' => 'profile_followback_profile',
                'uses' => 'ProfileController@getFollowbackProfile'
            )
        );
        Route::get(
            'profile/post-followback-profile',
            array(
                'as' => 'do_followback_profile',
                'uses' => 'ProfileController@postUserProfie'
            )
        );

        //Change Email
        //Route::get('profile/change-email',array('as'=>'change_email','uses'=>'AuthController@getChangeEmail'));
        //Route::post('profile/change-email',array('as'=>'do_change_email','uses'=>'UserController@doChangeEmail'));

        // Route::get('profile/block-users',array('as'=>'profile_block_users','uses'=>'ProfileController@getBlockUsers'));
        Route::post(
            'profile/change-email',
            array(
                'as' => 'do_change_email',
                'uses' => 'UserController@doChangeEmail'
            )
        );
        Route::post(
            'profile/change-name',
            array(
                'as' => 'do_change_name',
                'uses' => 'UserController@doChangeName'
            )
        );
        
         Route::post(
            'profile/change-paypal',
            array(
                'as' => 'do_change_paypal',
                'uses' => 'UserController@doChangePaypal'
            )
        );
        
        
        Route::get(
            'profile/resend-confirmation-email',
            array(
                'as' => 'do_resend_confirmation_email',
                'uses' => 'UserController@doResendConfirmationMail'
            )
        );
        Route::get(
            'profile/delete-followback-account/{id}',
            array(
                'as' => 'delete_followback_account',
                'uses' => 'AuthController@deletefollowbackProfile'
            )
        );

        Route::post(
            'profile/change-username',
            array(
                'as' => 'do_change_username',
                'uses' => 'UserController@doChangeUsername'
            )
        );

        Route::get(
            'profile/display-public-profile/{id}',
            array(
                'as' => 'display_public_profile',
                'uses' => 'ProfileController@displayPublicProfile'
            )
        );
        Route::get(
            'profile/hide-public-profile/{id}',
            array(
                'as' => 'hide_public_profile',
                'uses' => 'ProfileController@hidePublicProfile'
            )
        );

        Route::get(
            'profile/as-it-happen/{id}',
            array(
                'as' => 'do_as_it_happen',
                'uses' => 'ProfileController@doAsItHappen'
            )
        );
        Route::get(
            'profile/daily-email/{id}',
            array(
                'as' => 'do_daily_email',
                'uses' => 'ProfileController@doDailyEmail'
            )
        );
        Route::get(
            'profile/never-email/{id}',
            array(
                'as' => 'do_never_email',
                'uses' => 'ProfileController@doNeverEmail'
            )
        );

        Route::post(
            'profile/services-prices',
            array(
                'as' => 'do_profile_services_prices',
                'uses' => 'ProfileController@postServicesPrices'
            )
        );
        Route::post(
            'profile/paypal-email',
            array(
                'as' => 'do_paypal_email',
                'uses' => 'ProfileController@postPaypalEmail'
            )
        );

        Route::get(
            'disconnect/{type}',
            array(
                'as' => 'auth_disconnect',
                'uses' => 'AuthController@getDisconnect'
            )
        );
        Route::get(
            'connect/{type}',
            array('as' => 'auth_connect', 'uses' => 'AuthController@getConnect')
        );
        Route::get(
            'acc-reset/{type}',
            array(
                'as' => 'social_acc_disconnect',
                'uses' => 'AuthController@getAccountReset'
            )
        );

        Route::get(
            'search-users',
            array(
                'as' => 'search_users',
                'uses' => 'SearchController@getSocialSearch'
            )
        );

        Route::get(
            'service/create',
            array(
                'as' => 'add_service',
                'uses' => 'ServiceController@addService'
            )
        );
        Route::post(
            'service/create',
            array(
                'as' => 'create_service',
                'uses' => 'ServiceController@createService'
            )
        );
        Route::get(
            'service/edit/{id}',
            array(
                'as' => 'edit_service',
                'uses' => 'ServiceController@editService'
            )
        );

        Route::get(
            'my-services',
            array(
                'as' => 'service_list',
                'uses' => 'ServiceController@getServiceList'
            )
        );
        Route::any(
            'socialtasks',
            array('as' => 'bid_list', 'uses' => 'BidController@myBids')
        );

        Route::get(
            'received',
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );

        Route::get(
            'sent',
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );

        Route::get(
            'settings/blocked-users',
            array(
                'as' => 'blocked_users',
                'uses' => 'UserController@getBlockedUsers'
            )
        );
        Route::get(
            'block-bids/{userId}',
            array('as' => 'block_bids', 'uses' => 'BidController@getBlockBids')
        );
        Route::get(
            'unblock-bids/{userId}',
            array(
                'as' => 'unblock_bids',
                'uses' => 'BidController@getUnblockBids'
            )
        );

        Route::get(
            'socialtasks',
            //array('as' => 'bids_for_me', 'uses' => 'BidController@getBidsForMe')
            array('as' => 'bids_for_me', 'uses' => 'BidController@getAllBids')
        );
        Route::get(
            'bid-accepted',
            array('as' => 'bid_accepted', 'uses' => 'BidController@getAccepted')
        );
        Route::get(
            'socialtasks/accept/{id}',
            array(
                'as' => 'accept_bid_for_me',
                'uses' => 'BidController@getAcceptBidForMe'
            )
        );
        Route::get(
            'socialtasks/deny/{id}',
            array(
                'as' => 'deny_bid_for_me',
                'uses' => 'BidController@getDenyBidForMe'
            )
        );
        Route::get(
            'socialtasks/hide/{id}',
            array(
                'as' => 'hide_bid_for_me',
                'uses' => 'BidController@getHideBidForMe'
            )
        );
        Route::get(
            'socialtasks/hide/{id}',
            array(
                'as' => 'hide_bid_for_sender',
                'uses' => 'BidController@getHideBidForSender'
            )
        );
        Route::get(
            'socialtasks/set-as-completed/{id}',
            array(
                'as' => 'set_bid_as_completed',
                'uses' => 'BidController@getSetAsCompleted'
            )
        );

        //Route::get('profile/get-username-by-email/{id}',array('as'=>'get_username_by_email','uses'=>'AuthController@getUsernameByEmail'));

        Route::get(
            'bid/cancel/{id}',
            array('as' => 'cancel_bid', 'uses' => 'BidController@getCancel')
        );
        Route::get(
            'bid/task-not-completed/{id}',
            array(
                'as' => 'task_not_completed',
                'uses' => 'BidController@getTaskNotCompleted'
            )
        );
        Route::get(
            'socialtasks/task-completed/{id}',
            array(
                'as' => 'task_completed',
                'uses' => 'BidController@getTaskCompleted'
            )
        );

        Route::post(
            'bid/counter-by-receiver/{id}',
            array(
                'as' => 'bid_counter_by_receiver',
                'middleware' => ['counterBidsLeft'],
                'uses' => 'CounterBidController@postCounterByReceiver'
            )
        );
        Route::post(
            'bid/counter-by-creator/{id}',
            array(
                'as' => 'bid_counter_by_creator',
                'middleware' => ['counterBidsLeft'],
                'uses' => 'CounterBidController@postCounterByCreator'
            )
        );

        //COUNTERBIDS
        Route::group(
            ['prefix' => 'counterbid/{bidId}', 'middleware' => 'counterBid'],
            function () {
                Route::get(
                    'accept',
                    array(
                        'as' => 'counterbid_accept',
                        'uses' => 'CounterBidController@getAccept'
                    )
                );
                Route::get(
                    'deny',
                    array(
                        'as' => 'counterbid_deny',
                        'uses' => 'CounterBidController@getDeny'
                    )
                );
                Route::get(
                    'counter',
                    array(
                        'as' => 'counterbid_counter',
                        'uses' => 'CounterBidController@getCounter'
                    )
                );
            }
        );

        Route::group(
            [
                'prefix' => '/{service}/{identifier}',
                'middleware' => 'auth'

            ],
            function () {

                Route::get(
                    'step-2',
                    array(
                        'as' => 'bid_upload',
                        'uses' => 'BidController@getUpload'
                    )
                );
                // Route::get('/',array('as'=>'bid_create','middleware'=>'blockedBid|bidsLeft','uses'=>'BidController@getCreate'));

                //Route::group(['middleware'=>'csrf'], function(){
                Route::post(
                    'make',
                    array(
                        'as' => 'bid_make',
                        'uses' => 'BidController@postMake',
                        'middleware' => [
                            'blockedBid',
                            'bidsLeft',
                            'bidAllowedByType'
                        ]
                    )
                );
                Route::post(
                    'upload',
                    array(
                        'as' => 'do_bid_upload',
                        'uses' => 'BidController@postBidUpload'
                    )
                );
                //});
            }
        );

        Route::get(
            'checkout',
            array('as' => 'checkout', 'uses' => 'PaymentController@getCheckout')
        );

        Route::get(
            'payment/make',
            array('as' => 'payment_make', 'uses' => 'PaymentController@getMake')
        );
        Route::get(
            'payment/return',
            array(
                'as' => 'payment_paypal_return',
                'uses' => 'PaymentController@getReturn'
            )
        );

        Route::get(
            'payment/confirmation-paid',
            array(
                'as' => 'confirmation_paid',
                'uses' => 'PaymentController@getConfirmationPaid'
            )
        );
        Route::get(
            'payment/confirmation-authorized',
            array(
                'as' => 'confirmation_authorized',
                'uses' => 'PaymentController@getConfirmationAuthorized'
            )
        );

        Route::get(
            'users/user-socail-account',
            array(
                'as' => 'chk_user_socail_account',
                'uses' => 'UserController@checkUserSocialAcc'
            )
        );

    }
);

Route::get(
    'sync-account/{service}/{identifier}',
    array('as' => 'sync_accoount', 'uses' => 'UserController@getSyncAccount')
);
Route::get(
    'min-bid-price/{service}/{identifier}/{serviceType}',
    array('as' => 'min_bid_price', 'uses' => 'UserController@getMinBidPrice')
);

Route::get(
    'confirm-email/{token}',
    array(
        'as' => 'confirm_email',
        'uses' => 'RegistrationController@getConfirmEmail'
    )
);
Route::get(
    'auth/logout',
    array('as' => 'auth_logout', 'uses' => 'AuthController@getLogout')
);
Route::get(
    'faq',
    array('as' => 'static_faq', 'uses' => 'StaticPageController@getFaq')
);
Route::get(
    'privacy-policy',
    array(
        'as' => 'static_privacy_policy',
        'uses' => 'StaticPageController@getPrivacyPolicy'
    )
);
Route::get(
    'terms-of-service',
    array(
        'as' => 'static_terms_of_service',
        'uses' => 'StaticPageController@getTermsService'
    )
);

Route::post(
    'paypal/preapproval-callback',
    array(
        'as' => 'paypal_preapproval_callback',
        'uses' => 'PreapprovalController@postPreapprovalCallback'
    )
);
Route::post(
    'paypal/payment-callback',
    array(
        'as' => 'paypal_payment_callback',
        'uses' => 'PaymentController@getPaypalCallback'
    )
);

Route::group(
    [
        'prefix' => '{service}/{username}',
        'middleware' => 'auth'
    ],
    function () {

        //Route::get('/',array('as'=>'bid_create' , 'middleware'=>'blockedBid|bidsLeft', 'uses'=>'BidController@getCreate'));
        Route::get(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@getCreate', 'middleware' => 'auth')
        );
        Route::post(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@postCreate')
        );

        Route::get(
            'step-2',
            array('as' => 'bid_upload', 'uses' => 'BidController@getUpload')
        );
        Route::get(
            'redirect/otherSocialAcc',
            array(
                'as' => 'redirect_other_social_profile',
                'uses' => 'BidController@redirectOtherSocialProfile'
            )
        );
    }
);
Route::get(
    'get-instructions',
    array('as' => 'get_instruction', 'uses' => 'BidController@getInstructions')
);
Route::group(
    ['prefix' => '{username}'],
    function () {
        //Route::get('/',array('as'=>'bid_create' , 'middleware'=>'blockedBid|bidsLeft', 'uses'=>'BidController@getCreate'));
        Route::get(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@getCreate')
        );
        Route::post(
            '/',
            array('as' => 'bid_create', 'uses' => 'BidController@postCreate')
        );
        Route::get(
            'step-2',
            array('as' => 'bid_upload', 'uses' => 'BidController@getUpload')
        );
        Route::get(
            'redirect/FollowbackAcc',
            array(
                'as' => 'redirect_followback_profile',
                'uses' => 'BidController@redirectFollowbackProfile'
            )
        );
    }
);
