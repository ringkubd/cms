@extends('themes.default.layouts.master')

@inject('home', 'App\Home')
@inject('carbon', 'Illuminate\Support\Carbon')
@inject('agent', 'Jenssegers\Agent\Agent')

@section("title", $module->name)
@section('m_title', $module->name)
@section('m_description', limiter(remove_html_char($module->description), 180))
@section('m_image', asset($module->picture))

@php
  $now = $carbon->now();
  $end_date = $carbon->create($intake->end_date)->addHour(23)->addMinute(59);
  $isIntake = $now->lessThanOrEqualTo($end_date);
@endphp

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
            </div> <!-- .col-sm-6 -->
          </div> <!-- .row -->
          <div class="row">
            <div class="col-md-5">
              <table class="m-0 table">
                <tr>
                  <td style="width: 30%">Inception</td>
                  <td style="width: 30%">{{date("Y", strtotime($module->start_form) )}}</td>
                  <td style="width: 40%" rowspan="2" class="text-center">
                    <label>
                      <input type="text" class="knob d-none" value="92" data-value="92" data-min="0" data-max="100"
                             data-suffix="%" disabled>
                    </label>
                    <div class="knob-label">Job placement</div>
                  </td>
                </tr>
                <tr>
                  <td class="align-baseline">Beneficiaries</td>
                  <td class="align-baseline">1,103</td>
                </tr>
              </table>
            </div> <!-- .col-sm-5 -->
          </div> <!-- .row -->
        </div>
      </div>
    </div>
  </section> <!-- module-section -->
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
                <a class="nav-item nav-link" id="objectives-tab" data-toggle="tab" href="#objectives" role="tab"
                   aria-controls="objectives" aria-selected="false">Objectives</a>
                <a class="nav-item nav-link" id="unique-features-tab" data-toggle="tab" href="#unique-features" role="tab"
                   aria-controls="unique-features" aria-selected="false">Unique Features</a>
                <a class="nav-item nav-link" id="courses-tab" data-toggle="tab" href="#courses" role="tab"
                   aria-controls="courses" aria-selected="false">Courses</a>
                <a class="nav-item nav-link" id="programme-data-tab" data-toggle="tab" href="#programme-data" role="tab"
                   aria-controls="programme-data" aria-selected="false">Programme Data</a>
                @if($isIntake)
                  <a class="nav-item nav-link" id="intake-status-tab" data-toggle="tab" href="#intake-status" role="tab"
                     aria-controls="intake-status" aria-selected="false">Intake Status</a>
                @endif
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
                    @if($loop->iteration < 3)
                      <div class="col-sm-6">
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
                              <p>{{limiter($latest->post_excerpt, 70)}}</p>
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
                            <p>{{limiter($latest->post_excerpt, 100)}}</p>
                          </div>
                        </div>
                      </div>
                    @endif
                  @endforeach
                @endif
              </div> <!-- .row -->
              <a href="{{url("latest-updates?type=vocational-training-programme")}}" class="btn btn-main my-2" title="More">
                More </a>
            </div> <!-- latest -->
            <div class="tab-pane fade" id="objectives" role="tabpanel" aria-labelledby="objectives-tab">
              <div class="post-content">
                @php
                  $module_post = $home->get_module_post_by_slug($module->slug, "page", "objectives-of-vocational-training");
                @endphp
                @if($module_post)
                  <h3>{{$module_post->post_title}}</h3>
                  {!! $module_post->post_content !!}
                @endif
              </div> <!-- .post-content -->
            </div> <!-- .objective -->
            <div class="tab-pane fade" id="unique-features" role="tabpanel" aria-labelledby="unique-features-tab">
              <div class="post-content">
                @if($home->get_single_post(43))
                  <h3>{{$home->get_single_post(43)->post_title}}</h3>
                  {!! $home->get_single_post(43)->post_content !!}
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
              <div class="course-media d-flex">
                <div class="course-media-picture">
                  <img src="{{asset('themes-assets/default/img/bg-img/courses/vt/electricity-logo.jpg')}}"
                       alt="Electrical Works">
                </div>
                <div class="course-media-content">
                  <h3>Electrical Trade</h3>
                  <p>
                    Basic Electrical and Electronics, Electrical House wiring,
                    Electrical Connection of Motor, Motor Rewinding Machine/Motor, Control Circuit Electrical, Home
                    Appliances
                    Maintenance of Sub-Station Equipment, On the Job Training (OJT).
                  </p>
                </div>
              </div> <!-- course-media -->
              <div class="course-media d-flex">
                <div class="course-media-picture">
                  <img src="{{asset('themes-assets/default/img/bg-img/courses/vt/electronics.png')}}"
                       alt="Electronics Trade">
                </div>
                <div class="course-media-content">
                  <h3> Electronics Trade</h3>
                  <p>
                    Basic Electrical and Electronics, Electronics Hobby Circuits, Color Television (CRT, LCD, LED),
                    Mobile Phone
                    Troubleshooting, Electrical Home Appliances, Industrial Electronics Equipment, OJT.
                  </p>
                </div>
              </div> <!-- course-media -->
              <div class="course-media d-flex">
                <div class="course-media-picture">
                  <img src="{{asset('themes-assets/default/img/bg-img/courses/vt/mechanic.jpg')}}" alt="Machinist Trade">
                </div>
                <div class="course-media-content">
                  <h3> Machinist Trade</h3>
                  <p>
                    Bench Work (Filling, Sawing & Sheet Metal Fabrication), Measuring, Inspection, Non-Precision
                    Grinding Machine
                    (Portable Grinding & Bench Grinding), Drill Machine, Power Hack-Saw Machine, Lathe Machine, Shaper
                    Machine, Milling
                    Machine, Precision Grinding Machine, OJT.
                  </p>
                </div>
              </div> <!-- course-media -->
              <div class="course-media d-flex">
                <div class="course-media-picture">
                  <img src="{{asset('themes-assets/default/img/bg-img/courses/vt/air-conditioning.jpg')}}"
                       alt="Refrigeration & Air-conditioning Trade">
                </div>
                <div class="course-media-content">
                  <h3> Refrigeration & Air-conditioning Trade</h3>
                  <p>
                    Frost & Non-Frost Type Refrigerator, Chest Type Freezer, Water & Beverage Cooler, Window Type AC,
                    Split Type AC,
                    Water Chiller, Auto Car Air conditioning and Auto Van Refrigeration, Central AC Plant, OJT.
                  </p>
                </div>
              </div> <!-- course-media -->
              <div class="course-media d-flex">
                <div class="course-media-picture">
                  <img src="{{asset('themes-assets/default/img/bg-img/courses/vt/welding-fabrication.jpg')}}"
                       alt="Welding & Fabrication Trade">
                </div>
                <div class="course-media-content">
                  <h3> Welding & Fabrication Trade</h3>
                  <p>
                    Electric Arc Welding 1G - 4G Position, Electric Arc Pipe Welding 6G Position, Gas Welding & Gas
                    Cutting, Mig
                    Welding, Tig Welding (Normal), Tig Welding (Pipe), Spot Welding and Plasma Cutting, Steel
                    Fabrication, Pipe Fitting,
                    OJT.
                  </p>
                </div>
              </div> <!-- course-media -->
              <a class="btn btn-main" href="http://pis.isdb-bisew.org/apply" target="_blank" rel="noopener">Apply
                Online</a>
            </div>
            <div class="tab-pane fade" id="programme-data" role="tabpanel" aria-labelledby="programme-data-tab">
              <div class="post-content">
                @if($home->get_single_post(92))
                  {!! $home->get_single_post(92)->post_content !!}
                @endif
              </div>
            </div>

            @if($isIntake)
              <div class="tab-pane fade" id="intake-status" role="tabpanel" aria-labelledby="intake-status-tab">
                <div class="card text-center mb-5">
                  <div class="card-header">
                    <h2>Intake notice status </h2>
                  </div>
                  <div class="card-body">
                    @if($intake)
                      <h1>Round - {{$intake->round ?? null}}</h1>
                      <img src="{{asset("themes-assets/default/img/bg-img/voc.jpg")}}" class="img-fluid w-50"
                           alt="vocation training">
                      <h2 class="my-3">
                        <span class="text-success">The application begins:</span>
                        @if($intake->start_date ?? null)
                          <span class="text-info">{{ $carbon->parse($intake->start_date)->format("d F, Y")}}</span>
                        @endif
                      </h2>
                      <h2 class="my-3">
                        <span class="text-danger">Deadline for application:</span>
                        @if($intake->end_date ?? null)
                          <span class="text-danger">{{ $carbon->parse($intake->end_date)->format("d F, Y")}}</span>
                        @endif
                      </h2>
                      <a class="btn btn-main w-50 py-3 my-2" title="Apply online" href="{{url("apply")}}">Apply online</a>
                    @else
                      <h2>Data not available</h2>
                    @endif
                  </div>
                  <div class="card-body p-0">
                    <a href="{{url('vocational-training-programme/admit-card')}}" class="btn-link" title="Download admit card">
                      Already applied download admit card</a>
                  </div>
                  @if($intake->round)
                    <div class="card-body">
                      <p> Round <b>{{$intake->round}}</b> এর লিখিত পরীক্ষার জন্য নির্বাচিত প্রার্থীদের <b>SMS</b> এর মাধ্যমে জানানো হবে। </p>
                    </div>
                  @endif
                </div>
              </div>
            @endif
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

            <a class="d-block text-center" href="/vocational-training-programme/admit-card" style="font-size: 1.2rem">
              <i class="fa fa-download"></i> Already Applied Download Admit Card
            </a>
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
    </div> <!-- .container -->
  </section> <!-- .content-section-->
  <section class="milestone mb-5"
           style="background-image: url('{{asset("themes-assets/default/img/bg-img/project-banner/vocational-banner.jpg")}}')">
    <div class="milestone-display">
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="single-cool-fact">
              <div class="scf-text">
                <h2><span class="counter">1,401</span></h2>
                <p>Scholarship Awarded</p>
              </div>
            </div>
          </div> <!-- .col-sm-3 -->
          <div class="col-sm-3">
            <div class="single-cool-fact">
              <div class="scf-text">
                <h2><span class="counter">1,025</span></h2>
                <p>Vocational Graduates</p>
              </div>
            </div>
          </div> <!-- .col-sm-3 -->
          <div class="col-sm-3">
            <div class="single-cool-fact">
              <div class="scf-text">
                <h2><span class="counter">939</span></h2>
                <p>Job Placement</p>
              </div>
            </div>
          </div> <!-- .col-sm-3 -->
          <div class="col-sm-3">
            <div class="single-cool-fact">
              <div class="scf-text">
                <h2><span class="counter">92%</span></h2>
                <p>Placement Success</p>
              </div>
            </div>
          </div> <!-- .col-sm-3 -->
        </div>
        <!--.row -->
      </div>
    </div>
  </section> <!-- milestone area -->
  <section class="stories-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="stories-title text-center mb-5 mt-2">
            <h2>Success Stories</h2>
          </div>
        </div>
      </div>
      <div class="row">
        @foreach($story as $post)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="video-item" title="{{$post->post_title}}">
              <a href="{{url("{$post->post_type}/{$post->id}/{$post->post_slug}")}}" class="btn-card-link">
                <div class="video-thumbnail">
                  <img src="{{asset(thumbs_url($post->post_thumb))}}" class="img-fluid" alt="{{$post->post_slug}}">
                  @if($post->attachment)
                    <div class="video-btn">
                      <a class="mfp-pop mfp-iframe"
                         href="https://www.youtube.com/watch?v={{$post->attachment->attachment_path}}" title="Play">
                        <i class="fa fa-play" aria-hidden="true"></i>
                      </a>
                    </div>
                  @endif
                </div><!-- Blog Thumbnail -->
                @if($post->case_study)
                  @if($post->case_study->student)
                    <div class="blog-content">
                      <p class="post-title">{{$post->case_study->student->name}}</p>
                      @if($post->case_study->student->position)
                        <p class="position">{{$post->case_study->student->position->position_name}}</p>
                      @endif
                      @if($post->case_study->student->company)
                        <p class="company">{{$post->case_study->student->company->name}}</p>
                      @endif
                      @if($post->case_study->student->subject)
                        <p class="subject">{{$post->case_study->student->subject->subject_name}}</p>
                      @endif
                    </div> <!-- .blog-content -->
                  @endif
                @endif
              </a>
            </div> <!-- .video-item-->
          </div>
        @endforeach
      </div> <!-- row -->
    </div> <!-- .container -->
  </section> <!-- .stories-section -->
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous"/>
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
      // knob chart init
      knob_init('.knob');
      $('.mfp-pop').magnificPopup({
        disableOn: function () {
          return $(window).width() >= 992;
        }
      });
    }(jQuery));
  </script>
@endpush
