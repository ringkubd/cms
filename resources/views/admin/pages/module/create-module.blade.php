@extends('admin.layouts.app')
@section('title', 'Create new module')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url("admin/dashboard") }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Module</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')
<section class="content">
  <form action="{{ url('admin/module') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-8">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create new Module</h3>
            <a href="{{url("admin/module")}}" class="btn btn-link">Show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" checked> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-9">
                <div class="form-group">
                  <label for="name">Module name</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                    placeholder="Module name">
                  @error('name')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                  <input type="hidden" name="slug" value="{{old('slug')}}" id="slug">
                </div>
                <div class="form-group">
                  <label for="start_form">Start Form</label>
                  <input name="start_form" class="form-control" id="start_form"
                    value="{{old('start_form', date("d-m-Y"))}}">
                  @error('start_form')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                </div>
              </div> <!-- /.col-sm-9-->
              <div class="col-sm-3 pl-0">
                <div class="form-group margin-bottom-none">
                  <label for="start_form" class="invisible">Picture</label>
                  <label for="thumbnail" title="Select Image">
                    <img src="{{asset('img/no-image.png')}}" title="upload profile picture" id="holder"
                      class="img-responsive user-picture" alt="picture">
                  </label>
                  <input type="file" name="picture" class="form-control hidden" id="thumbnail">
                </div>
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="description" class="hide">Description</label>
                  <textarea name="description" class="form-control" id="description">{{ old("description")}}</textarea>
                  @error('description')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Create" title="Create">
              <a href="{{ url('admin/module/create') }}" class="btn btn-danger">Reset</a>
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
      <!--/.col-md-5 -->
    </div>
    <!--/.row -->
  </form>
</section>
@endsection

@section("custom-css-file")
<link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection


{{-- custom script for this page --}}
@section('custom-script')
<script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
<script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script>
  $(document).on("keyup", "#name", function () {
    const name = $(this).val();
    const url = "{{url('/')}}/get-slug-from-title";
    ajax_slug_url(name, url);
  });

  $(document).ready(function () {
    $('#start_form').datepicker({
      format: "dd-mm-yyyy",
      todayBtn: "linked",
      weekStart: 5,
      daysOfWeekHighlighted: "5",
      todayHighlight: true,
    });
    //initialize small text editor
    small_editor("#description", 250);
  });

  function ajax_slug_url(title, ajaxurl) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'POST',
      url: ajaxurl,
      data: {
        'title': title
      },
      success: function (data) {
        $("#slug").val(data);
      },
    });
  }

  $(function () {
    $("#thumbnail").change(function () {
      preview_select_picture(this, "#holder");
    });
  })

</script>
@endsection
