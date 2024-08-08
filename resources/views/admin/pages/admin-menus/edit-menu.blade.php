@extends('admin.layouts.app')

@section('title', 'Edit Admin menu')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Admin menu</li>
</ol>
@endsection
@php
$menu = isset($menu) ? $menu : "";
@endphp
{{-- main content section strat  --}}
@section('content')
<section class="content">
  <form action="{{ url("admin/admin-menu/{$menu->id}") }}" method="POST">
    @csrf
    @method("PUT")
    <div class="row">
      <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Admin menu</h3>
            <a href="{{url("admin/admin-menu")}}" class="btn-link">Show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                @php
                $active = $menu->active == 1 ? 'checked' : '';
                $visibility = $menu->visibility == 1 ? 'checked' : '';
                @endphp
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" {{ $active}}> Active
                </label>
                <label class="checkbox-inline">
                  <input type="checkbox" name="visibility" value="1" {{ $visibility}}> Visible
                </label>
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="name">Menu name</label>
                <input type="text" name="name" value="{{ old("name") ?? $menu->name}}" class="form-control" id="name"
                  placeholder="Menu name">
                @error('name')
                <p class="text-danger margin-bottom-none">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group col-sm-6">
                <label for="icon">Menu Icon (Font awesome)</label>
                <input type="text" name="icon" value="{{old("icon") ?? $menu->icon}}" class="form-control" id="icon"
                  placeholder="fa-icon">
                @error('icon')
                <p class="text-danger margin-bottom-none">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="route_uri">Route URL</label>
                <input type="text" name="route_uri" value="{{old("icon") ?? $menu->route_uri}}" class="form-control"
                  id="route_uri" placeholder="Route URL">
                @error('route_uri')
                <p class="text-danger margin-bottom-none">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group col-sm-6">
                <label for="method">Method</label>
                <select name="route_method" id="method" class="form-control shortoption">
                  @php
                  $get = old("method") ?? $menu->method == "GET" ? "selected" : "";
                  $post = old("method") ?? $menu->method == "POST" ? "selected" : "";
                  $put = old("method") ?? $menu->method == "PUT" ? "selected" : "";
                  $delete = old("method") ?? $menu->method == "DELETE" ? "selected" : "";
                  @endphp
                  <option value="GET" {{$get}}>GET</option>
                  <option value="POST" {{$post}}>POST</option>
                  <option value="PUT" {{$put}}>UPDATE</option>
                  <option value="DELETE" {{$delete}}>DELETE</option>
                </select>
                @error('method')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="parent_id">Menu parent</label>
                <select name="parent_id" id="parent_id" class="form-control longoption">
                  <option value="0">none</option>
                  @foreach ($parents as $item)
                  @php
                  $item = isset($item) ? $item : "";
                  $selected = old("icon") ?? $menu->parent_id == $item->id ? "selected" : "";
                  @endphp
                  <option value="{{$item->id}}" {{$selected}}>{{"$item->id. $item->name"}}</option>
                  @endforeach
                </select>
                @error('parent_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3" maxlength="400" class="form-control"
                  placeholder="description">{{$menu->description}}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group col-sm-12">
                <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="Update">
                <a href="{{ url("admin/admin-menu/{$menu->id}/edit") }}" class="btn btn-danger"
                  title="Reset form">Reset</a>
              </div>
            </div> <!-- /.row -->

          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-8 -->
      <div class="col-sm-4">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Help</h3>
          </div>
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Menu name</strong>
            <p class="text-muted">
              Menu name is the visible name of the menu. we can modify Menu name in anytime. Menu name
              must be a relevend name.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Menu name (Bangla)</strong>
            <p class="text-muted">
              Menu name (Bangla) is optional. It is helpfull for Bangla language settings.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Route URL</strong>
            <p class="text-muted">
              Route URL Laravel Routing URL. You can set only the name of the Route URL. Example
              <b>something/{id}/edit</b>
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Route Action</strong>
            <p class="text-muted">
              Route Action is the Laravel Route Action. You can set Route action controller. Example
              <b>Controller@method</b>
            </p>
            <hr>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-4 -->

    </div>
    <!--/.row -->
  </form>
</section>
@endsection

{{-- custom style for this page --}}
@section('custom-css-file')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<!-- Select2 -->
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
  $(function () {
        $('.longoption').select2();
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        })
    })

</script>
@endsection