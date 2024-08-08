@extends('themes/default/layouts/master')

@inject("home", "App\Home")

@section('title', 'Latest news of IsDB-BISEW')
@section('m_title', 'Latest news of IsDB-BISEW')
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3 col-sm-4 py-3">
      <div class="sidebar-widget mb-4">
        <h2 class="widget-title">
          <span>Filter & Refine</span>
        </h2>
        <ul class="widget-list">
          <li class="item">
            <a class="item-link" href="{{url("latest-updates")}}">All News</a>
            <span class="badge badge-secondary float-right m-1">{{\App\Home::count_posts("latest-update")}}</span>
          </li>
          @foreach($programmes as $programme)
          <li class="item">
            <a class="item-link" href="{{url("latest-updates?type=".$programme->slug)}}">{{$programme->name}} News</a>
            <span
              class="badge badge-secondary float-right m-1">{{\App\Home::count_posts('latest-update',$programme->slug)}}</span>
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

    </div><!-- .col-sm-3 -->
    <div class="col-md-9 col-sm-8 py-3">
      <h2 class="p-0 sidebar-title">Latest News</h2>
      <a href="javascript:void(0)" class="btn-link mx-2" data-toggle="collapse" data-target="#filter"
        aria-expanded="false" aria-controls="filter" title="filter">
        <i class="fa fa-filter" aria-hidden="true"></i>
      </a>
      @if(request()->has("start"))
      <a href="{{url("latest-updates")}}" class="btn-link mx-1">Clear</a>
      @endif
      @php
      $collapse = request()->has("start") ? "show" : "";
      @endphp
      <div class="collapse {{$collapse}}" id="filter">
        <form action="{{url("latest-updates")}}" method="get">
          <div class="row">
            <div class="form-group col-sm-4">
              <label for="type" class="d-none">News Type</label>
              <select name="type" id="type" class="form-control form-control-sm">
                <option value="">All</option>
                @foreach($programmes as $programme)
                @php
                $programme = isset($programme) ? $programme : "";
                $selected = $programme->slug == request()->input('type') ? "selected" : "";
                @endphp
                <option value="{{$programme->slug}}" {{$selected}}>{{$programme->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col">
              <label for="dateRange" class="d-none">Date Range</label>
              <div class="input-daterange input-group" id="datepicker">
                @php
                $start = Carbon\Carbon::now()->subDays(30)->format("d-m-Y")
                @endphp
                <input type="text" class="form-control form-control-sm" name="start"
                  value="{{request()->input('start') ?? $start}}" />
                <span class="input-group-addon mx-2"> to </span>
                <input type="text" class="form-control form-control-sm" name="end"
                  value="{{request()->input('end') ?? date("d-m-Y") }}" />
              </div>
            </div>
            <div class="form-group col-sm-1 pl-sm-0">
              <button type="submit" class="btn btn-sm btn-info">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
      <!--.collapse-->
      <hr class="mt-0">

      @foreach($latestNews as $latest)
      <div class="module-media-card mb-4 news-card" title="{{$latest->post_title}}">
        <div class="row">
          <div class="col-sm-4">
            <div class="module-media-card-thumbnail">
              <img src="{{asset($latest->post_thumb)}}" class="img-fluid" alt="{{$latest->post_title}}">
            </div>
          </div>
          <div class="col-sm-8">
            <div class="module-media-card-body">
              <h2 class="module-media-card-title">{{$latest->post_title}}</h2>
              <p class="post-date">
                @datetime($latest->updated_at) |
                <a href="{{url($latest->post_type)}}"
                  title="{{strtoupper($latest->post_type)}}">{{$latest->module_name}}</a>
              </p>
              {!! word_limiter($latest->post_excerpt, 35) !!}
            </div>
            <div class="module-media-card-footer">
              <a href="{{url($latest->post_type.'/'.$latest->id.'/'.$latest->post_slug)}}" class="btn-link">Details</a>
            </div>
          </div>
        </div> <!-- .col-sm-6 -->
      </div>
      <!--.row -->
      @endforeach
      <div class="row">
        <div class="col-sm-12">
          {{ $latestNews->appends(array(
                'type' => request()->input("type"),
                'start' => request()->input("start"),
                'end' => request()->input("end"),
              ))->links() }}
        </div>
      </div> <!-- .row -->
    </div> <!-- .col-sm-9 -->
  </div>
  <!--/.row -->
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.css")}}">
@endpush

@push('scripts')
<script src="{{ asset("themes-assets/default/js/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
<script>
  (function ($) {
      $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
      });
    }(jQuery));
</script>
@endpush
