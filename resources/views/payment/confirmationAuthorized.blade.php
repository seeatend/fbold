@extends('layouts.simple')
@section('content')

  <style>
    .container p a {
      color: #0068E1;
    }

    .container p a:hover {
      color: #000;
    }
  </style>

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
          Confirmation
        </h1>
      </div>
      <div class="col-md-12 col-md-centered payment-info">
        <p class="desc">
          Congratulations,
          <strong>{{$bid->findCreatorFollowbackUsername()}}</strong>!<br><br>

          You have just sent a social task to
          <span style="color: #0068E1;"><strong>{{$bid->username}}</strong></span> to
          <span style="text-transform: capitalize; font-weight: bold;">{{$bid->present()->service_type}}</span>
          @if($bid->present()->service === "Followback")
          @else
            on
            <span style="text-transform: capitalize; font-weight: bold;"> {{$bid->present()->service}} </span>
          @endif
          for
          <strong> {{$bid->present()->priceDecimal}} </strong> with the following instructions. Users are not obligated to respond back to any social task sent to them.
        </p>
        <br clear="all"/>

        <div class="bid-instruction-confirm" style="background: #FAFBFB; border: 1px solid #E8EAF2; padding: 30px;">
          <p><strong>Instructions:</strong></p>
          {!! $comment !!}
        </div>
        <br clear="all"/>
        <p>Here at Followback, we believe that individuals should honor social tasks for a lifetime. Unfortunately, we cannot guarantee this. Therefore, we have a policy that social tasks must be continuously upheld for a minimum of thirty days in order to be credited with completion. Any social task that is not honored by this policy will be issued a refund. Please note standard paypal fees do apply.</p>

        <p>Thank you,<br> <strong> #TeamFollowback</strong></p>

        @include('payment.partials.checkoutInfo')

      </div>


    </div>
  </div>



@stop