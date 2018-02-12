@extends('layouts.simple')
@section('content')
  <style>
    .container p a {
      color: #0100fb;
    }

    .container p a:hover {
      color: #000;
    }
  </style>
    .numbered {
      background: #FFFFFF;
      border: 1px solid #E8EAF2;
      -webkit-border-radius: 50%;
      -moz-border-radius: 50%;
      border-radius: 50%;
      padding: 6px 12px;
    }

    .bid-instruction-confirm p {
      margin-bottom: 26px;
    }
  </style>
  <div class="payment-content container">
    <div class="row payment-row">
      <div class="masthead">
        <h1>
          Confirmation
        </h1>
      </div>
            <div class="col-md-12 col-md-centered payment-info">
        <p class="desc">
						Whew, we’re finally there <a href="{{route('profile_dashboard')}}"> {{$bid->present()->creatorSocialUsername()}} </a>
						Your payment of <strong> {{$bid->present()->priceDecimal}} </strong> has been received! We have notified
						<a target="_blank" href="{{$bid->url}}"> {{$bid->username}} </a> about your purchase.
			
			</p>

        <p>Thank you,<br> <strong> #TeamFollowback</strong></p>
       

        @include('payment.partials.checkoutInfo')

      </div>


    </div>
  </div>

@stop

@section('js_include')
@stop
