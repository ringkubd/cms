@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', 'About us')
@section('m_title', limiter($home->get_settings('meta_title'), 90))
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section("content")
  <div class="about-section mb-2">
    <div class="about-banner">
      @if($post->upload_type !== 'off' && !empty($post->post_thumb) )
        @php $metaPic = $home->get_settings("meta_picture"); @endphp
      @else
        @php $metaPic = $home->get_settings("meta_picture"); @endphp
      @endif
      <div class="banner-picture">
        <video class="about-video ng-star-inserted" playsinline="" autoplay="" muted="" loop=""
               src="{{url("video?v=about")}}"
               poster="{{asset("files/shares/IsDB-Bisew-about-intro.png")}}"></video>
        <div class="banner-body">
          <div class="banner-caption">
            <p class="welcome">Welcome</p>
            <p class="to">to</p>
            <h2 class="site-title">{{$home->get_settings('site_title')}}</h2>
            <p class="intro">{{$post->post_excerpt}}</p>
          </div>
        </div>
      </div> <!-- .banner-picture -->
    </div>
  </div>

  <section class="about-content">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-8 py-3">
          <div class="row">
            <div class="col-md-3">
              <div class="nav flex-column nav-pills custom-vertical-tab" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="introduction-tab" data-toggle="pill" href="#introduction" role="tab"
                   aria-controls="introduction" aria-selected="true">Introduction</a>
                <a class="nav-link" id="what-we-do-tab" data-toggle="pill" href="#what-we-do" role="tab"
                   aria-controls="what-we-do" aria-selected="false">What We Do</a>
                <a class="nav-link" id="outcome-tab" data-toggle="pill" href="#outcome" role="tab"
                   aria-controls="outcome" aria-selected="false">Outcome</a>
                <a class="nav-link" id="project-evaluation-tab" data-toggle="pill" href="#project-evaluation" role="tab"
                   aria-controls="project-evaluation" aria-selected="false">Project Evaluation</a>
                <a class="nav-link" id="future-plan-tab" data-toggle="pill" href="#future-plan" role="tab"
                   aria-controls="future-plan" aria-selected="false">Future Plan</a>
              </div>
            </div>
            <div class="col-md-9">
              <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="introduction" role="tabpanel" aria-labelledby="introduction-tab">
                  <div class="post-content">
                    <div class="single-content-head m-0">
                      @if($post->post_type !== 'page')
                        <a href="{{url($post->post_type)}}" class="post-type"> / {{$post->post_type}}</a>
                      @endif
                    </div>
                    {!! $post->post_content !!}
                    @php
                      if($post->post_format == "individual"){
                        $share_url = url($post->post_slug);
                      }else{
                        $share_url = url($post->post_format."/".$post->post_slug);
                      }
                      $data_text = word_limiter($post->post_excerpt, 12);
                    @endphp
                  </div>
                </div>
                <div class="tab-pane fade" id="what-we-do" role="tabpanel" aria-labelledby="what-we-do-tab">
                  <div class="post-content mb-4">
                    <h3 class="border-bottom">What We Do</h3>
                  </div>
                  @foreach($home->get_module_for_display(6) as $module)
                    <div class="module-media-card mb-4 shadow-sm" title="{{$module->name}}">
                      <div class="row">
                        <div class="col-md-5 col-sm-6">
                          <div class="module-media-card-thumbnail">
                            <img src="{{asset($module->picture)}}" class="img-fluid" alt="{{$module->name}}">
                          </div>
                        </div>
                        <div class="col-md-7 col-sm-6">
                          <div class="module-media-card-body">
                            <h2 class="module-media-card-title">{{$module->name}}</h2>
                            @if($module->start_form)
                              <p class="post-date">Inception {{date("Y", strtotime($module->start_form) )}}</p>
                            @endif
                            {!! word_limiter($module->description, 35) !!}
                          </div>
                          <div class="module-media-card-footer">
                            @if($module->slug !== "other-programme")
                              <a href="{{url($module->slug)}}" class="btn-link">Details</a>
                            @endif
                          </div>
                        </div>
                      </div> <!-- .col-sm-6 -->
                    </div>
                  @endforeach
                </div>
                <div class="tab-pane fade" id="outcome" role="tabpanel" aria-labelledby="outcome-tab">
                  <div class="post-content">
                    <h3>Outputs, Outcome, Impact</h3>
                    <p>
                      IsDB-BISEW has been operating a number of educational programmes for the underprivileged Muslim youth since 2003.
                      Meanwhile, the programmes have earned enormous reputation and success in local and overseas job markets. All the
                      programmes have been maintaining an average of 92% direct job placement of beneficiaries. It is really appreciable and
                      praiseworthy contribution towards the economy of Bangladesh and strongly recommended for continuing the programmes in
                      broader and extended domain.
                    </p>
                  </div>
                </div>
                <div class="tab-pane fade" id="project-evaluation" role="tabpanel" aria-labelledby="project-evaluation-tab">
                  <div class="post-content">
                    <div class="single-content-head m-0">
                      <div class="row">
                        <div class="col-sm-6">
                          <ul class="evaluation-project">
                            <li>
                              <a href="{{url('it-scholarship-programme')}}">IT Scholarship Programme</a>
                            </li>
                            <li>
                              <a href="{{url('vocational-training-programme')}}">Vocational Training Programme</a>
                            </li>
                            <li>
                              <a href="{{url('madrasah-education-programme')}}">Madrasah Education Programme</a>
                            </li>
                            <li>
                              <a href="{{url('four-year-diploma-scholarship')}}">4-Year Diploma Scholarship Programme</a>
                            </li>
                            <li>
                              <a href="{{url('orphanage-programme')}}">Orphanage Programme</a>
                            </li>
                          </ul>
                        </div>
                        <div class="col-sm-6">
                          <img src="{{asset("themes-assets/default/img/bg-img/project-evaluation.png")}}" alt="Project Evaluation"
                               class="img-fluid">
                        </div>
                      </div> <!-- .row -->
                      <div class="row">
                        <div class="col-sm-12">
                          <h3>Project Evaluation</h3>
                          <p>
                            The IsDB-BISEW IT Scholarship Project has been rated by a Third-Party Evaluation as "Really appreciable and
                            praiseworthy contribution towards the economy or Bangladesh and underprivileged Muslim Youths and strongly
                            recommended for continuing tne program ln broader and extended domain".
                          </p>
                          <p>
                            The IsDB-BISEW IT Scholarship Project, as stated in the BUET Evaluation report -"The IsDB-BISEW IT Scholarship
                            Project has been producing highly competent Il workforce for the job market. The evaluation of the project
                            reveals that the qualifications and competencies obtained by completion of the training are officially
                            authorized through the lDB-Bl1SEW certificate and vendor certifications both of which are non-academic in
                            nature. Rather a professional certification/diploma from an academic institution and/or accreditation from an
                            authorized educational body will add more value both for the trainees and the project. This evaluation,
                            therefore, strongly recommends that the IsDB-BISEW IT Scholarship Project undertake the necessary steps to seek
                            endorsement of its training program from a suitable educational body authorized to confer such qualification";
                            and
                          </p>
                          <p>
                            The IsDB-BISEW Madrasah Project has been rated in a Third-Party evaluation in the following terms- "The
                            initiative of undertaking Madrasah project and introducing Dakhil (Vocational) program is highly appreciable and
                            its close monitoring system is ensuring quality education".
                          </p>
                          <h3>Recognition by IsDB, Jeddah</h3>
                          <p>
                            IsDB's evaluation of the IsDB-BISEW project "Project s good implementation, its satisfactory operational
                            performance and sustainability, the project is rated as successful"; and
                          </p>
                          <p>
                            IsDB arranged a study visit program for WAQF BID-GUINEE for sharing valuable cognizance and rich experiences of
                            IsDB-BISEW.
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane fade" id="future-plan" role="tabpanel" aria-labelledby="future-plan-tab">
                  <div class="post-content">
                    <h3>Future Expansion Plan</h3>
                    <p>
                      A plot of land has been purchased measuring 2 (two) acres located in the Agargaon Administrative Area, Dhaka,
                      Bangladesh
                      for setting up an installation befitting with its purposes and objectives of IsDB-BISEW with the enhanced capacity.
                    </p>
                    <p>
                      IsDB-BISEW meanwhile engaged a consulting firm to carry out a feasibility study to review various possible options for
                      utilizing the land. The purpose of the study is to determine the best possible option reviewing the outcome of the
                      study
                      and the reasons && considerations for and against a proposition. The study is in progress now.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-4 py-3">
          <div class="sidebar-widget">
            <h2 class="widget-title"><span>Important Links</span></h2>
            <div class="card-body">
              <ul class="list-group p-0">
                <li class="list-group-item text-left">
                  <a href="{{url('contact')}}">Contact us</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('latest-updates')}}">Latest Updates</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('notice')}}">Notice</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('it-scholarship-programme')}}">IT Scholarship Programme</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('vocational-training-programme')}}">Vocational Training Programme</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('madrasah-education-programme')}}">Madrasah Education Programme</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('four-year-diploma-scholarship')}}">4-Year Diploma Scholarship Programme</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('orphanage-programme')}}">Orphanage Programme</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('idb-bhaban')}}">IDB-Bhaban</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="http://pis.isdb-bisew.org">Project Information System</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="http://careerhub.isdb-bisew.info/">CareerHub IsDB-BISEW</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="http://tenant.isdb-bisew.org/">IsDB-BISEW Tenant</a>
                </li>
                <li class="list-group-item text-left">
                  <a href="{{url('it-scholarship-programme/frequently-asked-questions')}}">Frequently Asked Questions</a>
                </li>
              </ul>
            </div>
          </div> <!-- .sidebar-widget -->
        </div>
      </div> <!-- .row -->
    </div> <!-- .container -->
  </section> <!-- .about-content -->

@endsection


@push('scripts')
  <script>
    (function ($) {
      $(".post-content").find("table").addClass("table table-striped table-bordered table-responsive-sm");
    }(jQuery));
  </script>
@endpush
