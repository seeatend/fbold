$(document).ready(function(){
	var rules = getBaseRules();
	var details_placeholders = {
		'facebook': {
			"follow_back": "Enter the page or public username you want followed",
			"like": "Enter the URL of the post you want liked",
			"post": "Enter your desired comment (comment accuracy not guaranteed). You'll upload your Photo or Video on the next Page",
			"repost": "Enter the photo or video url you want shared, and your desired comment (comment accuracy not guaranteed)",
			"comment": "Enter the photo or video url you want commented on, and your desired comment (comment accuracy not guaranteed)",
			"accept_friend_request": "Enter the username you want accepted"
		},
		'instagram': {
			"like": "Enter the photo or video url you want liked",
			"post": "Enter your desired comment (comment accuracy not guaranteed). You'll upload your Photo or Video on the next Page",
			"repost": "Enter the photo or video url you want reposted, and your desired comment (comment accuracy not guaranteed)",
			"comment": "Enter the photo or video url you want commented on, and your desired comment (comment accuracy not guaranteed)",
			"promote_location": "Enter the address you want tagged with your photo or video, and your desired comment (comment accuracy not guaranteed). You'll upload your Photo or Video on the next Page",
			"accept_follow_request": "Enter the username you want accepted"
		},
		'twitter': {
			"follow_back": "Enter the username you want followed back",
			"tweet": "Enter the exact text for your Tweet. You can upload a Photo or Video on the next Page",
			"retweet": "Enter the tweet's url",
			"reply": "Enter the tweet's url you want replied to (answer accuracy not guaranteed)",
			"favorite": "Enter the URL of the tweet you want favorited",
			"promote_location": "Enter the address you want tagged with your photo or video, and your desired tweet (tweet accuracy not guaranteed). You'll upload your Photo or Video on the next Page",
			"accept_follow_request": "Enter the username you want accepted"
		}
	};

	var validatorOptions = {
		fields: {
			offer_price: {
				validators: rules
			}
		}
	};
	$('.bv-form').bootstrapValidator(validatorOptions);

	setOptions($('#bid_type').val());
	changeInput();
	setRules();
	setDetailsPlaceholder('follow_back');

	function changeInput () {
		var bidType = getBidType();
		var $input = $('input[name=offer_price]');
		var $stub = $('.fixed-price-stub');
		if(bidType === 'bid'){
			$input.val('');
			$input.show();
			$stub.addClass('hide');
		}
		else{
			var price = getPrice();
			setPrice();
			$input.hide();
			$stub.removeClass('hide').html('Pay $' + price + ' Now');
		}
	}

	function setOptions (type) {
		var $select = $('#service_type');
		$select.html($('#bidOptions').html());
	}
	function getBaseRules () {
		var rules = {
			notEmpty: {
				message: 'You must set your price.'
			},
			regexp: {
				regexp: /^\d+([\.,]\d+(\.\d+)?)?$/i,
				message: 'Price must be a number.'
			},
			greaterThan:{
				value: 0.00
			}
		};
		if(getBidType() == 'bid'){
			var price = getPrice();
			rules.greaterThan = {
				value: price,
				message: 'Price must be at least $'+price,
				inclusive: false
			};
		}
		return rules;
	}

	function setRules () {
		var rules = getBaseRules();
		if(getBidType() === 'bid'){
			var price = getPrice();
			rules.greaterThan.value = price;
			$('input[name=offer_price]').parents('.form-group').find('.help-block[data-bv-validator=greaterThan]').html('Price must be at least $'+price);
		}
		else {
			$('.bv-form').data('bootstrapValidator').updateStatus('offer_price', 'NOT_VALIDATED', null).validateField('offer_price');
		}
		$('.bv-form').data('bootstrapValidator').options.fields.offer_price.validators = rules;
	}

	//handler for service type change
	$('#service_type').on('change', function(){
		changeInput();
		setRules();
		setDetailsPlaceholder($(this).val());
	});

	function setDetailsPlaceholder (type) {
		$('textarea[name=comment]').attr('placeholder', details_placeholders[serviceType][type]);
	}
	/**
	 * gets bid type for currently selected service
	 * @return {string}
	 */
	function getBidType () {
		var service = $('#service_type').val();
		return $('#service_type option[value='+service+']').data('type');
	}

	function setPrice () {
		$('input[name=offer_price]').attr('value', getPrice());
	}

	function getPrice () {
		var serviceType = $('#service_type').val();
		
		var bidType = getBidType();

		var price = $('#service_type option[value='+serviceType+']').data('value');
		return price !== '' ? parseFloat(price).toFixed(2) : 0.01;
	}

	$('.create-bid-form button.submit').on('click', function(e){
		e.preventDefault();

		$('.create-bid-form').append('<input type="hidden" name="bid_type" value="'+getBidType()+'">');
		var validator = $('.create-bid-form').data('bootstrapValidator');
		if(validator.isValid()){
			validator.defaultSubmit();
		}

		validator.validate();
	});
});