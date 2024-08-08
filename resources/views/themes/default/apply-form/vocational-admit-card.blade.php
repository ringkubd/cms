@extends('themes/default/layouts/master')

@inject('home', 'App\Home')


@section('title', 'Apply for Vocational Training Programme')
@section("m_title", 'Apply for Vocational Training Programme')
@section("m_url", request()->fullUrl() )
@section("m_image", $home->get_settings("meta_picture"))
@section("m_keywords", $home->get_settings("meta_key"))
@section("m_description", $home->get_settings("meta_desc"))

@section("content")

  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-sm-8 py-3">
          <div class="row">
            <div class="col-sm-6 offset-sm-3">
              @if(session('error'))
                <div class="alert alert-danger custom-alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i> Alert!</h4>
                  {{session('error')}}
                </div>
              @endif
              <div class="card" style="margin: 10vh 0">
                <div class="card-header">
                  <div class="form-header text-center">
                    <h2>Print Your Admit Card </h2>
                    @if($isIntake)
                      <p>
                        Not applied!
                        <a href="{{url("vocational-training-programme/apply")}}"> Apply now</a>
                      </p>
                    @endif
                    <p>
                      বিঃ দ্রঃ রেজিস্ট্রেশন এর সময় ফোন নাম্বার এ (-) হাইফেন দিয়ে থাকলে এখানেও ফোন নাম্বারে (-) হাইফেন দিয়ে
                      সার্চ করুন।
                    </p>
                    <p>
                      Example: 01XXX-XXXXXX অথবা 01XXXXXXXXX
                    </p>
                  </div>
                </div>
                <div class="card-body">
                  <form action="{{url("vocational-training-programme/admit-card")}}" method="post">
                    @csrf
                    <div class="form-group">
                      <label for="mobile_number">Mobile Number</label>
                      <input type="text" name="mobile_number" value="{{old('mobile_number')}}" id="mobile_number"
                             class="form-control" placeholder="01XXXXXXXXX" autofocus>
                      @error('mobile_number') <p class="text-danger m-0">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                      <label for="birth_date">Date Of Birth</label>
                      <input type="text" name="birth_date" value="{{old('birth_date')}}" id="birth_date"
                             placeholder="dd-mm-yyyy" class="form-control" autocomplete="off">
                      @error('birth_date') <p class="text-danger m-0">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Submit" class="btn btn-main w-100">
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- .col-md-9 -->
        <div class=" col-md-3 col-sm-4 py-3">
          <div class="sidebar-widget mb-4">
            <h2 class="widget-title"><span>Related Topics</span></h2>
            <ul class="widget-list">
              @php
                $related_posts = $home->get_related_page($module->slug, 15);
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

@push('styles')
  <link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
@endpush

@push('scripts')
  <script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
  <script>
    $(function () {
      $('#birth_date').datepicker({
        format: "dd-mm-yyyy",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
        top: 300
      });
    });
  </script>
@endpush
