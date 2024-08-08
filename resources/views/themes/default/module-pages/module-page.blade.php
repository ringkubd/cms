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
          <div class="col-sm-7">
            <h1 class="module-title">{{$module->name}}</h1>
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
      <div class="col-sm-3">
        <div class="nav flex-column nav-pills custom-vertical-tab" id="v-pills-tab" role="tablist"
          aria-orientation="vertical">
          <a class="nav-link active" id="v-pills-latest-tab" data-toggle="pill" href="#v-pills-latest" role="tab"
            aria-controls="v-pills-latest" aria-selected="true">Latest Updates</a>
          <a class="nav-link" id="v-pills-objective-tab" data-toggle="pill" href="#v-pills-objective" role="tab"
            aria-controls="v-pills-objective" aria-selected="false">Project Objectives</a>
          <a class="nav-link" id="v-pills-feature-tab" data-toggle="pill" href="#v-pills-feature" role="tab"
            aria-controls="v-pills-feature" aria-selected="false">Unique Features</a>
          <a class="nav-link" id="v-pills-courses-tab" data-toggle="pill" href="#v-pills-courses" role="tab"
            aria-controls="v-pills-courses" aria-selected="false">Courses</a>
          <a class="nav-link" id="v-pills-status-tab" data-toggle="pill" href="#v-pills-status" role="tab"
            aria-controls="v-pills-status" aria-selected="false">Placement Status </a>
          <a class="nav-link" id="v-pills-graph-tab" data-toggle="pill" href="#v-pills-graph" role="tab"
            aria-controls="v-pills-graph" aria-selected="false">Placement Graph </a>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="tab-content" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-latest" role="tabpanel"
            aria-labelledby="v-pills-latest-tab">
            @php
            $module = isset($module) ? $module : "";
            $latest_Posts = App\Home::get_posts_by_multiple_category(['latest'], 5, null, ["module"=>$module->slug]);
            @endphp
            <div class="row">
              @foreach($latest_Posts as $latest_Post)
              @php
              $latest_Post = isset($latest_Post) ? $latest_Post : "";
              $link = url($latest_Post->post_type."/".$latest_Post->post_slug);
              $img_link = asset($latest_Post->post_thumb);
              $module_name = $latest_Post->post_type;
              if (file_exists(asset(thumbs_url($img_link)))) {
              $thumbs_url = asset(thumbs_url($img_link));
              }else{
              $thumbs_url = $img_link;
              }
              $title = word_limiter($latest_Post->post_title, 8);
              @endphp
              @if($loop->iteration < 3) <div class="col-sm-6">
                <div class="single-blog-post style-2" title="{{$title}}">
                  <a href="{{$link}}" class="overlay-style-block">
                    <div class="blog-thumbnail overlayable" style="background-image: url('{{$thumbs_url}}')">
                    </div>
                  </a><!-- Blog Thumbnail -->
                  <div class="blog-content overlayable-content">
                    <span class="post-date">@datetime($latest_Post->updated_at)</span>
                    <a href="{{$link}}" class="post-title">{{$title}}</a>
                    <div class="content-text">
                      <p>{{word_limiter($latest_Post->post_excerpt, 12)}}</p>
                    </div>
                    <a href="{{url($module_name)}}" class="post-author">{{$module_name}}</a>
                  </div> <!-- .blog-content -->
                </div>
            </div> <!-- .col-sm-6 -->
            @else
            <div class="col-sm-12">
              <div class="single-blog-post d-flex style-4 @if($loop->last) mb-0 @endif" title="{{$title}}">
                <!-- Blog Thumbnail -->
                <div class="blog-thumbnail">
                  <a href="{{$link}}">
                    <img src="{{asset($thumbs_url)}}" alt="{{$title}}">
                  </a>
                </div>
                <!-- Blog Content -->
                <div class="blog-content">
                  <span class="post-date">@datetime($latest_Post->updated_at)</span>
                  <a href="{{$link}}" class="post-title">{{$title}}</a>
                  <p>{{word_limiter($latest_Post->post_excerpt, 16)}}</p>
                </div>
              </div>
            </div>
            @endif
            @endforeach
          </div> <!-- .row -->
          <a href="{{url("latest-updates?type=madrasah-project")}}" class="btn btn-main my-2" title="More"> More Updates
          </a>
        </div> <!-- latest -->
        <div class="tab-pane fade" id="v-pills-objective" role="tabpanel" aria-labelledby="v-pills-objective-tab">
          <div class="post-content">
            @php
            $module_post = App\Home::get_module_post_by_slug($module->slug, "page", "project-objective");
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
            $module_post = $home->get_module_post_by_slug($module->slug, "page", "unique-features");
            @endphp
            @if($module_post)
            <h3>{{$module_post->post_title}}</h3>
            {!! $module_post->post_content !!}
            @endif
          </div>
        </div>
        <div class="tab-pane fade" id="v-pills-courses" role="tabpanel" aria-labelledby="v-pills-courses-tab">
          @if($module->slug == "it-scholarship")
          <div class="course-media d-flex">
            <div class="course-media-picture">
              <img src="{{asset('themes-assets/default/img/bg-img/courses/image007.jpg')}}" alt="J2EE">
            </div>
            <div class="course-media-content">
              <h3>Web Apps Development with Java (J2EE) and Frameworks</h3>
              <p>
                J2EE is a software development platform for enterprise applications. This course consists of various
                cutting-edge
                technologies like Java, Oracle, JSP, Hibernate, Spring, Bootstrap, PrimeFaces, AngularJS and mobile
                technology
                using Android.
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
                This course shall prepare you to design and develop desktop, web, and mobile applications based on the
                latest
                Microsoft technologies and certify you as a Microsoft Certified Solution Associate (MCSA).
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
                Based on the most popular Open Source web technologies e.g., PHP, MySQL, Codelgniter, Laravel, Cake PHP,
                Word
                press & theme development, Magento (e-commerce) etc.
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
                Provides skills required to design, install, and administer any organization's computer systems in Linux
                & Windows
                platform, including local area networks (LANs), wide area networks (WANs), and wireless networks.
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
                This course provides an effective learning path for people who want to pursue a career in computer aided
                graphics,
                animation & audio-visual production sectors.
              </p>
            </div>
          </div> <!-- course-media -->

          <div class="course-media d-flex">
            <div class="course-media-picture">
              <img src="{{asset('themes-assets/default/img/bg-img/courses/autocad.png')}}" alt="J2EE">
            </div>
            <div class="course-media-content">
              <h3> Architectural & Civil CAD</h3>
              <p>
                These course is meant for diploma holders with background in Civil/Architecture/Construction/Survey.
                This course
                prepares you for a career as a CAD professional.
              </p>
            </div>
          </div> <!-- course-media -->
          <a class="btn btn-success" href="http://apply.isdb-bisew.info/" target="_blank" rel="noopener">Apply Online</a>
          @endif
        </div>
        <div class="tab-pane fade" id="v-pills-status" role="tabpanel" aria-labelledby="v-pills-status-tab">
          <table class="table table-bordered table-striped table-responsive-sm">
            <thead class="thead-dark">
              <tr>
                <th scope="col">Round</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Company</th>
                <th scope="col">Section</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
              <tr>
                <td>34</td>
                <td>Muhammad Mamun Bapari</td>
                <td>Graphics Designer</td>
                <td>Muslim Village BD</td>
                <td>ICT</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="tab-pane fade" id="v-pills-graph" role="tabpanel" aria-labelledby="v-pills-graph-tab">
          <div class="post-content">
            <h3>Placement Graph will be here</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div> <!-- .col-sm-9 -->
  <div class="col-md-3 col-sm-4 pb-4">
    <div class="sidebar-widget mb-4">
      <h2 class="widget-title"><span>Related Links</span></h2>
      <ul class="widget-list">
        @php
        $module_page = App\Home::get_module_post_by_slug($module->slug, "page");
        @endphp
        @foreach($module_page as $page )
        <li class="item">
          <a class="item-link"
            href="{{url($module->slug."/".$page->post_slug)}}">{{word_limiter($page->post_title, 5)}}</a>
        </li>
        @endforeach
      </ul>
    </div> <!-- .sidebar-widget -->

    <div class="sidebar-widget">
      {!! it_scholarship_widget() !!}
    </div> <!-- .sidebar-widget -->

    <div class="sidebar-widget">
      {!! vocational_apply_widget() !!}
    </div> <!-- .sidebar-widget -->

  </div>
  <!--.col-sm-3 -->
</section>
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
