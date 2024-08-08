@php
$slug = isset($slug) ? $slug : null;
$startDate = isset($startDate) ? $startDate : null;
$endDate = isset($endDate) ? $endDate : null;
@endphp

@extends('themes/default/layouts/master')

@inject('home', 'App\Home')
@inject('gallery', 'App\Models\ContentModels\gallery')
@inject('carbon', 'Carbon\Carbon')
@inject('agent', 'Jenssegers\Agent\Agent')

@section('title', $post->post_title ?? "Photo Gallery")
@section('m_title', $post->post_title ?? "Photo Gallery")
@section('m_description', $post->post_excerpt ?? "Photo Gallery")
@section('m_image', asset($home->get_settings('meta_picture')))

@section("content")
<div class="container">
  <div class="row">
    @if(!$agent->isMobile())
    <div class="col-lg-3 col-md-4 col-sm-5 py-3">
      <div class="sidebar-widget mb-4">
        <h2 class="widget-title">
          <span>Filter & Refine</span>
        </h2>
        <ul class="widget-list">
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery")}}">All Photos</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("all")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=it-scholarship")}}">IT-Scholarship</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("it-scholarship")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=vocational-training")}}">Vocational Training</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("vocational-training")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=madrasah-project")}}">Madrasah Project</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("madrasah-project")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=four-year-diploma")}}">Four Year Diploma</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("four-year-diploma")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=business-center")}}">Business Center Photo</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("business-center")}}</span>
          </li>
          <li class="item">
            <a class="item-link" href="{{url("photo-gallery?collection=other-photos")}}">Other Photos</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_images("other-photos")}}</span>
          </li>
        </ul>
      </div> <!-- .sidebar-widget -->
      <div class="sidebar-widget">
        {!! it_scholarship_widget() !!}
      </div> <!-- .sidebar-widget -->


      <div class="sidebar-widget">
        {!! vocational_apply_widget() !!}
      </div> <!-- .sidebar-widget -->

    </div><!-- .col-sm-3 -->
    @endif
    <div class="col-lg-9 col-md-8 col-sm-7 py-3">
      <h1 class="area-title mb-2">
        <span class="title-text">Photo Gallery</span>
        <a href="javascript:void(0)" class="btn-link mx-1" data-toggle="collapse" data-target="#filter"
          aria-expanded="false" aria-controls="filter" title="filter">
          <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
        @if($startDate)
        <a href="{{url("photo-gallery")}}" class="btn-link  mx-1">Clear filter</a>
        @endif
      </h1>
      <div class="collapse @if($startDate)show @endif" id="filter">
        <form action="{{url("photo-gallery")}}" method="get">
          <div class="row">
            <div class="form-group col-lg-4 col-md-6 col-sm-12">
              <label for="collection" class="d-none">Collection</label>
              <select name="collection" id="collection" class="form-control form-control-sm">
                <option value="all">All</option>
                @foreach($picCats as $picCat)
                <option value="{{$picCat->slug}}" @if($picCat->slug == $slug) selected @endif>{{$picCat->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col">
              <label for="dateRange" class="d-none">Date Range</label>
              <div class="input-daterange input-group" id="datepicker">
                @php
                $startDate = $startDate ? $startDate : $carbon->now()->subDays(30)->format("d-m-Y");
                @endphp
                <input type="text" class="form-control form-control-sm" name="date-from" value="{{$startDate}}" />
                <span class="input-group-addon mx-2"> to </span>
                @php
                $endDate = $endDate ? $endDate : date("d-m-Y");
                @endphp
                <input type="text" class="form-control form-control-sm" name="date-to" value="{{$endDate}}" />
              </div>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-12">
              <button type="submit" class="btn btn-sm btn-success">Submit</button>
            </div>
          </div>
        </form>
      </div>
      <!--.collapse-->
      <hr class="mt-0">
      <ul class="timeline">
        @foreach($timelines as $timeline)
        @foreach($gallery->get_photo_categories_by_date($timeline->date) as $cats)
        <li>
          <a href="{{url("photo-gallery?collection={$cats->category->slug}")}}"
            class="timeline-title">{{$cats->category->name}}</a>
          <span class="float-right timeline-date">@datetime($timeline->date)</span>
          <div class="row play-image">
            @foreach($gallery->get_galaries($cats->category->id, $timeline->date) as $picture)
            <div class="col-lg-4 col-md-6 col-sm-12">
              <div class="single-blog-post gallery-item mb-5">
                @php $Date = web_date($picture->updated_at) @endphp
                <a href="{{asset($picture->filePath)}}"
                  title="{{"{$cats->category->name} / {$Date} / {$picture->caption}"}}"
                  class="overlay-style-block view-img">
                  <div class="blog-thumbnail overlayable">
                    <img src="{{asset(thumbs_url($picture->filePath))}}" alt="{{$picture->caption}}">
                  </div>
                </a><!-- Blog Thumbnail -->
                <div class="blog-content overlayable-content">
                  <p>{{$picture->caption}}</p>
                </div> <!-- .blog-content -->
              </div>
            </div>
            @endforeach
          </div> <!-- .row -->
        </li>
        @endforeach
        @endforeach
      </ul>
      <div class="paginate-page justify-content-center">
        {{$timelines->links()}}
      </div> <!-- .paginate-page -->
    </div> <!-- .col-sm-9 -->
    @if($agent->isMobile())
    <div class="col-lg-3 col-md-4 col-sm-5 py-3">
      <div class="sidebar-widget">
        {!! it_scholarship_widget() !!}
      </div> <!-- .sidebar-widget -->
      <div class="sidebar-widget">
        {!! vocational_apply_widget() !!}
      </div> <!-- .sidebar-widget -->

    </div><!-- .col-sm-3 -->
    @endif
  </div> <!-- .row -->
</div> <!-- .container -->
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
  integrity="sha256-PZLhE6wwMbg4AB3d35ZdBF9HD/dI/y4RazA3iRDurss=" crossorigin="anonymous" />
<link rel="stylesheet" href="{{ asset("themes-assets/default/css/photo-gallery.css") }}">
@endpush


@push('scripts')
<script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
  integrity="sha256-P93G0oq6PBPWTP1IR8Mz/0jHHUpaWL0aBJTKauisG7Q=" crossorigin="anonymous"></script>
<script>
  (function ($) {
      $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
        top: 300
      });

      // owl carousel for the main-slides
      $('.play-image').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery: {
          enabled: true,
          preload: [0, 2], // read about this option in next Lazy-loading section
          navigateByImgClick: true,
          arrowMarkup: '<button title="%title%" type="button" class="mfp-arrow mfp-arrow-%dir%"></button>', // markup of an arrow button
          tPrev: 'Previous (Left arrow key)', // title for left button
          tNext: 'Next (Right arrow key)', // title for right button
          tCounter: '<span class="mfp-counter">%curr% of %total%</span>' // markup of counter
        },
        image: {
          titleSrc: 'title'
        },
      });
    }(jQuery));

</script>
@endpush
