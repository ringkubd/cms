@extends('themes/default/layouts/master')

@inject('home', 'App\Home')
@inject('agent', 'Jenssegers\Agent\Agent')

@section('title', 'Latest Notice of IsDB-BISEW')
@section('m_title', 'Latest Notice of IsDB-BISEW')
@section('m_description', 'Latest Notice of IsDB-BISEW')
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
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
            <a class="item-link" href="{{url("notice")}}">All Notice</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_posts("notice")}}</span>
          </li>
          @foreach($programmes as $programme)
          <li class="item">
            <a class="item-link" href="{{url("notice?type=".$programme->slug)}}">{{$programme->name}}</a>
            <span class="badge badge-secondary float-right m-1">{{$home->count_posts('notice',$programme->slug)}}</span>
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
    @endif
    <div class="col-lg-9 col-md-8 col-sm-7 py-3">
      <h1 class="area-title">
        <span class="title-text">Notice of IsDB-BISEW</span>
        <a href="javascript:void(0)" class="btn-link" data-toggle="collapse" data-target="#filter" aria-expanded="false"
          aria-controls="filter" title="filter">
          <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
      </h1>
      @if(request()->has("start"))
      <a href="{{url("notice")}}" class="btn-link">Clear</a>
      @endif
      @php
      $collapse = request()->has("start") ? "show" : "";
      @endphp
      <div class="collapse {{$collapse}}" id="filter">
        <form action="{{url("notice")}}" method="get">
          <div class="row">
            <div class="form-group col-lg-4 col-md-6 col-sm-12">
              <label for="type" class="d-none">Notice Type</label>
              <select name="type" id="type" class="form-control">
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
                <input type="text" class="form-control" name="start" value="{{request()->input('start') ?? $start}}" />
                <span class="input-group-addon mx-2"> to </span>
                <input type="text" class="form-control" name="end"
                  value="{{request()->input('end') ?? date("d-m-Y") }}" />
              </div>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-12">
              <label for="Submit" class="d-none">submit</label>
              <input type="submit" value="Submit" class="btn btn-success">
            </div>
          </div>
        </form>
      </div>
      <!--.collapse-->

      <div class="post-content notice-page mb-5">
        <ul class="notice-area">
          @foreach($latestNotice as $notice)
          <li class="notice-item">
            <div class="notice-caption">
              <a href="{{url($notice->post_type."/notice/".$notice->id."/".$notice->post_slug)}}"
                title="click for details">
                {{$notice->post_title}}
              </a>
              <span class="date"> @datetime($notice->updated_at)</span>
              <span class="divider">|</span>
              <a href="{{url("notice/?type={$notice->post_type}")}}" class="programme"
                title="click and filter">{{$notice->module_name}}</a>
            </div>
          </li> <!-- /.notice-item -->
          @endforeach
        </ul> <!-- /.notice-area-->
      </div>
      <div class="row">
        <div class="col-sm-12">
          {{ $latestNotice->appends(array(
                'type' => request()->input("type"),
                'start' => request()->input("start"),
                'end' => request()->input("end"),
              ))->links() }}
        </div>
      </div> <!-- .row -->
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
  </div>
  <!--/.row -->
</div> <!-- container -->
@stop

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
