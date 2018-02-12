<?php
return [
	'followback' => [
		'follow_back' => [
			'description' => 'Followback',
			'comment_text' => 'Enter the Website and Username you want Followed back.',
			'isUploadable' => false
		],
		'like' => [
			'description' => 'Like',
			'comment_text' => 'Copy and paste the URL of the photo, video or text you want Liked',
			'isUploadable' => false
		],
		'post' => [
			'description' => 'Post (picture or video)',
			'comment_text' => 'Where do you want your photo or video Posted? For example: (personal website, blog, which social media platform etc)
 
Enter the caption you want included with your post? Please note caption or caption accuracy is not guaranteed.
 
Then upload the video or photo you would like posted.
',
			'isUploadable' => true
		],

		'shout_out' => [
			'description' => 'Shout out',
			'comment_text' => 'Where would you like a shout out? For example (personal website, blog, which social media platform, tv show, radio)
Enter what you want shouted out? For example (Wishing happy birthday, Business grand opening, your website Url etc)
',
			'isUploadable' => false
		],
		'sale' => [
			'description' => 'Sale',
			'comment_text' => 'Copy and paste the URL of the post or link you want commented on. Press enter and then provide the comment you want written. Please note comment accuracy is not guaranteed. Please make sure the URL post you have enter setting are PUBLIC.
.',
			'isUploadable' => false
		],
		'comment' => [
			'description' => 'Comment',
			'comment_text' => 'EnterCopy and paste the URL of the post or link you want commented on. Press enter and then provide the comment you want written. Please note comment accuracy is not guaranteed. Please make sure the URL post you have enter setting are PUBLIC.
.',
			'isUploadable' => false
		],
		'host' => [
			'description' => 'Host',
			'comment_text' => 'Enter the Place, address, date, time and length you would like the user to host your event (Club, Restaurant, Birthday party etc…)
',
			'isUploadable' => false
		], 

	],
	'facebook' => [
		'follow_back' => [
			'description' => 'Follow',
			'comment_text' => '',
			'isUploadable' => false
		],
		'like' => [
			'description' => 'Like a Photo or Video',
			'comment_text' => '',
			'isUploadable' => false
		],
		'post' => [
			'description' => 'Post a Photo or Video',
			'comment_text' => '',
			'isUploadable' => true
			
		],
		'share' => [
			'description' => 'Share a Photo or Video',
			'comment_text' => '',
			'isUploadable' => false
			
		],
		'comment' => [
			'description' => 'Facebook Comment',
			'comment_text' => '',
			'isUploadable' => false
		],
		'accept_friend_request' => [
			'description' => 'Accept my Friend Request.',
			'comment_text' => '',
			'isUploadable' => false
		]
	],
	'twitter' => [
		'follow_back' => [
			'description' => 'Followback',
			'comment_text' => 'Please enter the desired username you want followed back.',
			'isUploadable' => false
		],
		'favorite' => [
			'description' => 'Favorite',
			'comment_text' => 'Please enter the tweet URL you want favorited.',
			'isUploadable' => false
		],
		'tweet' => [
			'description' => 'Tweet a Photo, Video or text',
			'comment_text' => 'a. Do you want a filter applied to your post? If so which one.
b. Enter the desired caption you want included with you Photo or Video. - Comment accuracy is not guaranteed.
c. Who do you want tagged in the post? Not guaranteed.
d. Enter the Neighbourhood or city to want tagged - Not guaranteed.',
			'isUploadable' => true
		],
		'retweet' => [
			'description' => 'Retweet',
			'comment_text' => 'Please Enter the URL of tweet you want retweeted.',
			'isUploadable' => false
		],
		'reply' => [
			'description' => 'Reply',
			'comment_text' => 'Enter the URL of the Tweet you want replied. We are not responsible for how the user response to your tweet.',
			'isUploadable' => false
		],
		'create_hashtag' => [
			'description' => 'Create a Hashtag',
			'comment_text' => 'Enter the Hashtag you want tweet.',
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
			'description' => 'Like a Photo or Video',
			'is_followed_user' => false,
			'isUploadable' => false,
			'comment_text' => 'Like'
		],
		'post' => [
			'description' => 'Post a Photo or Video',
			'is_followed_user' => false,
			'comment_text' => '1. Do you want a filter applied to your post? If so next one.
2. Enter the desired caption you want included with your post. - Comment accuracy is not guaranteed.
3. Do you want someone tagged in this post. - This is not guaranteed.
4. Enter the location you want added in this post. - This is not guaranteed.
NOTE: The detail box should come after the Photo or Video upload box.',
			'isUploadable' => true
		],
		'comment' => [
			'description' => 'Comment',
			'is_followed_user' => false,
			'isUploadable' => false,
			'comment_text' => 'Please enter the Photo or Video URL you want to add a comment on and then your desired comment. Comment accuracy is not guaranteed.'
		],
		'promote_location' => [
			'description' => 'Add Location',
			'is_followed_user' => false,
			'isUploadable' => false,
			'comment_text' => 'Please enter the Photo or Video Url you want a location added to, and then your desired location. If you do not care where the location is added do not enter a URL.'
		]
	],
	'youtube' => [
		'follow_back' => [
			'description' => 'FollowBack(Subscribe)',
			'isUploadable' => false
		],
		'like' => [
			'description' => 'Like',
			'isUploadable' => false,
			'comment_text' => 'Copy and paste the Youtube video URL you want liked.'
		],
		'post' => [
			'description' => 'Post a Video',
			'isUploadable' => true,
			'comment_text' => 'Enter the exact title and description you want with include with your video.'
		],
		'comment' => [
			'description' => 'Comment',
			'isUploadable' => false,
			'comment_text' => 'Copy and paste the Youtube video URL you want comment on. Provide some space and then enter the desire comment you want written.'
		]
	],
	'vine' => [
		'follow_back' => [
			'description' => 'FollowBack',
			'isUploadable' => false,
			'comment_text' => 'Enter the exact username you want Followback.'
		],
		'like' => [
			'description' => 'Like',
			'isUploadable' => false,
			'comment_text' => 'Copy and paste the URL of the vine video you want liked. Please make sure the URL post you have enter is PUBLIC.'
		],
		'post' => [
			'description' => 'Post a Video 7 seconds',
			'isUploadable' => true,
			'comment_text' => 'Enter the exact caption you would like with your Vine video post.'
		],
		'comment' => [
			'description' => 'Comment',
			'isUploadable' => false,
			'comment_text' => 'Copy and paste the Vine video Url you want comment on. Provide some space and enter the desire comment you want written. Please make sure the URL post you have enter is PUBLIC.'
		],
	],

	'settings' => [
		'maximum_bids' => 50,
		'max_counterbids' => 3,
	]
];