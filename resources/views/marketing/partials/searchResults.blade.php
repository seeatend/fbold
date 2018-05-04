<div class="container">
    <div class="row">
        <div class="page-header"><h2>Search Results</h2></div>
        <ul style="padding: 10px 0px;">
            @forelse ($results['data'] as $user)
                <?php
                    $user['avatar'] = 'avatar.png';
                    $realname = !empty($user['name']) ? $user['name'] : $user['username']; 
                    $category =  !empty($user['category']) ? $user['category'] : '';
                    /* print_r($results); */

                    if($category == "actors-actresses"){ $category = "actors"; }
                    if($category == "ceos"){ $category = "CEOs"; }
                    $verified = DB::table('verified_users')->where('identifier',$user['identifier'])->first();
                    $social = DB::table('users_social_accounts')->where('user_id',$user['identifier'])->pluck('reach');
                ?>
                <li class="list-unstyled" style="padding: 5px 0px;">
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="{{ $user['avatar'] }}" alt="">
                        </a>
                      </div>
                      <div class="media-body">
                        <h4 class="media-heading" style="display: inline;">
                            <a href="/{{$user['username']}}">
                                {{ !empty($user['name']) ? $user['name'] : $user['username'] }}
                            </a>
                        </h4>
                        @if( trim($category) != "")#{{ $category }}  @if( $social != "")<br>@endif @endif
                        @if( $social != ""){{ $social }} Followers @endif
                      </div>
                    </div>
                </li>
            @empty
                No Search Results Found.
            @endforelse
        </ul>
        <hr />
    </div>
</div>