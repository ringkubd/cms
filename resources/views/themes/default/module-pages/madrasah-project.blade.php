@extends('themes.default.layouts.master')

@inject('home', 'App\Home')
@inject('agent', 'Jenssegers\Agent\Agent')

@section("title", $module->name)
@section('m_title', $module->name)
@section('m_description', limiter(remove_html_char($module->description), 180))
@section('m_image', asset($module->picture))

@section('content')
<section class="module-section">
  <div class="module-banner">
    <div class="module-banner-img">
      <img src="{{asset($module->picture)}}" alt="{{$module->name}}" class="img-fluid">
    </div> <!-- .banner-img -->
    <div class="module-banner-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-7">
            <h1 class="module-title">{{$module->name}}</h1>
            <div class="module-description d-none d-md-block">
              {!! $module->description !!}
            </div>
          </div> <!-- .col-sm-7 -->
        </div> <!-- .row -->
        <div class="row">
          <div class="col-md-5">
            <table class="m-0 table">
              <tr>
                <td>Inception</td>
                <td>{{date("Y", strtotime($module->start_form) )}}</td>
                <td style="width: 40%" rowspan="3" class="text-center">
                  <label>
                    <input type="text" class="knob d-none" value="93" data-value="93" data-min="0" data-max="100"
                      data-suffix="%" disabled>
                  </label>
                  <div class="knob-label">Passing Rate in Dakhil(voc.) Exam</div>
                </td>
              </tr>
              <tr>
                <td># of Madrasahs</td>
                <td>6</td>
              </tr>
              <tr>
                <td class="align-baseline">Beneficiaries</td>
                <td class="align-baseline">26,400</td>
              </tr>
            </table>
          </div> <!-- .col-sm-5 -->
        </div> <!-- .row -->
      </div>
    </div>
  </div>
  </div>
</section>
<section class="content-section">
  <div class="container">
    <div class="row">
      @if(!$agent->isMobile())
      <div class="col-md-3  py-sm-5">
        <div class="sidebar-widget mb-4">
          <h2 class="widget-title"><span>Related Topics</span></h2>
          <ul class="widget-list">
            @php
            $related_posts = $home->get_module_page_by_module_slug($module->slug);
            @endphp
            @foreach($related_posts as $r_posts)
            @php
            $r_posts = isset($r_posts) ? $r_posts : null;
            if($r_posts->post_format !== "individual"){
            $link = url($r_posts->post_format."/".$r_posts->post_slug);
            }else{
            $link = url($r_posts->post_slug);
            }
            @endphp
            <li class="item">
              <a class="item-link" href="{{$link}}">{{$r_posts->post_title}}</a>
            </li>
            @endforeach
          </ul>
        </div> <!-- .sidebar-widget -->
      </div> <!-- .col-sm-3 -->
      @endif
      <div class="col-md-6 col-sm-8 py-sm-5">
        <div class="intro-news-filter d-flex">
          <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active show" id="latest-updates-tab" data-toggle="tab" href="#latest-updates"
                role="tab" aria-controls="latest-updates" aria-selected="false">Latest Updates</a>
              <a class="nav-item nav-link" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                aria-controls="overview" aria-selected="false">Overview</a>
              <a class="nav-item nav-link" id="selected-madrasahs-tab" data-toggle="tab" href="#selected-madrasahs"
                role="tab" aria-controls="selected-madrasahs" aria-selected="false">Selected Madrasahs</a>
              <a class="nav-item nav-link" id="selected-trade-tab" data-toggle="tab" href="#selected-trade" role="tab"
                aria-controls="selected-trade" aria-selected="false">Selected Trade</a>
              <a class="nav-item nav-link" id="achievements-tab" data-toggle="tab" href="#achievements" role="tab"
                aria-controls="achievements" aria-selected="false">Achievements</a>
              <a class="nav-item nav-link" id="programme-data-tab" data-toggle="tab" href="#programme-data" role="tab"
                aria-controls="programme-data" aria-selected="false">Programme Data</a>
            </div>
          </nav>
        </div> <!-- .intro-news-filter -->
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="latest-updates" role="tabpanel"
            aria-labelledby="latest-updates-tab">
            <div class="row">
              @php
              $latestPosts = $home->get_posts_by_single_cats('latest-update',5, $module->slug);
              @endphp
              @if($latestPosts->isNotEmpty())
              @foreach($latestPosts as $latest)
              @php
              $latest = isset($latest) ? $latest : null;
              $picture = empty($latest->post_thumb) ? $latest->module->picture : $latest->post_thumb;
              $picture = thumbs_url($picture);
              @endphp
              @if($loop->iteration < 3) <div class="col-sm-6">
                <div class="single-blog-post style-2" title="{{$latest->post_title}}">
                  <a href="{{url("{$latest->post_type}/{$latest->id}/{$latest->post_slug}")}}"
                    class="overlay-style-block">
                    <div class="blog-thumbnail overlayable" style="background-image: url('{{asset($picture)}}')">
                    </div>
                  </a><!-- Blog Thumbnail -->
                  <div class="blog-content overlayable-content">
                    <span class="post-date">@datetime($latest->updated_at)</span>
                    <a href="{{url("{$latest->post_type}/{$latest->id}/{$latest->post_slug}")}}" class="post-title">
                      {{$latest->post_title}}
                    </a>
                    <div class="content-text">
                      <p>{{word_limiter($latest->post_excerpt, 12)}}</p>
                    </div>
                  </div> <!-- .blog-content -->
                </div>
            </div> <!-- .col-sm-6 -->
            @else
            <div class="col-sm-12">
              <div class="single-blog-post d-flex style-4 @if($loop->last) mb-0 @endif" title="{{$latest->post_title}}">
                <!-- Blog Thumbnail -->
                <div class="blog-thumbnail">
                  <a href="{{url("{$latest->post_type}/{$latest->id}/{$latest->post_slug}")}}">
                    <img src="{{asset($picture)}}" alt="{{$latest->post_slug}}">
                  </a>
                </div>
                <!-- Blog Content -->
                <div class="blog-content">
                  <span class="post-date">@datetime($latest->updated_at)</span>
                  <a href="{{url("{$latest->post_type}/{$latest->id}/{$latest->post_slug}")}}" class="post-title">
                    {{$latest->post_title}}
                  </a>
                  <p>{{word_limiter($latest->post_excerpt, 16)}}</p>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @endif
          </div> <!-- .row -->
          <a href="{{url("latest-updates?type=madrasah-education-programme")}}" class="btn btn-main btn-sm my-2"
            title="More"> More </a>
        </div> <!-- latest -->
        <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page",
            "madrasah-education-programme-overview");
            @endphp
            @if(!empty($module_post))
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div> <!-- .post-content -->
        </div> <!-- .objective -->
        <div class="tab-pane fade" id="selected-madrasahs" role="tabpanel" aria-labelledby="selected-madrasahs-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page", "selected-madrasahs");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="selected-trade" role="tabpanel" aria-labelledby="selected-trade-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug('four-year-diploma-scholarship', "page",
            "madrasah-education-programme-selected-trades");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="achievements" role="tabpanel" aria-labelledby="achievements-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page",
            "madrasah-education-programme-achievements");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="programme-data" role="tabpanel" aria-labelledby="programme-data-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page",
            "madrasah-education-programme-data-sheet");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
      </div> <!-- .tab-content -->
    </div> <!-- .col-sm-6 -->
    <div class="col-md-3 py-sm-5">
      @php
      $notices = $home->get_posts_by_single_cats('notice',10, $module->slug);
      @endphp
      @if($notices->isNotEmpty())
      <div class="sidebar-widget mb-4">
        <h2 class="widget-title"><span>Notice</span></h2>
        <div class="news-event-card" style="height: 300px;">
          <ul class="news-list">
            @foreach($notices as $notice)
            @php
            $notice = isset($notice) ? $notice : "";
            $link = url($notice->post_type."/notice/".$notice->id."/".$notice->post_slug);
            @endphp
            <li>
              <a href="{{$link}}">{{$notice->post_title}}</a>
              <span>@datetime($notice->updated_at)</span>
            </li>
            @endforeach
          </ul> <!-- .news-list -->
        </div> <!-- .news- and events -->
        <a href="{{url("notice?type={$module->slug}")}}" title="More notice"> More notice</a>
      </div>
      @endif
      <div class="sidebar-widget">
        {!! vocational_apply_widget() !!}
      </div> <!-- .sidebar-widget -->
    </div> <!-- .col-sm-3 -->
    @if($agent->isMobile())
    <div class="col-md-3  py-sm-5">
      <div class="sidebar-widget mb-4">
        <h2 class="widget-title"><span>Related Topics</span></h2>
        <ul class="widget-list">
          @php
          $related_posts = $home->get_module_page_by_module_slug($module->slug);
          @endphp
          @foreach($related_posts as $r_posts)
          @php
          $r_posts = isset($r_posts) ? $r_posts : null;
          if($r_posts->post_format !== "individual"){
          $link = url($r_posts->post_format."/".$r_posts->post_slug);
          }else{
          $link = url($r_posts->post_slug);
          }
          @endphp
          <li class="item">
            <a class="item-link" href="{{$link}}">{{$r_posts->post_title}}</a>
          </li>
          @endforeach
        </ul>
      </div> <!-- .sidebar-widget -->
    </div> <!-- .col-sm-3 -->
    @endif
  </div> <!-- .row -->
  </div> <!-- .container-fluid -->
</section>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
  integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
  integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"
  integrity="sha256-2144q+NOM/XU6ZxSqRTJ8P0W/CkY6zXc6mXYt4+mF9s=" crossorigin="anonymous"></script>
<script src="{{ asset("themes-assets/default/js/jquery-knob/knob-helper.js") }}"></script>
<script>
  (function ($) {
      let postContent = $(".post-content");
      postContent.find('img').addClass('img-fluid');
      postContent.find("table").addClass("table table-striped table-bordered");
      knob_init('.knob');
    }(jQuery));
</script>
@endpush
