@extends('themes.default.layouts.master')

@inject('home', 'App\Home')
@inject('agent', 'Jenssegers\Agent\Agent')

@section("title", $module->name)
@section('m_title', $module->name)
@section('m_description', limiter(remove_html_char($module->description), 180))
@section('m_image', asset($module->picture))

@php
$module = isset($module) ? $module : null;
@endphp

@section("content")
<section class="module-section">
  <div class="module-banner">
    <div class="module-banner-img">
      <img src="{{asset($module->picture)}}" alt="{{$module->name}}" class="img-fluid">
    </div> <!-- .banner-img -->
    <div class="module-banner-caption">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <h1 class="module-title mt-sm-5  mb-sm-4">{{$module->name}}</h1>
            <div class="module-description d-none d-md-block">
              {!! $module->description !!}
            </div>
          </div> <!-- .col-sm-7 -->
        </div> <!-- .row -->
      </div>
    </div>
  </div>
</section> <!-- .module-section -->
<section class="content-section">
  <div class="container">
    <div class="row">
      <div class="col-md-9 col-sm-8 py-sm-5">
        <div class="row">
          <div class="col-sm-4">
            <div class="nav flex-column nav-pills custom-vertical-tab" id="v-pills-tab" role="tablist"
              aria-orientation="vertical">
              <a class="nav-link active" id="rental-terms-condition-tab" data-toggle="pill"
                href="#rental-terms-condition" role="tab" aria-controls="rental-terms-condition"
                aria-selected="false">Rental Terms & Condition</a>
              <a class="nav-link" id="fire-fighting-capabilities-tab" data-toggle="pill"
                href="#fire-fighting-capabilities" role="tab" aria-controls="fire-fighting-capabilities"
                aria-selected="false">Fire Fighting Capabilities</a>
              <a class="nav-link" id="business-center-facilities-tab" data-toggle="pill"
                href="#business-center-facilities" role="tab" aria-controls="business-center-facilities"
                aria-selected="false">Business Center Facilities</a>
              <a class="nav-link" id="idb-bhaban-tenant-list-tab" data-toggle="pill" href="#idb-bhaban-tenant-list"
                role="tab" aria-controls="idb-bhaban-tenant-list" aria-selected="false">IDB-Bhaban Tenant List</a>
              <a class="nav-link" id="contact-with-us-tab" data-toggle="pill" href="#contact-with-us" role="tab"
                aria-controls="contact-with-us" aria-selected="true">Contact with Us</a>
            </div>
          </div> <!-- .col-sm-4-->
          <div class="col-sm-8">
            <div class="tab-content" id="v-pills-tabContent">
              <div class="tab-pane fade show active" id="rental-terms-condition" role="tabpanel"
                aria-labelledby="rental-terms-condition-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "rental-terms-condition");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div> <!-- .post-content -->
              </div> <!-- .objective -->
              <div class="tab-pane fade" id="fire-fighting-capabilities" role="tabpanel"
                aria-labelledby="fire-fighting-capabilities-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page",
                  "fire-fighting-capabilities-of-idb-bhaban");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div> <!-- .post-content -->
              </div> <!-- .objective -->
              <div class="tab-pane fade" id="business-center-facilities" role="tabpanel"
                aria-labelledby="business-center-facilities-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "business-center-facilities");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="idb-bhaban-tenant-list" role="tabpanel"
                aria-labelledby="idb-bhaban-tenant-list-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "idb-bhaban-tenant-list");
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
              <div class="tab-pane fade" id="contact-with-us" role="tabpanel" aria-labelledby="contact-with-us-tab">
                <div class="post-content">
                  @php
                  $module_post = $home->get_module_post_by_slug($module->slug, 'page', 'contact-us');
                  @endphp
                  @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                  @endif
                </div>
              </div>
            </div>
          </div> <!-- .col-sm-8-->
        </div>
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
</section> <!-- .content-section -->
@endsection

@push('scripts')
<script>
  $(function () {
      let postContent = $(".post-content");
      postContent.find('img').addClass('img-fluid');
      postContent.find("table").addClass("table table-striped table-bordered");
    })
</script>
@endpush
