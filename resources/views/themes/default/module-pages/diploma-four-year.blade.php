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
          <div class="col-md-6">
            <h1 class="module-title mt-sm-5">{{$module->name}}</h1>
            <h4 class="inception mb-sm-5">Inception {{date("Y", strtotime($module->start_form) )}}</h4>
            <div class="module-description d-none d-md-block">
              {!! $module->description !!}
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
      @if(!$agent->isMobile())
      <div class="col-md-3 py-sm-5">
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
              <a class="nav-item nav-link" id="objectives-tab" data-toggle="tab" href="#objectives" role="tab"
                aria-controls="objectives" aria-selected="false">Objectives</a>
              <a class="nav-item nav-link" id="project-datasheet-tab" data-toggle="tab" href="#project-datasheet"
                role="tab" aria-controls="project-datasheet" aria-selected="false">Project Datasheet</a>
              <a class="nav-item nav-link" id="selected-area-tab" data-toggle="tab" href="#selected-area" role="tab"
                aria-controls="selected-area" aria-selected="false">Selected Area</a>
              <a class="nav-item nav-link" id="financial-assistance-tab" data-toggle="tab" href="#financial-assistance"
                role="tab" aria-controls="financial-assistance" aria-selected="false">Financial Assistance</a>
              <a class="nav-item nav-link" id="job-placement-assistance-tab" data-toggle="tab"
                href="#job-placement-assistance" role="tab" aria-controls="job-placement-assistance"
                aria-selected="false">Job Placement Assistance</a>
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
              $picture = empty($latest->post_thumb) ? $latest->module_picture : $latest->post_thumb;
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
          <a href="{{url("latest-updates?type=four-year-diploma-scholarship")}}" class="btn btn-main my-2" title="More">
            More
            updates </a>
        </div> <!-- latest -->
        <div class="tab-pane fade" id="objectives" role="tabpanel" aria-labelledby="objectives-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page",
            "four-year-diploma-scholarship-project");
            @endphp
            @if(!empty($module_post))
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div> <!-- .post-content -->
        </div> <!-- .objective -->
        <div class="tab-pane fade" id="project-datasheet" role="tabpanel" aria-labelledby="project-datasheet-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page", "diploma-project-datasheet");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="selected-area" role="tabpanel" aria-labelledby="selected-area-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page", "diploma-project-selected-area");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="financial-assistance" role="tabpanel" aria-labelledby="financial-assistance-tab">
          <div class="post-content">
            @php
            $module_post = $home->get_module_post_by_slug($module->slug, "page",
            "diploma-project-financial-assistance");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="job-placement-assistance" role="tabpanel"
          aria-labelledby="job-placement-assistance-tab">
          <div class="post-content">
            @php
            $module_post = App\Home::get_module_post_by_slug($module->slug, "page",
            "diploma-project-job-placement-assistance");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
      </div> <!-- .tab-content -->
    </div> <!-- .col-sm-9 -->
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
        {!! it_scholarship_widget() !!}
      </div> <!-- .sidebar-widget -->
      <div class="sidebar-widget">
        {!! vocational_apply_widget() !!}
      </div> <!-- .sidebar-widget -->
    </div> <!-- .col-sm-3 -->
    @if($agent->isMobile())
    <div class="col-md-3 py-sm-5">
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

@push('scripts')
<script>
  $(function () {
      let postContent = $(".post-content");
      postContent.find('img').addClass('img-fluid');
      postContent.find('table').addClass('table table-striped table-bordered');
    })
</script>
@endpush
