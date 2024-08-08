@extends('themes.default.layouts.master')

@inject('home', 'App\Home')

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
            <h1 class="module-title">{{$module->name}}</h1>
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
      <div class="col-md-9 col-sm-12 py-sm-5">
        <div class="row">
          <div class="col-sm-3">
            <div class="nav flex-column nav-pills custom-vertical-tab" id="v-pills-tab" role="tablist"
              aria-orientation="vertical">
              <a class="nav-link active" id="v-pills-objective-tab" data-toggle="pill" href="#v-pills-objective"
                role="tab" aria-controls="v-pills-objective" aria-selected="false">Programme Overview</a>
              <a class="nav-link" id="v-pills-feature-tab" data-toggle="pill" href="#v-pills-feature" role="tab"
                aria-controls="v-pills-feature" aria-selected="false">Selected Madrasahs</a>
              <a class="nav-link" id="v-pills-trade-tab" data-toggle="pill" href="#v-pills-trade" role="tab"
                aria-controls="v-pills-trade" aria-selected="false">Selected Trade</a>
              <a class="nav-link" id="v-pills-courses-tab" data-toggle="pill" href="#v-pills-courses" role="tab"
                aria-controls="v-pills-courses" aria-selected="false">Achievements</a>
              <a class="nav-link" id="v-pills-datasheet-tab" data-toggle="pill" href="#v-pills-datasheet" role="tab"
                aria-controls="v-pills-datasheet" aria-selected="false">Project Data</a>
            </div>
          </div>
          <div class="col-sm-9">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="v-pills-objective" role="tabpanel"
                aria-labelledby="v-pills-objective-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "madrasah-project-overview");
                  @endphp
                  @if(!empty($module_post))
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div> <!-- .post-content -->
              </div> <!-- .objective -->
              <div class="tab-pane fade" id="v-pills-feature" role="tabpanel" aria-labelledby="v-pills-feature-tab">
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
              <div class="tab-pane fade" id="v-pills-trade" role="tabpanel" aria-labelledby="v-pills-trade-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page",
                  "madrasah-project-selected-trades");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-courses" role="tabpanel" aria-labelledby="v-pills-courses-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "madrasah-project-achievements");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="v-pills-datasheet" role="tabpanel" aria-labelledby="v-pills-datasheet-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "madrasah-project-data-sheet");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- .col-sm-9 -->
      <div class="col-md-3 d-md-block d-sm-none py-sm-5">
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
    </div> <!-- .row -->
  </div> <!-- .container-fluid -->
</section>
@endsection
