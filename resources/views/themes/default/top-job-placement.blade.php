@extends('themes/default/layouts/master')

@inject('home', 'App\Home')

@section('title', 'Top Job Placement')
@section('m_title', 'Top Job Placement')
@section('m_description', limiter($home->get_settings('meta_desc'), 180))
@section('m_image', asset($home->get_settings('meta_picture')))

@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-9 col-md-7 col-sm-6 py-3">
      <h1 class="area-title mb-2">
        <span class="title-text">Top Job Placement</span>
      </h1>
      <table class="table table-responsive-sm table-bordered table-striped text-center" style="color: #555;">
        <tr>
          <th>SL</th>
          <th>Picture</th>
          <th>Name</th>
          <th>Course</th>
          <th>Round</th>
          <th>Position</th>
          <th>Company</th>
        </tr>
        @foreach($topPlacements as $placement)
        <tr class="valign-center">
          <td>{{$loop->iteration}}</td>
          <td style="width:130px">
            <img src="{{asset(thumbs_url($placement->profile_image))}}" class="img-fluid" alt="{{$placement->name}}">
          </td>
          <td style="width:170px">
            {{$placement->name}}
          </td>
          <td>
            {{$placement->subject->subject_name ?? ""}}
          </td>
          <td style="width:80px">
            {{$placement->round->name ?? ""}}
          </td>
          <td>
            {{$placement->position->position_name ?? ""}}
          </td>
          <td>
            {{$placement->company->name ?? ""}}
          </td>
        </tr>
        @endforeach
      </table>
      {{$topPlacements->links()}}
    </div> <!-- .col-sm-8 -->
    <div class="col-md-3 col-sm-5 py-3">
      <h1 class="area-title">
        <span class="title-text">News and Events</span>
      </h1>
      <div class="news-event-card mb-4">
        <ul class="news-list">
          @foreach($notices as $notice)
          @php
          $notice = isset($notice) ? $notice : "";
          $link = url($notice->post_type."/notice/".$notice->id."/".$notice->post_slug);
          @endphp
          <li>
            <span>@datetime($notice->updated_at) | {{$notice->module_name}}</span>
            <a href="{{$link}}">{{$notice->post_title}}</a>
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

    </div>
    <!--.col-sm-3 -->
  </div> <!-- .row -->
</div> <!-- .container -->
@endsection
