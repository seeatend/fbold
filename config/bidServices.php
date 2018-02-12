<?php
return [
	'followback' => [
		'follow_back' => [
			'description' => 'Followback',
			'comment_text' => '',
			'isUploadable' => false
		],
		'like' => [
			'description' => 'Like',
			'comment_text' => '',
			'isUploadable' => false
		],
		'post_media' => [
			'description' => 'Post media',
			'comment_text' => '',
			'isUploadable' => true
		],
        'post_text' => [
			'description' => 'Post text',
			'comment_text' => '',
			'isUploadable' => false
		],
		'comment' => [
			'description' => 'Comment',
			'comment_text' => '',
			'isUploadable' => false
		],
		'others' => [
			'description' => 'Others',
			'comment_text' => '',
			'isUploadable' => false
		], 
	],
	'facebook' => [	
		'like' => [
			'description' => 'Like',
			'comment_text' => '',
			'isUploadable' => false
		],
		'post' => [
			'description' => 'Post',
			'comment_text' => '',
			'isUploadable' => true
			
		],
		'share' => [
			'description' => 'Share',
			'comment_text' => '',
			'isUploadable' => false
			
		],
	],
	'twitter' => [
		'follow_back' => [
			'description' => 'Followback',
			'comment_text' => '',
			'isUploadable' => false
		],
		'favorite' => [
			'description' => 'Favorite',
			'comment_text' => '',
			'isUploadable' => false
		],
		'post_media' => [
			'description' => 'Post media',
			'comment_text' => '',
			'isUploadable' => true
		],
		'tweet' => [
			'description' => 'Tweet',
			'comment_text' => '',
			'isUploadable' => true
		],
		'retweet' => [
			'description' => 'Retweet',
			'comment_text' => '',
			'isUploadable' => false
		],
		'reply' => [
			'description' => 'Reply',
			'comment_text' => '',
			'isUploadable' => false
		],
	],
	'linkedin' => [
		'follow_back' => [
			'description' => 'FollowBack',
			'comment_text' => ''
		],
		'like' => [
			'description' => 'Like a Photo or Video',
			'comment_text' => ''
		],
		'post' => [
			'description' => 'Post photo or video',
			'comment_text' => ''
		],
		'telephone_number' => [
			'description' => 'Telephone number',
			'comment_text' => ''
		],
		'meet_in' => [
			'description' => 'Meet In',
			'comment_text' => ''
		],
	],
	'instagram' => [
		'follow_back' => [
			'description' => 'Followback',
			'is_followed_user' => true,
			'isUploadable' => false,
			'comment_text' => 'Followback'
		],
		'like' => [
			'description' => 'Like',
			'is_followed_user' => false,
			'isUploadable' => false,
			'comment_text' => 'Like'
		],
		'post' => [
			'description' => 'Post media',
			'is_followed_user' => false,
			'comment_text' => '',
			'isUploadable' => true
		],
		'repost' => [
			'description' => 'Repost',
			'is_followed_user' => false,
			'comment_text' => '',
			'isUploadable' => false
		],
		'comment' => [
			'description' => 'Comment',
			'is_followed_user' => false,
			'isUploadable' => false,
			'comment_text' => ''
		],
	],
	'youtube' => [
		'like' => [
			'description' => 'Like',
			'isUploadable' => false,
			'comment_text' => ''
		],
		'post' => [
			'description' => 'Upload',
			'isUploadable' => true,
			'comment_text' => ''
		],
		'comment' => [
			'description' => 'Comment',
			'isUploadable' => false,
			'comment_text' => ''
		]
	],
	'vine' => [
		'follow_back' => [
			'description' => 'FollowBack',
			'isUploadable' => false,
			'comment_text' => ''
		],
		'like' => [
			'description' => 'Like',
			'isUploadable' => false,
			'comment_text' => ''
		],
		'post' => [
			'description' => 'Post media',
			'isUploadable' => true,
			'comment_text' => ''
		],
		'comment' => [
			'description' => 'Comment',
			'isUploadable' => false,
			'comment_text' => ''
		],
	],

	'settings' => [
		'maximum_bids' => 50,
		'max_counterbids' => 50,
	]
];