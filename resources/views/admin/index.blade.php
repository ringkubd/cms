@extends('admin.layouts.app')

@section('title', 'Welcome to super admin pannel')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">User</li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Form Element sizes -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Welcome Mr. {{Auth::user()->firstName." ".Auth::user()->LastName}}</h3>
        </div>
        <div class="box-body">
          @php
          $role = Auth()->user()->role()->first()->name ?? "not set";
          @endphp
          <p>You are the Role of {{$role}}</p>
        </div> <!-- .box-body -->
        <div class="box-footer clearfix">
        </div> <!-- .box box-footer -->
      </div> <!-- .box -->
    </div> <!-- .col-md-7 -->
  </div> <!-- .row -->
</section>

@endsection
