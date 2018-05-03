@include ('layouts.partials.marketing.header')
@if (isset($results))
  @include('marketing.partials.searchResults', ['results' => $results])
@endif
<section class="banner space">
  <div class="banner-background"></div>
  <div class="container">
      <div class="row">
          <div class="col-xs-12">
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
@include ('layouts.partials.marketing.footer')