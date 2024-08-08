@extends('admin.layouts.app')

@section('title', 'Create new widget group')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li>widget</li>
  <li>widget-group</li>
  <li class="active">Create widget-group</li>
</ol>
@endsection

@section('content')
<section class="content">
  <form action="{{ url("admin/widget-group/{$WiGroup->id}") }}" method="POST">
    @method("put")
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit - {{$WiGroup->name}}</h3>
            <a href="{{url('admin/widget-group')}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="form-group">
              <label class="checkbox-inline">
                <input type="checkbox" name="active" value="1" @if($WiGroup->active == 1) checked @endif> Active
              </label>
            </div>
            <div class="form-group">
              <label for="name">Wdget Group Name <span class="text-danger">*</span></label>
              <input type="text" name="name" value="{{old('name', $WiGroup->name)}}" class="form-control" id="name"
                placeholder="widget group name">
              @error('name')
              <p class="text-danger margin-bottom-none">{{$message}}</p>
              @enderror
            </div>
            <div class="form-group">
              <label for="description">Wdget Group Description</label>
              <textarea name="description" raw="4" id="description" class="form-control"
                placeholder="Wdget Group">{{old('description', $WiGroup->description)}}</textarea>
              @error('description')
              <p class="text-danger margin-bottom-none">{{$message}}</p>
              @enderror
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="submit">
              <a href="{{url("admin/widget-group/{$WiGroup->id}/edit")}}" class="btn btn-danger">Reset</a>
            </div>
          </div> <!-- .box-body -->
        </div> <!-- .box -->
      </div> <!-- .col-md-7 -->

      <div class="col-sm-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Help</h3>
          </div>
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Wdget Group Name</strong>
            <p class="text-muted">
              This is the name of Wdget Group. Required field
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Wdget Group Description</strong>
            <p class="text-muted">
              This is the short descriptions of the Wdget Group. It is optional to input. You can fill it for more
              information help you letter.
            </p>
            <hr>
          </div> <!-- .box-body -->
        </div> <!-- .box -->
      </div> <!-- .col-md-5 -->
    </div> <!-- .row -->
  </form>
</section>
@endsection
