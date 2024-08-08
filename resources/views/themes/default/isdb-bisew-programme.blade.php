@extends('themes/default/layouts/master')

@inject("home", "App\Home")

@section('title', 'Latest news of IsDB-BISEW')
@section('m_title', limiter($home->get_settings('meta_title'), 90))
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section("content")
<section class="module-section">
  <div class="module-banner">
    <div class="module-banner-img">
      @php $metaPic = $home->get_settings("meta_picture"); @endphp
      <img src="{{asset($metaPic)}}" alt="IsDB-BISEW PROGRAMME" class="img-fluid">
    </div> <!-- .banner-img -->
    <div class="module-banner-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1 class="module-title mt-sm-5 mb-sm-4">IsDB-BISEW PROGRAMME</h1>
            <div class="module-description hidden-xs">
              {{ $home->get_settings("meta_desc") }}
            </div>
          </div> <!-- .col-sm-7 -->
        </div> <!-- .row -->
      </div>
    </div>
  </div>
</section>
<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-7 py-3">
        @foreach($programmes as $programme)
        <div class="module-media-card mb-4 shadow-sm" title="{{$programme->name}}">
          <div class="row">
            <div class="col-sm-4">
              <div class="module-media-card-thumbnail">
                <img src="{{asset($programme->picture)}}" class="img-fluid" alt="{{$programme->name}}">
              </div>
            </div>
            <div class="col-sm-8">
              <div class="module-media-card-body">
                <h2 class="module-media-card-title">{{$programme->name}}</h2>
                @if($programme->start_form)
                <p class="post-date">Inception {{date("Y", strtotime($programme->start_form) )}}</p>
                @endif
                {!! word_limiter($programme->description, 35) !!}
              </div>
              <div class="module-media-card-footer">
                @if($programme->slug !== "other-programme")
                <a href="{{url($programme->slug)}}" class="btn-link">Details</a>
                @endif
              </div>
            </div>
          </div> <!-- .col-sm-6 -->
        </div> <!-- .row -->
        @endforeach
        <div class="row">
          <div class="col-sm-12">
            {{$programmes->links()}}
          </div>
        </div>
      </div> <!-- .col-sm-9 -->
      <div class="col-md-3 col-sm-5 py-3">
        <h1 class="area-title">
          <span class="title-text">News and Events</span>
        </h1>
        <div class="news-event-card mb-4">
          <ul class="news-list">
            @php
            $notices = $home->get_posts_by_multiple_category(['notice','events','update'], 15);
            @endphp
            @foreach($notices as $notice)
            @php
            $notice = isset($notice) ? $notice : "";
            $link = url($notice->post_type."/notice/".$notice->id."/".$notice->post_slug);
            @endphp
            <li>
              <a href="{{$link}}">{{$notice->post_title}}</a>
              <span>@datetime($notice->updated_at) | {{$notice->module_name}}</span>
            </li>
            @endforeach
          </ul> <!-- .news-list -->
        </div>

        <div class="sidebar-widget">
          {!! it_scholarship_widget() !!}
        </div> <!-- .sidebar-widget -->
        <div class="sidebar-widget">
          {!! vocational_apply_widget() !!}
        </div> <!-- .sidebar-widget -->
      </div> <!-- .col-sm-3 -->
    </div> <!-- .row -->
  </div> <!-- .container -->
</section>
@endsection
