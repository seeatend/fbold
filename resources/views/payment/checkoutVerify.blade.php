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

  {{--
  "service_type" => "comment"
  "offer_price" => "10"
  "comment" => "(1) The URL of the public post to comment on: http://allankiezel.com (2) The desired comment to include: This guy is great!"
  "service" => "followback"
  "identifier" => "536"
  "avatar" => "/assets/images/homepage/facebook-avatar.png"
  "username" => "allankeyz"
  "url" => "/allankeyz/redirect/FollowbackAcc/?idf=536&img=/assets/images/homepage/facebook-avatar.png"
  "bid_type" => "bid"
  "file" => ""
  "bidder_id" => 535
  --}}

  <?php
  $comment = $bid->comment;
  $comment = preg_replace('/\(([0-9])\)(\s[^\(]*)/i','<p class="bid-instruction-box"><span class="numbered">$1</span>$2</p>',$comment);
  ?>
  <style>
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
      <div class="col-md-12 col-md-centered payment-info">        <p class="desc">
          Hi <strong>{{$bid->findCreatorFollowbackUsername()}}</strong>,<br><br>
          Are you trying to send a social task to
          <span style="color: #0068E1;"><strong>{{$bid->username}}</strong></span> to
          <span style="text-transform: capitalize; font-weight: bold;"> {{$bid->present()->service_type}} </span>
          @if($bid->present()->service === "Followback")
          @else
            on
            <span style="text-transform: capitalize; font-weight: bold;"> {{$bid->present()->service}} </span>
          @endif
          for
          <strong> {{$bid->present()->priceDecimal}} </strong> with the following instructions:
        </p>
        <br clear="all"/>

        <div class="bid-instruction-confirm" style="background: #FAFBFB; border: 1px solid #E8EAF2; padding: 30px;">
          <p><strong>Instructions:</strong></p>
          {!! $comment !!}
        </div>
        <br clear="all"/>

        <p>If this is correct, please click on the PayPal button below. This charge is only a preauthorization and you will not be charged unless the user accepts your social task.</p>

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
