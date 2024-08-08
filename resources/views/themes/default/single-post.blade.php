@extends('themes/default/layouts/master')

@inject('home', "App\Home")

@section('title', $post->post_title)
@section('m_title', limiter($post->post_title, 90))
@section('m_description', limiter($post->post_excerpt, 180))
@section('m_image', asset($post->post_thumb))


@section("content")
  <div class="container">
    <div class="row">
      <div class="col-lg-9 col-md-7 col-sm-6 py-3">
        <div id="printContent">
          <div class="row">
            <div class="col-sm-10 clearfix">
              <div class="logo-print-area nav-brand d-none d-print-block">
                <img src="{{asset("img/isdb-bisew.png")}}" class="float-left mr-2" alt="IsDB-BISEW">
                <div class="float-left logoTextArea">
                  <h1 class="logotext mb-0">IsDB-BISEW</h1>
                  <p class="tagline tagline">
                    Islamic Development Bank<br>Bangladesh Islamic Solidarity
                    Educational Wakf </p>
                </div>
              </div>
              <div class="single-content-head d-none d-print-block float-right">
                <span class="post-date">{{strtoupper($post->post_type)}} / </span>
                <span class="post-date">@datetime($post->updated_at)</span>
              </div>
            </div>
            <hr class="w-100 d-none d-print-block">
          </div> <!-- .row -->
          <article class="post-content mb-5 clearfix">
            @if($post->attachment)
              <div class="embed-responsive embed-responsive-16by9 d-print-none">
                <iframe class="embed-responsive-item"
                        src="https://www.youtube.com/embed/{{$post->attachment->attachment_path}}?rel=0" allowfullscreen></iframe>
              </div>
              <hr class="h-100 d-print-none">
            @endif

            @if($post->case_study)
              <div class="row">
                <div class="col-sm-8">
                  <div class="single-content-head">
                    <h2 class="single-title mb-3">{{$post->post_title}}</h2>
                    @if($post->upload_type !== "off" && !empty($post->post_thumb) && is_null($post->case_study) )
                      <div class="post-content-picture">
                        <img src="{{asset($post->post_thumb)}}" class="img-fluid mb-2 mb-sm-3" alt="{{$post->post_title}}">
                      </div>
                    @endif

                    @if($post->case_study->student)
                      <div class="blog-content">
                        <p class="post-title">Name: <b>{{$post->case_study->student->name}}</b></p>
                        @if($post->case_study->student->position)
                          <p class="position">Position: <b>{{$post->case_study->student->position->position_name}}</b></p>
                        @endif
                        @if($post->case_study->student->company)
                          <p class="company">Company: <b>{{$post->case_study->student->company->name}}</b></p>
                        @endif
                        @if($post->case_study->student->subject)
                          <p class="subject">Course: <b>{{$post->case_study->student->subject->subject_name}}</b></p>
                        @endif
                      </div> <!-- .blog-content -->
                    @endif
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="post-content-picture">
                    <img src="{{asset($post->post_thumb)}}" class="img-fluid mb-2 mb-sm-3" alt="{{$post->post_title}}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  {!! $post->post_content !!}
                </div>
              </div>
            @else
              <div class="single-content-head">
                <h2 class="single-title">{{$post->post_title}}</h2>
                <span class="post-date d-print-none">@datetime($post->updated_at) / </span>
                <a href="{{url($post->post_type)}}" class="post-date d-print-none">{{$module->name}}</a>
              </div>
              @if($post->upload_type !== "off" && !empty($post->post_thumb) && is_null($post->case_study) )
                <div class="post-content-picture">
                  <img src="{{asset($post->post_thumb)}}" class="img-fluid mb-2 mb-sm-3" alt="{{$post->post_title}}">
                </div>
              @endif

              {!! $post->post_content !!}
            @endif
            @php
              $share_url = url()->current();
              $data_text = word_limiter($post->post_excerpt, 12);
            @endphp
          </article>
        </div>
        <hr class="w-100">
        <div class="text-center">
          <button role="button" class="btn btn-default d-inline" id="print">
            <i class="fa fa-print"></i> Print
          </button>
          <div class="d-inline ssk-group" data-url="{{$share_url}}" data-text="{!! $data_text !!}">
            <a href="" class="ssk ssk-facebook"></a>
            <a href="" class="ssk ssk-twitter" data-text="{!! $data_text !!}"></a>
            <a href="" class="ssk ssk-linkedin"></a>
          </div>
        </div>
        <div id="editor"></div>
        <hr class="w-100">
      </div> <!-- .col-sm-8 -->
      <div class="col-lg-3 col-md-5 col-sm-6 py-3">
        <h1 class="area-title">
          <span class="title-text w-100">News and Events</span>
        </h1>
        <div class="news-event-card mb-4">
          <ul class="news-list">
            @php
              $notices = $home->get_posts_by_single_cats('notice', 10);
            @endphp
            @foreach($notices as $notice)
              @php
                $notice = isset($notice) ? $notice : null;
                $link = url($notice->post_type.'/notice/'.$notice->id.'/'.$notice->post_slug);
              @endphp
              <li>
                <a href="{{$link}}">{{$notice->post_title}}</a>
                <span>@datetime($notice->updated_at) | {{$notice->module_name}}</span>
              </li>
            @endforeach
          </ul> <!-- .news-list -->
        </div>
        <div class="sidebar-widget">
          {!! it_scholarship_widget() !!}
        </div> <!-- .sidebar-widget -->

        <div class="sidebar-widget">
          {!! vocational_apply_widget() !!}
        </div> <!-- .sidebar-widget -->
      </div> <!-- .col-sm-3 -->
    </div> <!-- .row -->
  </div> <!-- .container -->
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset("themes-assets/default/social-share-kit/dist/css/social-share-kit.min.css") }}">
@endpush

@push('scripts')
  <script src="{{ asset("themes-assets/default/social-share-kit/dist/js/social-share-kit.min.js") }}"></script>
  <script src="{{ asset("themes-assets/default/js/print/print.min.js") }}"></script>
  <script>
    (function ($) {
      let postContent = $(".post-content");
      postContent.find('img').addClass('img-fluid');
      postContent.find("table").addClass("table table-striped table-bordered table-responsive-sm");
      $("#print").click(function () {
        printJS({
          printable: 'printContent',
          type: 'html',
          css: '{{asset("themes-assets/default/js/print/print.min.css")}}',
          honorColor: true,
        });
      });

      $("#tblSearch").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#tblResult tr").filter(function () {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
    }(jQuery));
  </script>
@endpush
