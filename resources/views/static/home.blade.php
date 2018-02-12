@extends('layouts.homepage')
@section('content')
  <section id="home-container">


    @include('partials._most-search-users')
    {{-- how-it-works --}}
    <div class="howitworks">
      <div class="container">
        <h1>
          <a target="_blank" href="{{ route('static_how_it_work_page')}}">How it works</a>
        </h1>
        <br>

        <div style="width: 100%; max-width: 700px; margin: 0 auto;">
          <div class="text-center flex-video video video-container">

            <iframe src="https://player.vimeo.com/video/127191731" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>

          </div>
        </div>

      </div>
    </div>

    <div class="clearfix" style="height: 30px;"></div>

  </section>

@stop