@extends('themes/default/layouts/master')

@inject('home', 'App\Home')
@inject('agent', 'Jenssegers\Agent\Agent')

@section('title', 'Tender Information of IsDB-BISEW')
@section('m_title', 'Tender Information of IsDB-BISEW')
@section('m_description', 'Tender Information of IsDB-BISEW')
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
  <div class="container-fluid mb-5 pb-5">
    <div class="row">
      <div class="col-md-12 mt-5">
        <a target="_blank" href="/tender_attach/Invitation for International Tender_12.08.2021.pdf"><button class="btn btn-success" style="font-weight: 200;">Advertisement download link</button></a>
      </div>
      <div class="col-md-7 img-responsive">
        <a target="_blank" href="/tender_attach/Invitation for International Tender_12.08.2021.pdf"><img class="img-fluid" src="/tender_attach/Tender_12.08.21.png" alt="" width="100%" height="100%"></a>
      </div>
      <div class="col-md-5">
        <div class="card" style="height: 100%;">
          <div class="card-header">
            <video controls width="100%" height="100%" title="video player"  preload="none" poster="/tender_attach/poster.png" autoplay frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
              <source src="/tender_attach/Walkthrough Animation (15 Storied).mp4" type="video/mp4" autostart="false">
            </video>
          </div>
          <div class="card-body">
            <div class="wrapper center-block">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                @forelse (\App\Models\ContentModels\Post::where('post_type', 'tender')
->where('post_status', 'publish')
->whereHas('categories', function($query){
    $query->where('name', 'tender');
})
->orderBy('updated_at', 'desc')->get() as $item)
                  <div class="panel panel-default mb-5">
                    <div class="panel-heading active" onclick="hideSummary(this)" role="tab" id="heading{{$item->id}}">
                      <h4 class="panel-title">
                        <a class="@if(\Illuminate\Support\Carbon::parse($item->updated_at)->diffInHours(now()) < 96) blink @endif" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                          {{$loop->iteration }}# {{$item->post_title}}
                          <br><small class="mb-4 mt-0 pt-0" style="font-size: 10px!important"><i>Published At- {{\Illuminate\Support\Carbon::parse($item->updated_at)->format("d M Y h:i:s")}}</i></small>
                        </a>
                        <p class="summary" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}" aria-expanded="true" aria-controls="collapse{{$item->id}}">
                          {!! str_limit($item->post_title, 100, '.....') !!}
                        </p>
                      </h4>
                    </div>
                    <div id="collapse{{$item->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$item->id}}">
                      <div class="panel-body js-smartPhoto" style="border-bottom: 2px solid black;">
                        {!! $item->post_content !!}
                      </div>
                    </div>
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/.row -->
  </div> <!-- container -->
@stop

@push('styles')
  <link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.css" integrity="sha512-JjulHDaUHaWsr0SH0hBu55Z01ZzKDIsJQS0a4NwwonlnJpAHi/VmKwX2X9PffgpJVUYIHurf1eTDpraAJ6tXFQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .panel-heading {
      padding: 0;
      border:0;
    }
    .panel-title>a, .panel-title>a:active{
      display:block;
      /*padding:15px;*/
      /*color:#555;*/
      font-size:16px;
      font-weight:bold;
      text-transform:uppercase;
      letter-spacing:1px;
      word-spacing:3px;
      text-decoration:none;
    }
    a:active a>p.summary {
      display: none;
    }
    .panel-title>a>small{
      text-transform:capitalize;
    }
    .panel-heading  a:before {
      font-family: 'Glyphicons Halflings';
      content: "\e114";
      float: right;
      transition: all 0.5s;
    }
    .panel-heading.active a:before {
      -webkit-transform: rotate(180deg);
      -moz-transform: rotate(180deg);
      transform: rotate(180deg);
    }
  </style>
@endpush

@push('scripts')
  <script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.10.1/viewer.min.js" integrity="sha512-2e2mvwFe4ZwNBifdDlcPESjLL+Y96YVnCM+OlKOnpHgGSN7KYxIxWlZ3kX7vQ348Mm2Kz1qmajPP/gm1gmFErA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    function hideSummary(self) {
      $(self).find('p.summary').slideToggle();
    }

    function blink_text() {
      $('.blink').fadeOut(500);
      $('.blink').fadeIn(500);
    }
   // setInterval(blink_text, 1000);

    (function ($) {
      $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
      });
      $('.panel-collapse').on('show.bs.collapse', function () {
        $(this).siblings('.panel-heading').addClass('active');
      });

      $('.panel-collapse').on('hide.bs.collapse', function () {
        $(this).siblings('.panel-heading').removeClass('active');
      });

    }(jQuery));
    const gallery = new Viewer(document.getElementById('img'));
  </script>
@endpush

