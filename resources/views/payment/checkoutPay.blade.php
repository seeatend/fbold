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
          Checkout
        </h1>
      </div>
      <div class="col-md-12 col-md-centered payment-info">
        <p class="desc">
						Your payment of <strong>{{$bid->present()->priceDecimal}}</strong> is ready to be charged.
						The money will be taken immedietly out of your account and <a target="_blank" href="{{$bid->url}}">{{$bid->username}}</a>
						will be notified of your purchase. Please click the blue paypal button below to make your payment.
			
			</p>

        <p>Thank you,<br> <strong> #TeamFollowback</strong></p>
        <p class="paypal-center"><a class="paypal button-paypal" href="{{route('payment_make')}}">
          <ins class="fa fa-paypal"></ins>
          &nbsp; Paypal Checkout</a>
         </p>

        @include('payment.partials.checkoutInfo')

      </div>


    </div>
  </div>

@stop

@section('js_include')
@stop
