@extends('layouts.admin')
@section('main_header', 'Bids')
@section('content')

<table class="StickyTable table table-striped" style="font-size:12px;">
	<thead>
		<tr style="text-align:center;">
			<th></th>
			<th>ID</th>
			<th>SENDER</th>
			<th class="wrap">RECEIVER</th>
			<th>SERVICE</th>
			<th>PRICE</th>
			<th class="wrap">INSTRUCTIONS</th>
			<th>STATUS</th>
			<th>Not Completed (Sender)</th>
			<th>Completed (Receiver)</th>
			<th>MEDIA</th>
			<th>DATE</th>
			<th>DELETE</th>
		</tr>
	</thead>
	<tbody>
		<?php $counter=1; ?>
		@foreach($bids as $bid)
		<tr>
			<td class="EntryNum"><?php echo $counter++; ?></td>
			<td class="EntryID">{{$bid->id}}</td>
			<td class="EntrySender">{{ (isset($bid->user->username) && !empty($bid->user->username)) ? $bid->user->username : ''}}</td>
			<td class="EntryReceiver">
				{{ (isset($bid->username) && !empty($bid->username)) ? $bid->username : ''}} (ID {{$bid->identifier}})
			</td>
			<td>{{--{{ $bid->service }}--}}{{ $bid->service_type }}</td>
			<td>{{$bid->present()->priceDecimal}}</td>
			<td><a href="#" class="View">View<div style="display: none;">
			<?php
				 $comment = htmlspecialchars($bid->comment);
					echo $comment;
				?>
			</div></a></td>
			<td>{{$bid->present()->status}}</td>
			{{--<td>
				@if(!empty($bid->orders))
					@if($bid->orders->first())
					{{ucfirst($bid->orders->first()->status)}}
					@endif
				@endif

			</td>--}}
			<td style="text-align:center; font-size: 30px; line-height: 1;">{{ ($bid->is_task_complete == 1) ? ' - ' : '*' }}</td>
			<td style="text-align:center; font-size: 30px; line-height: 1;">{{ ($bid->is_task_complete_by_receiver == 1) ? ' - ' : '*' }}</td>
			<td style="text-align:center;">

					<?php $file = $bid->file ?: null; ?>

					@if ($file)
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
                            
                              <p class="link-download" style="display: block; clear: both;">
                                <strong><a href="<?php echo $signedUrl; ?>" target="_blank" download="followback-{{ date('n-j-Y', strtotime($bid->updated_at)) }}-{{ $bid->findCreatorFollowbackUsername() }}.mp4">Download</a></strong>
                              </p>
                             <?php } ?>
													 </span>

					@else
						{{ '--' }}
					@endif
			</td>

			<td>{{ date('n/j/Y h:i A', strtotime ($bid->created_at)) }}</td>
			<td><a href="{{ route('admin_bid_delete',['id'=> $bid->id]) }}" class="btn btn-danger delete-bid">Delete</a> </td>
		</tr>
		@endforeach
	</tbody>
</table>
{!! $bids->render() !!}


<style>
.StickyTable thead.tableFloatingHeaderOriginal TH { background-color: #FFF; padding-top: 60px !important; }
.View { position: relative; }
.View DIV {  position: absolute; word-wrap:break-word; z-index: 100000; width: 400px; top: 0px; left: 0px; padding: 15px; border: 1px solid #999; background-color: #FFF; }
</style>



@stop






