<?php $BASE_PATH = Config::get('otherconstants'); ?> 


@if(Sentry::check())

    <ul class="menulist">
		@include('layouts.partials.simple._header._menu')
    </ul>

@else
    @include('layouts.partials.homepage._header._navlogout')
   
    
@endif