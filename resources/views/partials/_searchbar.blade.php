 @if(count($searchOptions)>0)
<div class="row">
	<div class="col-xs-12 padding-20">
		{{Form::open([
			'route'=>'search_users', 
			'method'=>'GET', 
			'class'=>'form-search-users'])}}

		{{Form::field([
			'type' => 'select',
			'label' => 'Social Network Platform',
			'options' => $searchOptions,
			'name' => 'type',
			'class' => 'select-q-type'
			])}}

		{{Form::field([
			'name' => 'q',
			'label' => 'Search '.reset($searchOptions),
			'placeholder' => 'Account name...',
			'class' => 'input-q-text'
			])}}
			<div class="form-group">
				<div class="controls">
					<button class="btn btn-primary" type="submit">Search</button>

				</div>
			</div>
		{{Form::close()}}
	</div>
	
	<br/>
	<hr>
	<div class="col-xs-12 mlr30 search-result-inside">
		
	</div>
</div>

@section('js_include')
<!-- using handlebar js -->
{{asset_javascript('plugins/handlebars.js/handlebars.js')}}

@stop


@section('js_inline')
<script type="text/javascript">
	$(document).ready(function(){
		var serchRequestTimer;
		$('.input-q-text').on('keyup', function(){
			var $this = $(this),
			searchTerm = $this.val(),
			searchType = $(".select-q-type").val(),
			searchIcon = getSearchIcon(searchType),
			searchURL = $(".form-search-users").attr('action'),
			tpl = $("#search-user-list-template").html(),
			baseURL = '{{URL::to('/')}}',
			firsttime = 0;

			if(serchRequestTimer) clearTimeout(serchRequestTimer);

			if(searchType != '' && searchTerm != ''){
				serchRequestTimer = setTimeout(function(){
		            // send a ajax request.
					var xhr = $.ajax({
				        url: searchURL,
				        data: {q:searchTerm, type:searchType},
				        dataType: 'json',
				        localCache: true,
				        cacheTTL: 1,
				        cacheKey: 'search-' + searchType + '-' + searchTerm,
				        success: function(response) {
				        	if(response.valid === true){
				        		var template = Handlebars.compile(tpl);
					        	var html    = template({users:response.data, acc_type:searchType, acc_icon: searchIcon, baseURL: baseURL});
					            $(".search-result-inside").html(html);
				        	}
				        }
				    });
		        }, 1000);
			}
		});

		// function to get search icon.
		var getSearchIcon = function(type){

			var $res = 'defalut-icon';
			
			switch(type){
				case 'facebook':
					$res = 'facebook-icon';
				break;
				case 'instagram':
					$res = 'instagram-icon';
				break;
				case 'youtube':
					$res = 'youtube-icon';
				break;
				case 'twitter':
					$res = 'twitter-icon';
				break;
				case 'vine':
					$res = 'vine-icon';
				break;
			}

			return $res;
		}

	});
</script>
@stop

<!-- include tempaltes -->
@include('partials.handlebars.search-user-result')

@else
Your account is not linked to any social accounts. Connect one of them to make use of search engine.
@endif