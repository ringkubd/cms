@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', 'Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf')
@section('m_title', limiter($home->get_settings('meta_title'), 90))
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))


@section('content')

  <section class="slider-section">
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselMain" data-slide-to="0" class="active"></li>
        <li data-target="#carouselMain" data-slide-to="1"></li>
        <li data-target="#carouselMain" data-slide-to="2"></li>
        <li data-target="#carouselMain" data-slide-to="3"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="module-section">
            <div class="module-banner">
              <div class="module-banner-img">
                <img src="{{asset("img/BeFunky-collage.jpg")}}" alt="Programmes">
              </div> <!-- .banner-img -->
              <div class="module-banner-caption">
                <div class="container">
                  <div class="row">
                    <div class="col-sm-5 text-center mb-0 mb-md-5">
                      <h1 class="module-title">IsDB-BISEW</h1>
                    </div> <!-- .col-sm-7 -->
                  </div> <!-- .row -->
                  <div class="row">
                    <div class="col-md-5">
                      <table class="table">
                        <tr>
                          <td>
                            <h2 class="programme d-none d-sm-block">Programmes</h2>
                            <ul class="evaluation-project mt-sm-0 p-0 pt-md-3">
                              <li>
                                <a href="{{url("it-scholarship-programme")}}">IT Scholarship
                                  Programme</a>
                              </li>
                              <li>
                                <a href="{{url("vocational-training-programme")}}">Vocational
                                  Training Programme</a>
                              </li>
                              <li>
                                <a href="{{url("madrasah-education-programme")}}">Madrasah
                                  Education Programme</a>
                              </li>
                              <li>
                                <a href="{{url("four-year-diploma-scholarship")}}">4-Year
                                  Diploma Scholarship
                                  Programme</a>
                              </li>
                              <li>
                                <a href="{{url("orphanage-programme")}}">Orphanage
                                  Programme</a>
                              </li>
                            </ul>
                          </td>
                          <td style="width: 40%" rowspan="4" class="text-center pt-sm-3">
                            <label>
                              <input type="text" class="knob d-none" value="48394"
                                     data-value="42574" data-min="0" data-max="50000"
                                     data-suffix="" readonly>
                            </label>
                            <div class="knob-label"> Total Beneficiaries</div>
                          </td>
                        </tr>
                      </table>
                    </div> <!-- .col-sm-7 -->
                  </div> <!-- .row -->
                </div>
              </div> <!-- module-banner-caption -->
            </div> <!-- module-banner -->
          </div> <!-- first-slider -->
        </div> <!-- carousel-item -->

        <div class="carousel-item">
          <div class="module-section">
            <div class="module-banner">
              <div class="module-banner-img">
                <img src="{{asset("photos/shares/Module/2019-11/1572782353-DSC_1869.jpg")}}"
                     alt="IT Scholarship Programme">
              </div> <!-- .banner-img -->
              <div class="module-banner-caption">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="module-title">IT Scholarship Programme</h1>
                      <div class="module-description d-none d-sm-block">
                        <p>
                          The IsDB-BISEW IT Scholarship Programme was launched in 2003 with the
                          aim of enhancing the
                          employment prospects of
                          meritorious Muslim youths who come from financially disadvantaged
                          background.
                        </p>
                      </div>
                    </div> <!-- .col-sm-6 -->
                  </div> <!-- .row -->
                  <div class="row">
                    <div class="col-md-5 mt-4">
                      <table class="m-0 table">
                        <tr>
                          <td>Inception:</td>
                          <td>2003</td>
                          <td style="width: 40%" rowspan="4" class="text-center pt-sm-3">
                            <label>
                              <input type="text" class="knob d-none" value="88.64"
                                     data-value="88.64" data-min="0" data-max="100"
                                     data-suffix="%" disabled>
                            </label>
                            <div class="knob-label">Job placement</div>
                          </td>
                        </tr>
                        <tr>
                          <td class="align-baseline">Beneficiaries:</td>
                          <td class="align-baseline">16,105</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <a href="{{url("it-scholarship-programme")}}"
                               class="btn btn-main">Lear more</a>
                          </td>
                        </tr>
                      </table>
                    </div> <!-- .col-sm-5 -->
                  </div> <!-- .row -->
                </div>
              </div> <!-- .module-banner-caption -->
            </div> <!-- .module-banner -->
          </div> <!-- it-scholarship slider -->
        </div> <!-- carousel-item -->

        <div class="carousel-item">
          <div class="module-section">
            <div class="module-banner">
              <div class="module-banner-img">
                <img src="{{asset("photos/shares/Module/2019-11/1572775846-Electronics-lab-round-11.jpg")}}"
                     alt="Vocational Training Programme">
              </div> <!-- .banner-img -->
              <div class="module-banner-caption">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="module-title">Vocational Training Programme</h1>
                      <div class="module-description d-none d-sm-block">
                        <p>
                          IsDB-BISEW is targeting a particularly neglected and vulnerable section
                          of the student
                          population of the country.
                          These are the students of underprivileged background who fail to
                          progress from high school to
                          the HSC
                          levels.
                        </p>
                      </div>
                    </div> <!-- .col-sm-6 -->
                  </div> <!-- .row -->
                  <div class="row">
                    <div class="col-md-5 mt-4">
                      <table class="m-0 table">
                        <tr>
                          <td>Inception</td>
                          <td>2012</td>
                          <td style="width: 40%" rowspan="4" class="text-center pt-sm-3">
                            <label>
                              <input type="text" class="knob d-none" value="92"
                                     data-value="92" data-min="0" data-max="100" data-suffix="%"
                                     disabled>
                            </label>
                            <div class="knob-label">Job placement</div>
                          </td>
                        </tr>
                        <tr>
                          <td class="align-baseline">Beneficiaries</td>
                          <td class="align-baseline">1,925</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <a href="{{url("vocational-training-programme")}}"
                               class="btn btn-main">Lear more</a>
                          </td>
                        </tr>
                      </table>
                    </div> <!-- .col-sm-5 -->
                  </div> <!-- .row -->
                </div>
              </div> <!-- .module-banner-caption -->
            </div> <!-- .module-banner -->
          </div> <!-- it-vocational slider -->
        </div> <!-- carousel-item -->

        <div class="carousel-item">
          <div class="module-section">
            <div class="module-banner">
              <div class="module-banner-img">
                <img src="{{asset("photos/shares/Module/2019-10/1572160244-Kapashia-crop.jpg")}}"
                     alt="Madrasah Education Programme">
              </div> <!-- .banner-img -->
              <div class="module-banner-caption">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h1 class="module-title">Madrasah Education Programme</h1>
                      <div class="module-description d-none d-sm-block">
                        <p>
                          IsDB-BISEW has taken up the initiative of providing vocational education
                          and training to the
                          students of selected Madrasahs by exposing them to vocational
                          education/training in the trades
                          of their choice.
                        </p>
                      </div>
                    </div> <!-- .col-sm-6 -->
                  </div> <!-- .row -->
                  <div class="row">
                    <div class="col-sm-5 mt-4">
                      <table class="m-0 table">
                        <tr>
                          <td>Inception</td>
                          <td>2008</td>
                          <td style="width: 40%" rowspan="4" class="text-center pt-sm-3">
                            <label>
                              <input type="text" class="knob d-none" value="95"
                                     data-value="95" data-min="0" data-max="100" data-suffix="%"
                                     disabled>
                            </label>
                            <div class="knob-label">Passing Rate in Dakhil(voc.) Exam</div>
                          </td>
                        </tr>
                        <tr>
                          <td class="align-baseline">No. of Madrasahs</td>
                          <td class="align-baseline">6</td>
                        </tr>
                        <tr>
                          <td class="align-baseline">Beneficiaries</td>
                          <td class="align-baseline">28,012</td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <a href="{{url("madrasah-education-programme")}}"
                               class="btn btn-main">Lear more</a>
                          </td>
                        </tr>
                      </table>
                    </div> <!-- .col-sm-6 -->
                  </div> <!-- .row -->
                </div>
              </div> <!-- .module-banner-caption -->
            </div> <!-- .module-section -->
          </div> <!-- Madrasah slider -->
        </div> <!-- carousel-item -->
      </div>
      <a class="carousel-control-prev" href="#carouselMain" role="button" data-slide="prev">
        <i class="fa fa-angle-left" aria-hidden="true"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselMain" role="button" data-slide="next">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>

  <section class="quota-section py-2 py-sm-2">
    <div class="container">
      <div class="quota">
        <h2 class="quota-title">Welcome to IsDB-BISEW</h2>
        <p>
          The Islamic Development Bank-Bangladesh Islamic Solidarity Educational Wakf (IsDB-BISEW) was established
          in 1987
          following an
          agreement between the Islamic Development Bank and the Government of Bangladesh. IsDB-BISEW undertakes
          funding,
          formulating and
          implementing of programmes in the areas of education, developing human resources and strengthening
          educational
          institutions.
        </p>
        <p>
          By focusing on workforce development through technical training and skilling in all its programmes and
          projects
          undertaken from
          2003, it radically impacted the lives of about 50,000 underprivileged Muslim youths till now.
        </p>
        <a class="btn btn-main" title="Read more" href="{{url("about")}}">More</a>
      </div> <!-- .quota-->
    </div>
  </section>

  <section class="main-content bg-body py-2 py-sm-4">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <h2 class="area-title">
            <span class="title-text">Latest Updates</span>
          </h2>
          @foreach($home->get_posts_by_single_cats('latest-update', 3) as $latest)
            @php
              $latest = isset($latest) ? $latest : null;
              $link = url($latest->post_type."/".$latest->id."/".$latest->post_slug);
              $content = word_limiter($latest->post_excerpt, 16);
            @endphp
            @if($loop->first)
              <a href="{{$link}}">
                <div class="news-card">
                  <div class="news-card-img">
                    <img src="{{asset(thumbs_url($latest->post_thumb))}}" class="img-fluid"
                         alt="{{$latest->post_title}}">
                    <div class="programme">
                      <span>{{$latest->module_name}}</span>
                    </div>
                  </div>
                  <div class="news-card-body">
                    <h2 class="card-title">{{$latest->post_title}}</h2>
                    <span class="date-time">@datetime($latest->updated_at)</span>
                    <div class="news-content">
                      <p>{{$content}}</p>
                    </div>
                  </div>
                </div>
                <!--.news-card -->
              </a>
            @else
              <a href="{{$link}}">
                <div class="media">
                  <img src="{{asset(thumbs_url($latest->post_thumb))}}" class="mr-3 w-35"
                       alt="{{$latest->post_title}}">
                  <div class="media-body">
                    <span class="date">{{$latest->module_name}}</span>
                    <h5>{{$latest->post_title}}</h5>
                  </div>
                </div>
              </a>
            @endif
          @endforeach
          <a class="btn btn-main mb-3" title="More updates" href="{{url('latest-updates')}}">More Updates</a>
        </div> <!-- .col-md-3 -->
        <div  class="col-md-4 col-sm-6">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a href="#top_freelancer" id="top_freelancer-tab" role="tab" class="nav-link"  data-toggle="tab">
                Top Freelancer
              </a>
            </li>
            <li class="mr-2 nav-item">
              <a href="#top_job" class="nav-link active" id="top_job-tab" role="tab" data-toggle="tab">
                Recent Placement
              </a>
            </li>

          </ul>
          <div class="tab-content">
            <div id="top_job" role="tabpanel" aria-labelledby="top_job-tab" class="tab-pane fade in show active">

            @php
              $it =  \App\Models\InfoModel\Student::where('is_success_stories', 1)
->where('job_type', 'it')->with(['module', 'round', 'subject', 'position', 'company'])
->orderBy('created_at', 'desc')->paginate(5);
            @endphp
            @foreach($it as $story)
              <div class="media">
                <img src="{{asset(thumbs_url($story->profile_image))}}" class="mr-3 w-35" alt="{{$story->name}}">
                <div class="media-body">
                    <h5>{{$story->name}}</h5>
                    @if($story->company)
                      <li>{{$story->position->position_name}}</li>
                    @endif
                    @if($story->company)
                      <li>{{$story->company->name}}</li>
                    @endif
                    @if($story->round && $story->subject)
                    <li class="subject">
                      <span class="subject">{{$story->round->name}} /</span>
                      <span class="subject" title="{{$story->subject->description}}">
                              {{$story->subject->subject_name}}
                          </span>
                    </li>
                    @endif
                    @if($story->subject)
                        <li>
                          <span class="date">{{$story->module->name ?? ""}}</span>
                        </li>
                    @endif
                    <li><a href="{{$story->profile_link}}">{{$story->profile_link}}</a></li>
                </div>
              </div>
            @endforeach
              <a class="btn btn-main mb-3" title="More" href="{{url('top-job-placement')}}">More</a>
            </div> <!-- .col-md-3 -->
            <div id="top_freelancer" aria-labelledby="top_freelancer-tab"   role="tabpanel" class="tab-pane fade in">

              @php
                $freelancer =  \App\Models\InfoModel\Student::where('is_success_stories', 1)->where('job_type', 'freelancer')->with(['module', 'round', 'subject', 'position', 'company'])->orderBy('created_at', 'desc')->paginate(5);
              @endphp
              @foreach($freelancer as $story)
                <div class="media">
                  <img src="{{asset(thumbs_url($story->profile_image))}}" class="mr-3 w-35" alt="{{$story->name}}">
                  <div class="media-body">
                      <h5>{{$story->name}}</h5>
                      @if($story->company)
                        <li>{{$story->position->position_name}}</li>
                      @endif
                      @if($story->company)
                        <li>{{$story->company->name}}</li>
                      @endif
                      @if($story->round && $story->subject)
                      <li class="subject">
                        <span class="subject">{{$story->round->name}} /</span>
                        <span class="subject" title="{{$story->subject->description}}">
                                {{$story->subject->subject_name}}
                        </span>
                      </li>
                      @endif
                      @if($story->subject)
                          <li>
                            <span class="date">{{$story->module->name}}</span>
                          </li>
                      @endif
                      <li><a href="{{$story->profile_link}}">{{$story->profile_link}}</a></li>
                  </div>
                </div>
              @endforeach
              <a class="btn btn-main mb-3" title="More" href="{{url('top-freelancer')}}">More</a>
            </div> <!-- .col-md-3 -->
          </div>
        </div>
        <div class="col-md-4 col-sm-6">
          <h1 class="area-title">
            <span class="title-text">Latest Notices</span>
          </h1>
          <div class="news-event-card">
            <ul class="news-list">
              @php
                $notices = $home->get_posts_by_single_cats('notice', 10);
              @endphp
              @foreach($notices as $notice)
                <li>
                  <a
                    href="{{url($notice->post_type."/".$notice->cat_slug."/".$notice->id."/".$notice->post_slug)}}">
                    {{$notice->post_title}}
                  </a>
                  <span>@datetime($notice->updated_at) | {{$notice->module_name}}</span>
                </li>
              @endforeach
            </ul> <!-- .news-list -->
          </div> <!-- .news- and events -->
          <a class="btn btn-main" title="More news and events" href="{{url('notice')}}">More Notices</a>
        </div> <!-- .col-md-3 -->
      </div> <!-- .row -->
    </div> <!-- .container -->
  </section> <!-- .main-content -->

  <section class="content-section">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-7 py-2 py-sm-4">
          <div class="intro-news-filter d-flex">
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active show" id="courses-tab" data-toggle="tab" href="#courses"
                   role="tab" aria-controls="courses" aria-selected="false">IT Scholarship Courses</a>
                <a class="nav-item nav-link" id="VocCourses-tab" data-toggle="tab" href="#VocCourses"
                   role="tab" aria-controls="VocCourses" aria-selected="false">Vocational Course</a>
              </div>
            </nav>
          </div> <!-- .intro-news-filter -->
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="courses" role="tabpanel" aria-labelledby="courses-tab">
              <div class="post-content">
                @php
                  $ourCourses = $home->get_module_post_by_slug(null, "page", 'it-scholarship-courses');
                @endphp
                @if($ourCourses)
                  {!! $ourCourses->post_content !!}
                @endif
              </div> <!-- .post-content -->
            </div> <!-- .tab-pane -->
            <div class="tab-pane fade" id="VocCourses" role="tabpanel" aria-labelledby="VocCourses-tab">
              <div class="post-content">
                @php
                  $ourCourses = $home->get_module_post_by_slug(null, "page", 'vocational-courses');
                @endphp
                @if($ourCourses)
                  {!! $ourCourses->post_content !!}
                @endif
              </div> <!-- .post-content -->
            </div> <!-- .tab-pane -->
          </div> <!-- .tab-content -->
        </div> <!-- col-sm-9 -->
        <div class="col-md-3 col-sm-5 py-2 py-sm-4">
          <div class="sidebar-widget">
            {!! it_scholarship_widget() !!}
          </div> <!-- .sidebar-widget -->
          <div class="sidebar-widget">
            {!! vocational_apply_widget() !!}
          </div> <!-- .sidebar-widget -->
        </div> <!-- .col -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
  </section>

  <section class="success-stories" style="background-image: url('{{asset("img/BeFunky-collage.jpg")}}')">
    <div class="stories-display">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="btn-play-all">
              <a href="javascript:void(0)" class="video-btn" id="play-video">
                <i class="fa fa-play-circle" aria-hidden="true"></i>
              </a>
              <p>Case study</p>
              <h2>Meet Our Graduates</h2>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .stories-display -->

    <div class="video-slideshow">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            @php
              $stories = $home->get_success_stories_post('success-stories', 50);
            @endphp
            <div id="video-slides" class="carousel">
              <ul class="slides">
                @foreach($stories as $post)
                  <li>
                    <div class="video-item mb-3 mb-sm-0" title="{{$post->post_title}}">
                      <a href="{{url("{$post->post_type}/{$post->id}/{$post->post_slug}")}}"
                         class="btn-card-link">
                        <div class="video-thumbnail h-220">
                          <img src="{{asset($post->post_thumb)}}" class="img-fluid"
                               alt="{{$post->post_slug}}">
                          @if($post->attachment)
                            <div class="video-btn">
                              <a class="mfp-pop mfp-iframe"
                                 href="https://www.youtube.com/watch?v={{$post->attachment->attachment_path}}?rel=0"
                                 title="Play">
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
                                <p class="position">{{$post->case_study->student->position->position_name}}
                                </p>
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
                  </li>
                @endforeach
              </ul>

            </div> <!-- Video Slides -->
          </div>
        </div>
      </div> <!-- .container-fluid -->
    </div> <!-- .video-slideshow -->
  </section> <!-- .success-stories -->

  @php
    $modules = $home->get_module_for_display(6);
  @endphp
  @if($modules->isNotEmpty())
    <section class="footer-project">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div class="success-stories text-center ">
              <h2 class="isdb-program">IsDB-BISEW PROGRAMME</h2>
            </div>
          </div>
          @foreach($modules as $module)
            <div class="col-lg-4 col-md-4 col-sm-6">
              <a href="{{url($module->slug)}}" class="module-card-link">
                <div class="module-card" title="{{$module->name}}">
                  <div class="module-card-thumbnail h-220">
                    <img src="{{asset(thumbs_url($module->picture))}}" class="w-100 h-100"
                         alt="{{$module->name}}">
                  </div>
                  <div class="module-card-body">
                    <h2 class="module-card-title">{{$module->name}}</h2>
                  </div>
                  <div class="module-card-footer">
                    @if($module->start_form)
                      <span class="post-date">Inception {{date("Y", strtotime($module->start_form) )}}</span>
                    @endif
                  </div>
                </div>
              </a>
            </div> <!-- .col-sm-6 -->
          @endforeach
        </div> <!-- .row -->
        <div class="row">
          <div class="col-sm-12">
            <div class="text-center">
              <a href="{{url('isdb-bisew-programme')}}" class="btn btn-main" title="Learn More">
                Learn More
              </a>
            </div>
          </div>
        </div>
      </div> <!-- .container -->
    </section>
  @endif

@stop

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
    $(function () {
      knob_init('.knob'); // configure the knob circle
      $('#carouselMain').on('slid.bs.carousel', function () {
        let knob = $(this).find('.carousel-item.active').find(".knob");
        let min = knob.attr("data-min");
        let max = currencyFormatToNumber(knob.val());
        let dataValue = knob.attr('data-value');
        let suffix = knob.attr('data-suffix');
        $({
          animatedVal: min
        }).animate({
          animatedVal: max
        }, {
          duration: 4500,
          easing: "swing",
          step: function () {
            knob.val(Math.ceil(this.animatedVal)).trigger('change');
          },
          done: function () {
            if (suffix) {
              knob.val(currencyFormatToComma(dataValue)).trigger('change');
            } else {
              knob.val(currencyFormatToComma(dataValue));
            }
          }
        });
      });


      $('.mfp-pop').magnificPopup({
        type: 'iframe',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
        },
        disableOn: function () {
          return $(window).width() >= 992;
        }
      });

      $('#play-video').click(function () {
        $('.mfp-pop').magnificPopup({
          type: 'iframe',
          tLoading: 'Loading image #%curr%...',
          mainClass: 'mfp-img-mobile',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
          },
          disableOn: function () {
            return $(window).width() >= 992;
          }
        }).magnificPopup('open');
      });
    });
  </script>
@endpush
