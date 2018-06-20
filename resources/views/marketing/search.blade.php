@include ('layouts.partials.marketing.header')
@if (isset($results))
  @include('marketing.partials.searchResults', ['results' => $results])
@endif
<section class="banner space">
  <div class="banner-background"></div>
  <div class="container">
      <div class="row">
          <div class="">
              <div class="content">
                  <h1>Search</h1>
                  <form action="/search-social-users" class="search-form-banner clearfix">
                      {{ csrf_field() }}
                      <input name="q" type="text" placeholder="Browse our community of everyday people, influencers & celebrities">
                      <input type="hidden" name="type" value="All">
                      <input id="SearchType" type="hidden" name="searchtype" value="All">
                      <i class="fas fa-search"></i>
                      <button type="submit">Search</button>
                  </form>
              </div>
          </div>
      </div>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
      <div class="">
        <h2 style="padding: 30px 0 5px; font-size: 30px; font-weight: 400;" class="text-center">
          Trending Searches
        </h2>
        
        <ul class="normal" style="padding-left: 0px;list-style: none; display: block; text-align: center; margin: 20px auto; line-height: 2.15em;">
          <li><a href="/sort/musician">#musician</a></li>
          <li><a href="/NickiMinaj">Nicki Minaj</a></li>
          <li><a href="/sort/tv">#tv</a></li>
          <li><a href="/KhloeKardashian">Khloe Kardashian</a></li>
          <li><a href="/followers/10M+">10 Million+ Followers</a></li>
          <li><a href="/Lala">Lala</a></li>
          <li><a href="/sort/athlete">#athlete</a></li>
          <li><a href="/FloydMayweather">Floyd Mayweather</a></li>
          <li><a href="/followers/5-10M">5-10 Millions+ Followers</a></li>
          <li><a href="/DJKhaled">DJ Khaled</a></li>
          <li><a href="/followers/1-5M">1-5 Millions+ Followers</a></li>
        </ul>

          <ul class="default" style="padding-left: 0px;list-style: none; display: block; text-align: center; margin: 20px auto; line-height: 2.15em;">
              <li><a href="/sort/musician">Musicians</a></li>
              <li class="/sort/radio"><a href="/NickiMinaj">Radio host</a></li>
              <li class="/sort/tv"><a href="/sort/tv">Tv persoanlities</a></li>
              <li class="/sort/dj"><a href="/KhloeKardashian">djs</a></li>
              <li><a href="/sort/model">models</a></li>
              <li class="/sort/athlete"><a href="/Lala">athletes</a></li>


          </ul>
      </div>
    </div>
  </div>
</section>
@include ('layouts.partials.marketing.footer')