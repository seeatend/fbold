@extends('layouts.simple')
@section('content')
<div class="wrapper" id="about">
	<div class="masthead">
		<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{{ $title }}}</h1>
			</div>
		</div>
		</div>
	</div>
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="header">Here's how Followback Works</h2>
			
			
			<ol class="list-circles">
				<li><span>1</span>Sign up, it’s free!</li>

				<li><span>2</span> Pick a user you want to have Followback, like, post or comment on social media. You can also promote your Followback account on social media so people can send you offers for social tasks.</li>

				<li><span>3</span> After you find the user you're looking for, choose what type of social task you want completed. You have five options to choose from: Followback, Like, Post Media, Post Text or Comment. </li>

				<li><span>4</span> After picking the type of social task you want fulfilled, fill-in the instructions needed for the task to be carried out. For example, if you're choosing to have someone follow you back, add the username and social media platform you want them to follow you on.  </li>

				<li><span>5</span> Finally, consider how much are you willing to pay the user to complete the social task. Currently, our method of payment is Paypal but will be adding other methods of payment soon.</li>
			</ol>
			<p>All charges are pre-authorizations and your account will only be charged if your social task is accepted. In some cases, the pre-authorization can expire or become invalid due to insufficient funds.The minimum offer allowed for any social task is $5. If, for whatever reason, the social task is not fulfilled for the 30 day minimum, you will be issued a refund. Please keep in mind that there is a $0.30 non-deductible Paypal fee for all refunds.</p>
			
			<div class="clearfix" style=""height: 10px;"></div>

			<h2 class="header">Signing up</h2>
			<p>Signing up for Followback is free. Only registered users are searchable and can send and receive social tasks. After successfully signing up, you will receive a welcome email to verify your email address. You will not be able to receive your social task notifications or offers by email until you verify your email address.</p>
			<div class="clearfix" style=""height: 10px;"></div>

			<h2 class="header">For Senders</h2>
			<p>All social tasks sent using PayPal are only preauthorized transactions. This means that until the other party accepts your social task, money will not be deducted from your account. Preauthorizations can last up to 30 days in some cases, can expire or become invalid due to insufficient funds. The minimum bid for all social tasks is $5. Please note that standard Paypal fees (thirty cents per transaction) apply for refunds.</p>
			<div class="clearfix" style=""height: 10px;"></div>
			
			<h2 class="header">For Receivers</h2>
			<p>Senders will be preauthorized by Followback for social tasks in advance. Once a social task is accepted, the user will have 24 hours to fulfill it. If the social task is not fulfilled, the money will be refunded. Accepting a social task and not fulfilling it can lead to a user being banned from further use of Followback services. Please note: There is a 5-10% service fee per social task. This is used to cover the cost of running Followback and service fees are calculated based on each individual social task.</p>
			<p>At Followback, we believe that individuals should honor social tasks for a lifetime. Unfortunately, we cannot guarantee this. Therefore, we have a policy that social tasks must be continuously upheld for a minimum of 30 days in order to be credited with the completion of the social task. Any social task that is not honored by this policy will be issued a refund. Payments are sent on the 15th and 30th of each month. Individuals that receive higher than average volume of tasks can request immediate Paypal payment or bank transfers at <a href="mailto:Request@followback.com">Request@followback.com</a>.</p>

 
	
				<p style="text-align: center;"><strong>#TeamFollowback</strong></p>
		</div>	
	</div>
	</div>
</div>

@stop