@extends('layouts.simple')
@section('content')
	<div id="sitemap">
		<div class="container">
			<div class="">
				<h3>Sitemap</h3>
				<span class="title-border"></span>
				<div class="col-md-12">
					<ul class="page-list">
						<li class="page_item"><a href="#"><span>Home</span></a></li>
						<li class="page_item"><a href="#"><span>About</span></a></li>
						<li class="page_item"><a href="#"><span>How it Works</span></a></li>
					</ul>
					<ul class="page-list">
						<li class="page_item page_item_child"><a href="#">Contact us</a></li>
						<li class="page_item page_item_child"><a href="#">Register</a></li>
						<li class="page_item page_item_child"><a href="#">Privacy</a></li>
					</ul>
					<ul class="page-list">
						<li class="page_item page_item_child"><a href="#">Sign in</a></li>
						<li class="page_item"><a href="#"><span>Support</span></a></li>	
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop