@extends('admin.layouts.app')

@section('title', 'Direct artisan command page')

{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Access control</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      @php
      $unique = \App\Admin::unique_user();
      @endphp
      @if(cache()->has($unique."artisan"))
      <div class="alert alert-info alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <p><i class="icon fa fa-warning"></i> {{cache()->get($unique."artisan")}}</p>
      </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-4 col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Caching</h3>
        </div>
        <div class="box-body">
          <a href="{{url("admin/artisan/cache/route")}}" class="btn btn-block btn-green" title="Route Caching">Route
            Caching</a>
          <a href="{{url("admin/artisan/cache/view")}}" class="btn btn-block btn-facebook" title="View Caching">View
            Caching</a>
          <a href="{{url("admin/artisan/cache/config")}}" class="btn btn-block btn-linkedin"
            title="Config Caching">Config Caching</a>
          <a href="{{url("admin/artisan/cache/all")}}" class="btn btn-block btn-tumblr" title="All Caching">All
            Caching</a>
        </div>
      </div> <!-- /.box -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Database Seed</h3>
        </div>
        <div class="box-body">
          @php $app_key = slug_url(env('APP_KEY'),"-"); @endphp
          <a href="{{url("admin/artisan/migrateRefresh/{$app_key}")}}" class="btn btn-block btn-linkedin"
            title="Migration Refresh">Migration
            Refresh</a>
          <a href="{{url("admin/artisan/migrate-seed/{$app_key}")}}" class="btn btn-block btn-linkedin"
            title="Migration Refresh with Seed">Migration Refresh with Seed</a>
          <a href="{{url("admin/artisan/db-seed/{$app_key}")}}" class="btn btn-block btn-linkedin"
            title="Database Seed">Database Seed</a>
        </div>
      </div> <!-- /.box -->
    </div>
    <!--/.col-md-4 -->
    <div class="col-md-4 col-sm-12">
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Clear Caching</h3>
        </div>
        <div class="box-body">
          <a href="{{url("admin/artisan/clear-cache/route")}}" class="btn btn-block btn-green" title="Route Clear">Route
            Clear</a>
          <a href="{{url("admin/artisan/clear-cache/view")}}" class="btn btn-block btn-facebook" title="View Clear">View
            Clear</a>
          <a href="{{url("admin/artisan/clear-cache/config")}}" class="btn btn-block btn-linkedin"
            title="Config Clear">Config Clear</a>
          <a href="{{url("admin/artisan/clear-cache/all")}}" class="btn btn-block btn-tumblr" title="All Clear">All
            Clear</a>
        </div>
      </div> <!-- /.box -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">Maintenance</h3>
        </div>
        <div class="box-body">
          @php $app_key = slug_url(env('APP_KEY'),"-"); @endphp
          <a href="{{url("admin/artisan/down/{$app_key}")}}" class="btn btn-block btn-danger" title="Site Down">Site
            Down</a>
          <a href="{{url("admin/artisan/up/{$app_key}")}}" class="btn btn-block btn-green" title="Site Up">Site Up</a>
        </div>
      </div> <!-- /.box -->
    </div>
    <!--/.col-md-4 -->

  </div>
  <!--/.row -->
</section>
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
@endsection
