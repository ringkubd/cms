@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', ' Apply Date Expired Vocational Training Programme')
@section("m_title", 'Apply Date Expired Vocational Training Programme')
@section('m_url', request()->fullUrl() )
@section('m_image', $home->get_settings('meta_picture'))
@section('m_keywords', $home->get_settings('meta_key'))
@section('m_description', $home->get_settings('meta_desc'))

@section('content')

  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-8 py-3">
          <div class="post-content">
            @php $instruction = $home->get_page_by_id(118,'vocational-training-programme'); @endphp
            <p class="text-center">
              <a href="{{url('vocational-training-programme/admit-card')}}" style="font-size: 1.6rem;color: rgb(0, 86, 179)">
                <i class="fa fa-download" aria-hidden="true"></i> Already applied download admit card
              </a>
            </p>
            @if($instruction)
              {!! $instruction->post_content !!}
            @else
              Instructions fail
            @endif
          </div> <!-- .post-content -->
        </div> <!-- .col-md-9 -->

        <div class="col-md-3 col-sm-4 py-3">
          <div class="sidebar-widget mb-4">
            <h2 class="widget-title"><span>Related Topics</span></h2>
            <ul class="widget-list">
              @php
                $related_posts = $home->get_related_page('vocational-training-programme', 15);
              @endphp
              @foreach($related_posts as $r_posts)
                @php
                  $r_posts = isset($r_posts) ? $r_posts : "";
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
        </div>
      </div>
    </div> <!-- .container -->
  </section> <!-- .about-content -->
@endsection

@section("custom-style-file")
  <link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
@endsection

@section("custom-script")
  <script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
  <script>
    function studingField(obj) {
      let followed = $("#studying_level");
      if (obj.val() === "Studying") {
        followed.removeAttr("disabled");
      } else {
        followed.attr("disabled", "");
      }
    }

    $(function () {
      if ($("#present_status").val() === "Studying") {
        $("#studying_level").removeAttr("disabled");
      }
      $('#birth_date').datepicker({
        format: "dd-mm-yyyy",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
        top: 300
      });
    })

  </script>
@endsection
