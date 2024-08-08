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
          </div> <!-- .col-sm-6 -->
        </div> <!-- .row -->
        <div class="row">
          <div class="col-md-5 mt-2">
            <table class="m-0 table">
              <tr>
                <td style="width: 25%">Inception:</td>
                <td style="width: 25%">{{date("Y", strtotime($module->start_form) )}}</td>
                <td style="width: 40%" rowspan="2" class="text-center text-sm-left">
                  <input type="text" class="knob d-none" value="88.64" data-value="88.64" data-min="0" data-max="100"
                    data-suffix="%" disabled>
                  <div class="knob-label">Job placement</div>
                </td>
              </tr>
              <tr>
                <td class="align-baseline">Beneficiaries:</td>
                <td class="align-baseline">11,636</td>
              </tr>
            </table>
          </div> <!-- .col-sm-5 -->
        </div> <!-- .row -->
      </div>
    </div>
  </div> <!-- .container -->
</section> <!-- .module-section -->

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
      <div class="col-md-6 py-sm-5">
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
              <a class="nav-item nav-link" id="placement-status-tab" data-toggle="tab" href="#placement-status"
                role="tab" aria-controls="placement-status" aria-selected="false">Placement Status</a>
            </div>
          </nav>
        </div> <!-- .intro-news-filter -->
        <div class="tab-content" id="pills-tabContent">
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
          <a href="{{url("latest-updates?type={$module->slug}")}}" class="btn btn-main btn-sm my-2" title="More">More
          </a>
        </div> <!-- .latest-updates -->
        <div class="tab-pane fade" id="objectives" role="tabpanel" aria-labelledby="objectives-tab">
          <div class="post-content">
            @if($home->get_single_post(2))
            <h3>{{$home->get_single_post(2)->post_title}}</h3>
            {!! $home->get_single_post(2)->post_content !!}
            @endif
          </div> <!-- .post-content -->
        </div> <!-- objectives -->
        <div class="tab-pane fade" id="unique-features" role="tabpanel" aria-labelledby="unique-features-tab">
          <div class="post-content">
            @if($home->get_single_post(5))
            <h3>{{$home->get_single_post(5)->post_title}}</h3>
            {!! $home->get_single_post(5)->post_content !!}
            @endif
          </div> <!-- .post-content -->
        </div> <!-- unique-features -->
        <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
          <div class="post-content">
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/image007.jpg')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3>Web Apps Development with Java (JEE) and Frameworks</h3>
                <p>
                  J2EE is a software development platform for enterprise applications. This course consists of
                  various cutting-edge
                  technologies like Java, Oracle, JSP, Hibernate, Spring, Bootstrap, PrimeFaces, AngularJS and
                  mobile technology
                  using Android.
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/image001.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Application Development with Microsoft C#.NET</h3>
                <p>
                  This course shall prepare you to design and develop desktop, web, and mobile applications based on
                  the latest
                  Microsoft technologies and certify you as a Microsoft Certified Solution Associate (MCSA).
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/image005.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Web Apps Development with PHP and Frameworks</h3>
                <p>
                  Based on the most popular Open Source web technologies e.g., PHP, MySQL, Codelgniter, Laravel,
                  Cake PHP, Word
                  press & theme development, Magento (e-commerce) etc.
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/oracle.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Database Application Development in Oracle Platform</h3>
                <p>
                  This course trains you to design and develop applications using Oracle 10g Developer and Oracle
                  Application
                  Express (Apex) based on Oracle 10g Database Server leading to the certification Oracle Certified
                  Developer (OCP).
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/networking.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Windows and Linux Networking</h3>
                <p>
                  Provides skills required to design, install, and administer any organization's computer systems in
                  Linux & Windows
                  platform, including local area networks (LANs), wide area networks (WANs), and wireless networks.
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/gave.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Graphics, Animation and Video Editing</h3>
                <p>
                  This course provides an effective learning path for people who want to pursue a career in computer
                  aided graphics,
                  animation & audio-visual production sectors.
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <div class="course-media d-flex mb-0">
              <div class="course-media-picture">
                <img src="{{asset('themes-assets/default/img/bg-img/courses/autocad.png')}}" alt="J2EE">
              </div>
              <div class="course-media-content">
                <h3> Architectural & Civil CAD</h3>
                <p>
                  These course is meant for diploma holders with background in
                  Civil/Architecture/Construction/Survey. This course
                  prepares you for a career as a CAD professional.
                  <br>
                  <a href="{{url('it-scholarship-programme/it-scholarship-programme')}}" class="btn btn-link p-0">
                    Details</a>
                </p>
              </div>
            </div> <!-- course-media -->
            <a class="btn btn-main my-3" href="http://apply.isdb-bisew.info/" target="_blank">Apply Online</a>
          </div> <!-- post-content -->
        </div> <!-- courses -->
        <div class="tab-pane fade" id="placement-status" role="tabpanel" aria-labelledby="placement-status-tab">
          <table class="table table-responsive-sm table-bordered table-striped text-center" style="color: #555;">
            <tr>
              <th>SL</th>
              <th>Picture</th>
              <th>Name</th>
              <th>Position</th>
              <th>Company</th>
            </tr>
            @foreach($home->get_success_stories_post('top-placement', 6, $module->slug) as $placement)
            <tr class="valign-center">
              <td>{{$loop->iteration}}</td>
              <td style="width:130px">
                <img src="{{asset(thumbs_url($placement->post_thumb))}}" class="img-fluid"
                  alt="{{$placement->post_title}}">
              </td>
              <td style="width:170px">
                <b>{{$placement->case_study->student->name}}</b> <br>
                {{$placement->case_study->student->round->name ."/".$placement->case_study->student->subject->subject_name}}
              </td>
              <td>
                {{$placement->case_study->student->position->position_name}}
              </td>
              <td>
                {{$placement->case_study->student->company->name}}
              </td>
            </tr>
            @endforeach
          </table>
          <a href="{{url('top-job-placement')}}" class="btn btn-main mb-3" title="More">More</a>
        </div> <!-- placement-status -->
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
            <li>
              <a href="{{url("{$notice->post_type}/{$notice->id}/{$notice->post_slug}")}}">
                {{$notice->post_title}}
              </a>
              <span>@datetime($notice->updated_at)</span>
            </li>
            @endforeach
          </ul> <!-- .news-list -->
        </div> <!-- .news- and events -->
        <a href="{{url("notice?type={$module->slug}")}}" class="btn-link" title="More notice"> More notice</a>
      </div>
      @endif
      <div class="sidebar-widget mb-4">
        {!! it_scholarship_widget() !!}
      </div> <!-- .sidebar-widget -->
    </div> <!-- .col-sm-3 -->
    @if($agent->isMobile())
    <div class="col-md-3 py-sm-5">
      <div class="sidebar-widget mb-4">
        <h2 class="widget-title"><span>Related Topics</span></h2>
        <ul class="widget-list">
          @php
          $related_posts = $home->get_module_page_by_module_slug('it-scholarship-programme');
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

<section class="milestone mb-5"
  style="background-image: url('{{asset("themes-assets/default/img/bg-img/IT-Scholarship-2.jpg")}}')">
  <div class="milestone-display">
    <div class="container">
      <div class="row">
        <div class="col-3 col-sm-3">
          <div class="single-cool-fact">
            <div class="scf-text">
              <h2><span class="counter">7,085</span></h2>
              <p>Pass Students</p>
            </div>
          </div>
        </div> <!-- .col-sm-4 -->
        <div class="col-3 col-sm-3">
          <div class="single-cool-fact">
            <div class="scf-text">
              <h2><span class="counter">6,280</span></h2>
              <p>Job Placement</p>
            </div>
          </div>
        </div> <!-- .col-sm-4 -->
        <div class="col-3 col-sm-3">
          <div class="single-cool-fact">
            <div class="scf-text">
              <h2><span class="counter">88.64%</span></h2>
              <p>Placement Success</p>
            </div>
          </div>
        </div> <!-- .col-sm-4 -->
        <div class="col-3 col-sm-3">
          <div class="single-cool-fact">
            <div class="scf-text">
              <h2><span class="counter">39</span></h2>
              <p>Total Round</p>
            </div>
          </div>
        </div> <!-- .col-sm-4 -->
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
          <h2>Meet Our Graduates</h2>
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
@stop

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
  integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
@endpush

@push("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
  integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"
  integrity="sha256-2144q+NOM/XU6ZxSqRTJ8P0W/CkY6zXc6mXYt4+mF9s=" crossorigin="anonymous"></script>
<script src="{{ asset("themes-assets/default/js/jquery-knob/knob-helper.js") }}"></script>
<script>
  (function ($) {
      let postContent = $(".post-content");
      postContent.find('img').addClass('img-fluid');
      postContent.find('table').addClass('table table-striped table-bordered');
      $('#text-news').flexslider({
        animation: 'slide',
        direction: 'vertical',
        pauseOnHover: !0,
        controlNav: !1,
        animationLoop: !0,
        slideshowSpeed: 2500,
        slideshow: !0,
      });
      knob_init('.knob'); // knob chart init
      $('.mfp-pop').magnificPopup({
        disableOn: function () {
          return $(window).width() >= 992;
        }
      });
    }(jQuery));
</script>
@endpush
