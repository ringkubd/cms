@extends('admin.layouts.app')

@section('title', 'Updated selected module')

@section('page-title', "")

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url("admin/dashboard") }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Module</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')
<section class="content">
  <form action="{{ url("admin/module/{$module->id}") }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="row">
      <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create new module</h3>
            <a href="{{url("admin/module/create")}}" class="btn btn-link">Create new</a>
            <a href="{{url("admin/module")}}" class="btn btn-link">Show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" {{ ($module->active == 1 ) ? "checked" : ""}}> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <div class="form-group">
                  <label for="name">Module name</label>
                  <input type="text" name="name" value="{{ old('name') ?? $module->name}}" class="form-control"
                    id="name" placeholder="Module name">
                  @error('name')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                  <input type="hidden" name="slug" value="{{ $module->slug}}">
                </div>
                <div class="form-group">
                  <label for="start_form">Start Form</label>
                  @php
                  $date = \Carbon\Carbon::parse($module->start_form)->format("d-m-Y");
                  @endphp
                  <input name="start_form" class="form-control" id="start_form" value="{{old('start_form', $date )}}">
                  @error('start_form')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                </div>
              </div> <!-- /.col-sm-9-->
              <div class="col-sm-3">
                <div class="nav-tabs-custom margin-bottom-none">
                  <ul class="nav nav-tabs" id="myTabs">
                    <li class="active">
                      <a href="#tab_1" data-toggle="tab" aria-key="old" aria-expanded="true">Old</a>
                    </li>
                    <li class="">
                      <a href="#tab_2" data-toggle="tab" aria-key="new">New</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <input type="hidden" name="picKey" id="picKey" value="old">
                    <div class="tab-pane active" id="tab_1">
                      <div class="form-group margin-bottom-none">
                        <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder"
                          title="Select Image">
                          <img src="{{asset($module->picture)}}" id="holder" class="img-responsive user-picture">
                        </label>
                        <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                      </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                      <div class="form-group margin-bottom-none">
                        <label for="newPicture" title="Select Image">
                          <img src="{{asset("img/no-image.png")}}" id="new-holder" class="img-responsive user-picture">
                        </label>
                        <input type="file" name="newPicture" class="form-control hidden" id="newPicture">
                      </div>
                    </div> <!-- /.tab-pane -->
                  </div> <!-- /.tab-content -->
                </div>
              </div> <!-- .col-sm-3 -->
            </div> <!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <textarea name="description" class="form-control"
                    id="description">{{ old("description", $module->description)}}</textarea>
                  @error('description')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                </div>
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Update" title="Update">
              <a href="{{ url("admin/module/{$module->id}/edit") }}" class="btn btn-danger">Reset</a>
            </div>

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
            <strong><i class="fa fa-book margin-r-5"></i> Module name</strong>
            <p class="text-muted">
              Fill the module name for managing content by module.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Upload Picture</strong>
            <p class="text-muted">
              Upload picture format as jpeg, jpg, png, gif. Picture size must be lower than 1mb.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Description</strong>
            <p class="text-muted">
              Why you use this module, Note about that in this Description fild in 400 workds.
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
@section("custom-css-file")
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css">
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

{{-- custom script for this page --}}
@section('custom-script')
<script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
<script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
<script>
  $(function () {
      // image preview
      $("#newPicture").change(function () {
        preview_select_picture(this, "#new-holder");
      });

      $('#customFile').filemanager('image');

      $('#start_form').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
      });

      //initialize small text editor
      small_editor("#description", 250);


    })
</script>
@endsection