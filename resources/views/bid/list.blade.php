@extends('layouts.simple')
@section('content')

  <?php

  use Followback\ServiceBid;

  $user = Sentry::getUser();
  $Photo = "";
  $signedUrl = "";
  

  ?>

  <div id="topbar_mobile" class="hidden-sm hidden-md hidden-lg container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-12">
        <div class="row">
          <div class="col-xs-9 col-sm-9 text-center">
            <div class="btn-group btn-group-justified">
              <div class="btn-group">
                <button type="button" class="active btn btn-default">Social Task</button>
              </div>
              <div class="btn-group">
                <button type="button" class="btn btn-default jump-earnings">Earnings</button>
              </div>
            </div>
          </div>
          <div class="col-xs-3 col-md-3">
           		
                
        <div class="dropdown pull-right">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Sort by
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 100%;">
            <li>
              <a href="{{route('bid_list', ['order_by' => 'date'])}}" style="color: #666">Recent</a>
            </li>
            <li>
              <a href="{{route('bid_list', ['order_by' => 'amount'])}}" style="color: #666">Amount</a>
            </li>
          </ul>
        </div>
      
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="desktop_topbar" class="container hidden-xs">
    <div class="row">
      <div class="col-md-3 col-sm-5">
        <!-- <h1 class="header1">Social Task</h1> -->
      </div>
      <div class="col-md-2 col-sm-2 col-md-offset-7 col-sm-offset-5">
        <div class="dropdown pull-right">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Sort by
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <li>
              <a href="{{route('bid_list', ['order_by' => 'date'])}}">Recent</a>
            </li>
            <li>
              <a href="{{route('bid_list', ['order_by' => 'amount'])}}">Amount</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="container" id="tasklist">
    <div class="row">
      @if(count($bids) > 0) 
      
      <?php
            
          $num = 0;
         
      ?>
      
        @foreach($bids as $bid)
          {{-- RECEIVED SOCIAL BIDS --}}
          
            <?php
            
            $message = str_replace("(2)","<br>(2)",$bid->comment);
            $num++;
            
            ?>
          
          @if($bid && $bid->is_hide_sender == 1)
            @if($user->id != $bid->bidder_id)
            
          
            
              <div class="social-task-item">
                <div class="task_inner">
                  <div class="row">
                    <div class="col-xs-12 col-md-3 text-center">
                    	 <span class="profile-avatar" style="background: url({{$bid->present()->creatorAvatar}}) center no-repeat; background-size: cover; display: inline-block; overflow: hidden; width: 50px; height: 50px; border-radius: 200px;"><img src="/assets/images/placeholder-avatar.png" class="img-circle"></span>
                    </div>
                    <div class="col-xs-12 col-md-9 text-center">
                      <h5 style="color: #000;">{{$bid->present()->creatorName}}</h5>
                      <?php
                      $display_msg = "";
                      $follow_per_name = '';
                      if ($bid->status == ServiceBid::STATUS_NEW) {
                        $display_msg = 'You received a request from ';
                      }
                      if ($bid->status == ServiceBid::STATUS_DENIED) {
                        $display_msg = "You denied a social task from ";
                      }
                      if ($bid->status == ServiceBid::STATUS_ACCEPTED) {
                        $display_msg = "You accepted a social task from ";
                      }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERED_BY_CREATOR
                      ) {
                        $display_msg = 'You received a social task counteroffer from ';
                      }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERED_BY_RECEIVER
                      ) {
                        $display_msg = "You sent a social task counteroffer to ";
                      }
                      if ($bid->service == 'instagram' &&
                        $bid->service_type == 'follow_back' &&
                        $bid->status == ServiceBid::STATUS_NEW
                      ) {
                        $display_msg = 'You received a request from ';
                      }

                      if ($bid->status == ServiceBid::STATUS_COMPLETED) {
                        $display_msg = 'Social task has been Completed';
                      }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERBID_ACCEPTED
                      ) {
                        $display_msg = 'You accepted a social task from';
                      }

                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERBID_DENIED
                      ) {
                        $display_msg = 'You denied a social task counteroffer from';
                      }

                      ?>
                      {{-- $bid->url --}}
                      <?php $socailUsername = $bid->findCreatorFollowbackUsername(
                      ); ?>

                      @if($bid->status == ServiceBid::STATUS_COUNTERED_BY_CREATOR)

                        <h6>You received a social task counteroffer to
                          <b>{{strtoupper($bid->present()->service_type)}}</b> for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @elseif($bid->status == ServiceBid::STATUS_COMPLETED)

                        <?php $socailUsername = $bid->findCreatorFollowbackUsername(
                        ); ?>

                        <h6>
                          <a href="{{ $bid->getCreatorSocialUrl() }}"> {{ $socailUsername }}'s </a> social task was accepted by you to
                          <b>{{strtoupper($bid->present()->service_type)}}</b> for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @elseif($bid->service == 'followback')

                        <?php $socailURL = $bid->getSenderFollowbackProfileUrl(
                        ); ?>
                        <?php $socailUsername = $bid->findCreatorFollowbackUsername(); ?>

                        <h6>{!! $display_msg !!}
                          <a href="{{ $socailURL }}" data-attr="{{ $socailURL }}" acc-type="followback" data-followback-href="{{ $socailURL }}"><span> {{ $socailUsername }}</span>
                          </a> to
                          <b>{{strtoupper($bid->present()->service_type)}}</b> for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @else

                        <?php $socailURL = $bid->getSenderFollowbackProfileUrl(
                        ); ?>
                        <?php $socailUsername = $bid->findCreatorFollowbackUsername(
                        ); ?>

                        <h6>{!! $display_msg !!}
                          <a href="{{ $socailURL }}" data-attr="{{ $socailURL }}" acc-type="followback" data-followback-href="{{ $socailURL }}">
                            <span> {{ $socailUsername }} </span>
                          </a>
                          to
                          <b>{{strtoupper($bid->present()->service_type)}}</b>
                          for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @endif

                    </div>
                  </div>
                  <div class="hidden-social-tasks hidden">
                    @if($bid->file)

                      <div class="row twocolumns">
                        <div class="column1 left-media-wrapper">
													 <span class="bid-media">
														 <?php
                             preg_match_all(
                               '~<a(.*?)href="([^"]+)"(.*?)>~',
                               $bid->present()->mediaForBidsList,
                               $matches
                             );
                             $img = array('jpg', 'png', 'gif');
                             $vid = array('mp4', 'mov', 'mpg', 'flv');
                             $ext = strtolower(
                               (isset($matches[2]) && !empty($matches[2])) ?
                                 pathinfo($matches[2][0], PATHINFO_EXTENSION) :
                                 ''
                             );

                             if(in_array($ext, $img)){
                             echo $bid->present()->mediaForBidsList;
                             $filename = $bid->file;
                             ?>
                             <p class="link-download" style="display: block; clear: both;">
                               <strong><a href="/file.php?file=<?Php echo $filename; ?>&Expires=<?php echo time(
                                   ) +
                                   100; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}-<?Php echo $filename; ?>">Download</a></strong>
                             </p>
                             <?php
                             } else {
                            
                            
                            $s3 = App::make('aws')->createClient('s3');
                             $file = explode('?', $bid->file);
                             $filename = basename($file[0]);
                             $getextension = explode('.', $filename);
                             $extension = $getextension[1];
                             $photofile = str_replace("mp4", "png", $filename);
                             
                           
										$cmd = $s3->getCommand('GetObject', [
											 'Bucket' => 'followback',
											 'Key'    => $filename
										]);

										$request = $s3->createPresignedRequest($cmd, '+20 minutes');
										$signedUrl = (string) $request->getUri();
                            
                             
                             if ($extension == "mp3") {
                               $Photo = "/assets/images/poster-audio.png";
                             } else {
                               $Photo = $s3->getObjectUrl(
                                 'followback',
                                 $photofile,
                                 '+10 minutes'
                               );
                             }
                           
                             ?>

                             <video poster="<?php echo $Photo; ?>" id="file{{ date('njYs', strtotime($bid->updated_at)) }}" class="bid-video video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" height="105" width="180" style="margin-left:auto;margin-right:auto;">
                               <source src="<?php echo $signedUrl; ?>">
                             </video>
                              <script>
                                videojs('file{{ date('njYs', strtotime($bid->updated_at)) }}', {"example_option": true}, function () {
                                });
                              </script>
                              <p class="link-download" style="display: block; clear: both;">
                                <strong><a href="/file.php?file=<?php echo $signedUrl; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}.mp4">Download</a></strong><span>File can't be downloaded on iPhone/iPad</span>
                              </p>
                             <?php } ?>
													 </span>
                        </div>
                        <div class="column2 comment-text-wrapper">
                          <div class="bid-instruction-container">
                            <strong>Social task instructions: </strong><br> {!! $message  !!}
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="row onecolumn">
                        <div class="column1 comment-text-wrapper">
                          <div class="bid-instruction-container">
                            <strong>Social task instructions: </strong><br> {!! $message  !!}
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                  {{-- TASK BUTTONS --}}
                  <?php echo Form::open(
                    [
                      'route' => ['bid_counter_by_receiver', $bid->id],
                      'class' => 'form-inline counterbid-form',
                      'id' => 'Form' . $bid->id
                    ]
                  ); ?>
                  <div class="row row-semi-margin-top task_btns_row">
                    <div class="col-xs-12 col-md-6 desktop_semi_padding_right">
                      <a href="#" class="btn btn-block btn-default show-instructions">Read Instruction</a>
                    </div>

                    @if($bid->bid_type == 'bid' && in_array($bid->status,[ServiceBid::STATUS_NEW, ServiceBid::STATUS_COUNTERED_BY_CREATOR]) && !Sentry::getUser()->hasBlockedUser($bid->user->id))
                      <div class="col-xs-12 col-md-6 desktop_semi_padding_left">
                        <a href="{{route('accept_bid_for_me',$bid->id)}}" class="btn btn-block btn-primary hidden_bid_id cleanbutton accept receiver-accept-bid-btn" data-message="You will have 24 hours to fulfill this social task. Once accepted, it cannot be canceled. If the social task is not fulfilled, you can be banned. Please do not accept any social task that you feel strongly in disagreement with based on values, content or affiliations. Are you sure you want to accept this social task?">Accept</a>
                      </div>
                    @endif

                  </div>
                  <div class="row row-semi-margin-top task_btns_row task_btns_second_row">
                    <div class="col-xs-12 col-md-4 desktop_semi_padding_right">
                      @if($bid->bid_type == 'bid' && in_array($bid->status,[ServiceBid::STATUS_NEW, ServiceBid::STATUS_COUNTERED_BY_CREATOR]) && !Sentry::getUser()->hasBlockedUser($bid->user->id))
                        @if($bid->status != ServiceBid::STATUS_DENIED)
                          <input type="text" class="form-control counterform counter-offer-input" style="display: none;" name='price' placeholder="Counter">
                          <a href="#" type="submit" class="btn btn-block btn-default cleanbutton counter counter-offer-btn receiver-counter-offer-btn" data-check="sender" data-attr="CounterOffer" data-form="Form<?php echo $bid->id; ?>" style="float: left; margin: 0;">Counter</a>
                          <input type="hidden" class="hidden_bid_amount" name="hiddenbidamount" value="{{$bid->present()->priceDecimal}}">
                        @endif
                      @endif
                    </div>
                    @if($bid->bid_type == 'bid' && in_array($bid->status,[ServiceBid::STATUS_NEW, ServiceBid::STATUS_COUNTERED_BY_CREATOR]) && !Sentry::getUser()->hasBlockedUser($bid->user->id))
                      <div class="col-xs-12 col-md-4 desktop_semi_padding">
                        <a  href="{{route('deny_bid_for_me',$bid->id)}}" class="btn btn-block btn-default cleanbutton accept" data-message="By pressing deny this will automatically cancel the bid. Are you sure you want to deny this counter?">Decline</a>
                      </div>
                    @endif
                    @if(!Sentry::getUser()->hasBlockedUser($bid->user->id))
                      @if($bid->status != ServiceBid::STATUS_ACCEPTED &&  $bid->status != ServiceBid::STATUS_COUNTERBID_ACCEPTED)
                        <div class="col-xs-12 col-md-4 desktop_semi_padding_left">
                          <a class="btn btn-block btn-default cleanbutton block block-user accept" data-message="Are you sure you want to block this user? You can always unblock them in the setting section." href="{{route('block_bids', $bid->user->id)}}">Block</a>
                        </div>
                      @endif
                    @else
                      User blocked.
                    @endif
                  </div>
                  <?php echo Form::close(); ?>
                </div>
              </div>

            @else

              {{-- SENT SOCIAL TASKS --}}

              <div class="social-task-item">
                <div class="task_inner">
                  <div class="row">
                    <div class="col-xs-12 col-md-3 text-center">
                      <span class="profile-avatar" style="background: url({{$bid->present()->findSenderAvatar()}}) center no-repeat; background-size: cover; display: inline-block; overflow: hidden; width: 50px; height: 50px; border-radius: 200px;"><img src="/assets/images/placeholder-avatar.png" class="img-circle"></span>
                    </div>
                    {{--{{ dd($bid) }}--}}
                    <div class="col-xs-12 col-md-9 text-center">
                      <h5 style="color: #000;">{{ $bid->present()->findSenderName() }}</h5>
                      <?php
                      $display_msg = "";
                      if ($bid->status == ServiceBid::STATUS_NEW) {
                        $display_msg = "You sent a social task to";
                      }
                      if ($bid->status == ServiceBid::STATUS_DENIED) {
                        $display_msg = "Your social task was denied by";
                      }
                      if ($bid->status == ServiceBid::STATUS_ACCEPTED) {
                        $display_msg = "Your social task was accepted by";
                      }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERED_BY_RECEIVER
                      ) {
                        $display_msg = 'Your social task was countered by ';
                      }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERED_BY_CREATOR
                      ) {
                        $display_msg = 'You countered a social task from';
                      }
                      // if($bid->service == 'instagram' && $bid->service_type == 'follow_back' && $bid->status == ServiceBid::STATUS_ACCEPTED) {
                      //     $display_msg = 'Your bid was accepted';
                      // }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERBID_ACCEPTED
                      ) {
                        $display_msg = 'You accepted a counter from';
                      }
                      // if($bid->status == ServiceBid::STATUS_BID_CANCELLED) {
                      //     $display_msg = 'You cancelled a bid of';
                      // }
                      if ($bid->status ==
                        ServiceBid::STATUS_COUNTERBID_DENIED
                      ) {
                        $display_msg = 'You denied the social task counteroffer for';
                      }

                      if ($bid->status == ServiceBid::STATUS_ACCEPTED &&
                        $bid->is_task_complete == 0
                      ) {

                        //$display_msg = "Your complaint of Task not completed has been registered againts";
                      }
                      ?>
                      {{-- $bid->url --}}
                      <?php $socailUsername = $bid->findCreatorFollowbackUsername(
                      ); ?>

                      @if($bid->status == ServiceBid::STATUS_COUNTERED_BY_RECEIVER)

                        <h6>{!! $display_msg !!}
                          <a href="{{ $bid->url }}">
                            <span>{{{$bid->username}}} </span>
                          </a>
                          to
                          <b>{{strtoupper($bid->present()->service_type)}}</b>
                          @if (!$bid->service == 'followback') on <b>{{$bid->present()->service}}</b> @endif
                          for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @elseif($bid->service == 'followback')

                        <?php $socailURL = $bid->getSenderFollowbackProfileUrl(
                        ); ?>
                        <?php $socailUsername = $bid->findReceiverSocialUsername(
                        ); ?>

                        <h6>{!! $display_msg !!}
                          <a href="{{ $bid->url }}"><span> {{ $socailUsername }}</span>
                          </a> to
                          <b>{{strtoupper($bid->present()->service_type)}}</b> for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @else

                        <?php $socailURL = $bid->getSenderFollowbackProfileUrl(
                        ); ?>
                        <?php $socailUsername = $bid->findReceiverSocialUsername(
                        ); ?>

                        <h6>{!! $display_msg !!}
                          <a href="{{ $bid->url }}">
                            <span> {{ $socailUsername }} </span>
                          </a>
                          to
                          <b>{{strtoupper($bid->present()->service_type)}}</b>
                          on
                          <strong> {{$bid->present()->service}} </strong>
                          for
                          <b>{{$bid->present()->priceDecimal}}</b></h6>

                      @endif

                    </div>
                  </div>
                  <div class="hidden-social-tasks hidden">
                    @if($bid->file)

                      <div class="row twocolumns">
                        <div class="column1 left-media-wrapper">
													 <span class="bid-media">
														 <?php
                             preg_match_all(
                               '~<a(.*?)href="([^"]+)"(.*?)>~',
                               $bid->present()->mediaForBidsList,
                               $matches
                             );
                             $img = array('jpg', 'png', 'gif');
                             $vid = array('mp4', 'mov', 'mpg', 'flv');
                             $ext = strtolower(
                               (isset($matches[2]) && !empty($matches[2])) ?
                                 pathinfo($matches[2][0], PATHINFO_EXTENSION) :
                                 ''
                             );

                             if(in_array($ext, $img)){
                             echo $bid->present()->mediaForBidsList;
                             $filename = $bid->file;
                             ?>
                             <p class="link-download" style="display: block; clear: both;">
                               <strong><a href="/file.php?file=<?Php echo $filename; ?>&Expires=<?php echo time(
                                   ) +
                                   100; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}-<?Php echo $filename; ?>" class="button">Download</a></strong>
                             </p>
                             <?php
                             } else {
										$s3 = App::make('aws')->createClient('s3');
                             $file = explode('?', $bid->file);
                             $filename = basename($file[0]);
                             $getextension = explode('.', $filename);
                             $extension = $getextension[1];
                             $photofile = str_replace("mp4", "png", $filename);
                             
                           
										$cmd = $s3->getCommand('GetObject', [
											 'Bucket' => 'followback',
											 'Key'    => $filename
										]);

										$request = $s3->createPresignedRequest($cmd, '+20 minutes');
										$signedUrl = (string) $request->getUri();
                     
                             
                             if ($extension == "mp3") {
                               $Photo = "/assets/images/poster-audio.png";
                             } else {
                               $Photo = $s3->getObjectUrl(
                                 'followback',
                                 $photofile,
                                 '+10 minutes'
                               );
                             }
                        
                             ?>

                             <video poster="<?php echo $Photo; ?>" id="file{{ date('njYs', strtotime($bid->updated_at)) }}" class="bid-video video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" height="105" width="180" style="margin-left:auto;margin-right:auto;">
                               <source src="<?php echo $signedUrl; ?>">
                             </video>
                              <script>
                                videojs('file{{ date('njYs', strtotime($bid->updated_at)) }}', {"example_option": true}, function () {
                                });
                              </script>
                              <p class="link-download" style="display: block; clear: both;">
                                <strong><a href="/file.php?file=<?php echo $signedUrl; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}.mp4" class="button">Download</a></strong><br><span>File can't be downloaded on iPhone/iPad</span>
                              </p>
                             <?php } ?>
													 </span>
                        </div>
                        <div class="column2 comment-text-wrapper">
                          <div class="bid-instruction-container">
                            <strong>Social task instructions: </strong><br> {!! $message  !!}
                          </div>
                        </div>
                      </div>
                    @else
                      <div class="row onecolumn">
                        <div class="column1 comment-text-wrapper">
                          <div class="bid-instruction-container">
                            <strong>Social task instructions: </strong><br> {!! $message  !!}
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                  {{-- TASK BUTTONS --}}
                  <?php echo Form::open(
                    [
                      'route' => ['bid_counter_by_creator', $bid->id],
                      'class' => 'form-inline counterbid-form',
                      'id' => 'Form' . $bid->id
                    ]
                  ); ?>

                  <div class="row row-semi-margin-top task_btns_row">
                    <div class="col-xs-12 col-md-6 desktop_semi_padding_right">
                      <a href="#" class="btn btn-block btn-default show-instructions">Read Instruction</a>
                    </div>
                    
   

                    @if($bid->status == ServiceBid::STATUS_NEW)

                    @elseif($bid->status == ServiceBid::STATUS_ACCEPTED)

                    @elseif($bid->status == ServiceBid::STATUS_DENIED)

                    @elseif($bid->status == ServiceBid::STATUS_COMPLETED)

                    @elseif($bid->status == ServiceBid::STATUS_COUNTERED_BY_RECEIVER)

                      <div class="col-xs-12 col-md-6 desktop_semi_padding_left">
                        <a href="{{route('counterbid_accept',$bid->id)}}" class="btn btn-block btn-primary hidden_bid_id cleanbutton accept custom-confirm-yes-no-paypal">Accept</a>
                        <input type="hidden" class="hidden_bid_amount" name="hiddenbidamount" value="{{$bid->present()->priceDecimal}}">
                      </div>
                      
                      
                      

                    @endif

                    <div class="col-xs-12 col-md-6 desktop_semi_padding_left">
                      @if($bid->status == ServiceBid::STATUS_ACCEPTED || $bid->status == ServiceBid::STATUS_COUNTERBID_ACCEPTED)
                        <a href="{{route('task_not_completed', $bid->id)}}" class="btn btn-block btn-default cleanbutton cancel accept" data-message="By pressing yes you will be notifying us and the user that this task has not been completed. Are you sure that this social task has not yet been completed?">Task Not Completed</a>
                      @elseif($bid->status != ServiceBid::STATUS_DENIED && $bid->status != ServiceBid::STATUS_COUNTERED_BY_RECEIVER && $bid->status != ServiceBid::STATUS_COUNTERBID_DENIED)
                        <a href="{{route('cancel_bid', $bid->id)}}" class="btn btn-block btn-default cleanbutton cancel cancel-bid accept" data-message="If you press yes, your bid will be automatically canceled and deleted. Are you sure you want to cancel this bid?">Cancel</a>
                      @endif
                    </div>

                  </div>
                  @if($bid->status == ServiceBid::STATUS_COUNTERED_BY_RECEIVER)
                    <div class="row row-semi-margin-top task_btns_row task_btns_second_row">
                      <div class="col-xs-12 col-md-4 desktop_semi_padding_right">
                        @if($bid->counterbids_count < DbConfig::get('bidServices.settings.max_counterbids'))
                          <input type="text" class="form-control counterform counter-offer-input" style="display: none;" name='price' placeholder="Counter">
                          <a href="#" type="submit" class="btn btn-block btn-default cleanbutton counter counter-offer-btn  receiver-counter-offer-btn" data-check="sender" data-attr="CounterOffer" data-form="Form<?php echo $bid->id; ?>" style="float: left; margin: 0;">Counter</a>
                        @endif
                      </div>
                      <div class="col-xs-12 col-md-4 desktop_semi_padding">
                        <a href="{{route('counterbid_deny',$bid->id)}}" class="btn btn-block btn-default cleanbutton accept" data-message="By pressing deny this will automatically cancel the bid. Are you sure you want to deny this counter?">Decline</a>
                      </div>
                      @if(!Sentry::getUser()->hasBlockedUser($bid->user->id))
                        @if($bid->status != ServiceBid::STATUS_ACCEPTED &&  $bid->status != ServiceBid::STATUS_COUNTERBID_ACCEPTED)
                          <div class="col-xs-12 col-md-4 desktop_semi_padding_left">
                            <a class="btn btn-block btn-default cleanbutton block block-user accept" data-message="Are you sure you want to block this user? You can always unblock them in the setting section." href="{{route('block_bids', $bid->user->id)}}">Block</a>
                          </div>
                        @endif
                      @else
                        User blocked.
                      @endif
                    </div>
                  @endif

                  <?php echo Form::close(); ?>
                </div>
              </div>

            @endif



          @endif
          
          <?php
          
          if($num%2 == 0){ echo "<div class='divider-two'></div>"; }
          if($num%3 == 0){ echo "<div class='divider-three'></div>"; }
          
          ?>
          
          
        @endforeach

      @else
        <div class="col-md-4">You have no Social Tasks.</div>
        <div class="clearfix" style="height: 50px;"></div>
      @endif
    </div>
  </div>
  <div class="clearfix" style="height: 100px;"></div>
  
 <a id="instructions-modal-trigger" href="#" data-toggle="modal" data-target="#instructions-modal"></a>
  <div id="instructions-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="box_close">
		    <span>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
		    </span>
      </div>
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <p class="success-message alert-success"></p>

              <p class="fail-error alert-danger" style="font-size: 12px"></p>

              <div id="ins-modal-content"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
  <div id="payments_block">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="header1">Earnings</h1>
        </div>
      </div>
      <div class="row earnings_table">
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12 text-center">
              <span class="header1 earnings_money">${{ $aggregatedBids['receive_bids'] }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center earnings_desc">
              Requests received
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12 text-center">
              <span class="header1 earnings_money">${{ $aggregatedBids['sent_bids'] }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center earnings_desc">
              Requests sent
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12 text-center">
              <span class="header1 earnings_money">${{ $aggregatedBids['accepted_bids'] }}</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center earnings_desc">
              Requests accepted
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12 text-center">
              <span class="header1 earnings_money">$0</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center earnings_desc">
              Donated to Charity
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

 
	
  <!-- /new section -->


  <style>
    .form-send-buttons .form-group {
      padding: 0 !important;
      margin-left: 10px !important;
      margin-right: 0 !important;
    }

    #ins-modal-content img {
      display: block;
      max-width: 100%;
      height: auto
    }
  </style>

@stop

@section('js_include')
  {{asset_javascript('plugins/bower/jquery.expander/jquery.expander.min.js')}}
@stop



@section('js_inline')

<style>
#tasklist H6  { line-height: 1.25em;  }
</style>
  <script>
  
  
  
  	$(".jump-earnings").click(function(){
  	
  	 var $target = $("#payments_block");
    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	       
	});
  		
  		return false;
  	
  	});
    $('.expand').expander({
      slicePoint: 80,
      expandText: 'More',
      userCollapseText: 'Less',
      expandEffect: 'fadeIn',
      collapseEffect: 'fadeOut'
    });

    $(".select-option").change(function () {
      var option = $(this).val();
      window.location.href = option;
    });

    $(".bid-row-show").click(function () {
      if ($(this).parent().parent().find(".hidden-social_tasks").is(":visible")) {
        $(this).parent().parent().find(".hidden-social_tasks").slideUp();
        $(this).html("View Instructions [+]");
      } else {
        $(this).parent().parent().find(".hidden-social_tasks").slideDown();
        $(this).html("Hide Instructions [&ndash;]");
      }
      return false;
    });

  </script>
@stop
