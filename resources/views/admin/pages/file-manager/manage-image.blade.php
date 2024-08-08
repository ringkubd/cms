@extends('admin.layouts.app')

@section('title', 'Manage Image')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">File manager</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <iframe src="{{ url("file-manager?type=images")}}"
        style="width: 100%; height: 550px; overflow: hidden; border: 0px solid #ccc;"></iframe>
    </div>
    <!--/.col-md-7 -->
  </div>
  <!--/.row -->

</section>
@endsection