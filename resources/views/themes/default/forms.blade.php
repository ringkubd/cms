@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', 'Download Necessary Forms of IsDB-BISEW')
@section('m_title', limiter($home->get_settings('meta_title'), 90))
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-8 py-3">
          <h1 class="area-title">
            <span class="title-text">Download Forms</span>
          </h1>
          <div class="post-content notice-page mb-5">
            <ul class="notice-area">
              @foreach($posts as $post)
                <li class="notice-item">
                  <div class="notice-caption">
                    <h3 class="m-0">{{$post->post_title}}</h3>
                    <p class="m-0">{{word_limiter(strip_tags($post->post_content), 25)}}</p>
                    @if($post->attachment)
                      <a href="{{url('download?form='.$post->attachment->attachment_path)}}" class="programme" title="download">Download</a>
                    @endif
                    <span> | </span>
                    <a href="{{url($post->post_slug)}}" class="programme" title="details">Details</a>
                  </div>
                </li> <!-- /.notice-item -->
              @endforeach
            </ul> <!-- /.notice-area-->
          </div>
        </div> <!-- .col-md-9 -->

        <div class="col-md-3 col-sm-4 py-3">
          <div class="sidebar-widget">
            <h2 class="widget-title"><span>Important Links</span></h2>
            <div class="card-body">
              <ul class="list-group p-0">
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
                  <a href="{{url('idb-bhaban')}}">IsDB-Bhaban</a>
                </li>
              </ul>
            </div>
          </div> <!-- .sidebar-widget -->
        </div>
      </div>
    </div> <!-- .container -->
  </section> <!-- .about-content -->

@endsection

@push('scripts')
  <script>
    (function ($) {
      $(".post-content").find("table").addClass("table table-striped table-bordered");
    }(jQuery));
  </script>
@endpush
