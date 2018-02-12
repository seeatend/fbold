<div class="row">
	<a class="btn btn-primary" data-toggle='collapse' href="#searchBar">Toggle Search Bar</a>
	<div class="col-xs-12 search-users collapse" id='searchBar'>
		<?php echo Form::open(['route'=>['admin_users_index'],'method' => 'GET']); ?>
	<?php echo Form::field([
			'name' => 'query',
			'label' => 'Search...',
			'placeholder' => true
		]); ?>
	<?php echo Form::field([
			'type' => 'select',
			'name' => 'type',
			'label' => 'Type',
			'placeholder' => true,
			'options' => $searchTypes
		]); ?>
		<button type="submit" class="btn btn-primary">Search</button>
		<?php echo Form::close(); ?>
	</div>
</div>