<div class="act-sync-with">
	<span>ACCOUNT SYNCED WITH</span>
	<div class="profile-networks">
	    <?php 
	    	$serAccounts = Config::get('conservices');

	    	foreach ($serAccounts as $ser => $account): $ser = strtolower($ser); ?>
		    	<a class="icon-sync-{{$ser}} icon-sync">
		    		<?php echo HTML::image("assets/images/homepage/icon/$ser-icon.png", $alt="", $attributes = array()); ?>
		    	</a>
	    <?php endforeach; ?>
	</div>
	<span class="hold-url" style="display:none;">{{route('sync_accoount', array('service'=> $service, 'identifier' => $identifier))}}</span>
</div>