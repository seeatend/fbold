$(document).ready(function(){
	$token = $('input[type=hidden][name=_token]');
	if($token.length>0){
		$.ajaxSetup({
			beforeSend: function(request) {
				return request.setRequestHeader('X-CSRF-Token', $token.first().attr('value'));
			},
		})
	}
});