<div class="users">
  <div class="container">
    <h1>Popular verified users</h1>

    <div class="pull-right" style="display: none;">
      <a target="_blank" href="{{route('view_all_users')}}"></a>
      {{ HTML::linkRoute('view_all_users', 'View more', array(), array('class' => 'view-more','target' => '_self')) }}
    </div>
  </div>

  <div id="carousel">
    <a href="#" id="prev" class="pager prev"><i class="fa fa-chevron-left"></i></a>
    <a href="#" id="next" class="pager next"><i class="fa fa-chevron-right"></i></a>
    <ul class="slides">
      @foreach($users as $key => $user)

        @if($key <= '14')
          <?php
          $type = trim(strtolower($user->type));
          $username = str_replace(" ", "+", $user->name);
          $url = '/' . $username . '/redirect/FollowbackAcc/' . "?idf=" .
            $user->id . "&img=" . $user->image_url;
          ?>
          @if($type != 'followback')
            <?php $url = '/' . $username . '/' . trim($type) .
              '/redirect/otherSocialAcc/' . '?idf=' . $user->identifier .
              '&img=' . $user->image_url;?>
          @endif

          <li>

            <a target="_self" title="<?php echo $username;  ?>" class="profile-post" href="<?php echo $url;?>" data-attr="<?php echo '/' .
              $username . '/' . trim(
                $type
              );  ?>?idf={{$user->identifier}}&img={{$user->image_url}}" acc-type="{{ trim($type) }}" data-followback-href="<?php echo '/' .
              $username;  ?>?idf={{$user->identifier}}&img={{$user->image_url}}">
										<span class="ever-image">

											<div class="photo" style="height:90px; width:90px; border-radius: 50%; background: #000 url({{ $user->image_url }}) center center no-repeat; background-size: cover;"></div>

											<div class="social-icon">
                        {{ HTML::image("assets/images/homepage/carousel/$type.png", $alt="", $attributes = array()) }}
                      </div>
										</span>

              <div class="user-name">{{ $user->name }}</div>
            </a>

          </li>
        @endif
      @endforeach
    </ul>

  </div>


  <p style="line-height: 1.2em; display: block; text-align: left; margin: 0px auto 15px auto; max-width: 500px; text-align: center; padding: 0px 30px; width: 90%;">
    <a href="#" class="verify-email popup-link" style="color: #0100fb; font-weight: bold;"><u>Learn how to get verified</u></a>
  </p>

  <div class="clearfix" style="height: 1px;"></div>
</div>

