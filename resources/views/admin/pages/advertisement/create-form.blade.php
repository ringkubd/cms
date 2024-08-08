@extends('admin.layouts.app')

@section('title', 'Add new Advertisement')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Advertisement</li>
</ol>
@endsection

<!--main content section start-->
@section('content')
<section class="content">
  <form action="{{ url("admin/advertisement") }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-9">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add new Advertisement</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a href="#english" data-toggle="tab">English</a>
                    </li>
                    <li>
                      <a href="#bangla" data-toggle="tab">Bangla</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="active tab-pane" id="english">
                      <div class="form-group">
                        <label for="title_en" class="hide">Title English</label>
                        <input type="text" name="title_en" value="{{old('title_en')}}" class="form-control"
                          id="title_en" placeholder="Advertisement title English">
                        @error('title_en')
                        <p class="text-danger margin-bottom-none">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="article_en" class="hide">Article English</label>
                        <textarea name="article_en" id="article_en"
                          class="form-control editor">{{old('article_en')}}</textarea>
                        @error('article_en')
                        <p class="text-danger margin-bottom-none">{{$message}}</p>
                        @enderror
                      </div>
                    </div> <!-- /.tab-pane -->
                    <div class="tab-pane" id="bangla">
                      <div class="form-group">
                        <label for="title_bn" class="hide">Title Bangla</label>
                        <input type="text" name="title_bn" id="title_bn" value="{{old('title_bn')}}"
                          class="form-control" placeholder="Advertisement title Bangla">
                        @error('title_bn')
                        <p class="text-danger margin-bottom-none">{{$message}}</p>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label for="article_bn" class="hide">Article Bangla</label>
                        <textarea name="article_bn" id="article_bn"
                          class="form-control editor">{{old('article_bn')}}</textarea>
                        @error('article_bn')
                        <p class="text-danger margin-bottom-none">{{$message}}</p>
                        @enderror
                      </div>
                    </div> <!-- /.tab-pane -->
                  </div> <!-- /.tab-content -->
                </div> <!-- /.nav-tabs-custom -->
              </div> <!-- /.col-sm-12 -->
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-12">
                <input type="submit" class="btn btn-green" value="Save" name="submit" title="submit">
                <a href="{{ url("admin/advertisement/create") }}" class="btn btn-danger">Reset</a>
              </div>
            </div> <!-- /.row -->
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-7 -->

      <!-- post sidebar are listed here-->
      <div class="col-sm-3 pl-0">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Publishing Tools</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="radio-inline">
                  <?php $publish = (old("post_status") == "publish") ? "checked" : "checked" ?>
                  <input type="radio" name="post_status" value="publish" class="checking" {{$publish}}>
                  Publish
                </label>
                <label class="radio-inline">
                  <?php $draft = (old("post_status") == "draft") ? "checked" : "" ?>
                  <input type="radio" name="post_status" value="draft" class="checking" {{$draft}}>
                  Draft
                </label>
                <label class="radio-inline">
                  <?php $schedule = (old("post_status") == "schedule") ? "checked" : "" ?>
                  <input type="radio" name="post_status" value="schedule" class="checking" {{$schedule}}>
                  Schedule
                </label>
              </div>
              <?php $schedule = (old("post_status") == "schedule") ? "" : "hide" ?>
              <div class="form-group col-sm-12 {{$schedule}}" id="scheduleDate">
                <div class="form-group">
                  <div class='input-group dateTimePicker'>
                    <label for="scheduleTime" class="hide">Schedule time</label>
                    <input type='text' value="{{old("scheduleTime")}}" name="scheduleTime" class="form-control"
                      id="scheduleTime" />
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="start_time" class="h5 m-0">Start time</label>
                <div class='input-group dateTimePicker'>
                  <input type="text" name="start_time" value="{{old("start_time")}}" class="form-control"
                    id="start_time" />
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                </div>
              </div> <!-- .form-group -->
              <div class="form-group col-sm-12">
                <label for="end_time" class="h5 m-0">End time</label>
                <div class='input-group dateTimePicker'>
                  <input type="text" name="end_time" value="{{old("end_time")}}" class="form-control" id="end_time" />
                  <div class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </div>
                </div>
              </div> <!-- .form-group -->
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-12">
                <h5 class="m-0">Options</h5>
                <label class="checkbox-inline">
                  <input type="checkbox" name="home_page" id="home_page" value="1">
                  Enable on Home Page
                </label>
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="modules" class="h5 m-0">Module</label>
                <ul class="post_taxonomy formate">
                  @foreach ($modules as $module)
                  @php
                  $module = isset($module) ? $module : "";
                  $moduleArr = old("modules") ?? array();
                  $checked = in_array($module->id, $moduleArr ) ? "checked" : "";
                  @endphp
                  <li>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="modules[]" id="modules" value="{{$module->id}}" {{$checked}}>
                      {{$module->name }}
                    </label>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div> <!-- /.row -->

            <div class="row">
              <div class="form-group col-sm-12">
                <h5 class="m-0">Thumbnail</h5>
                <label class="radio-inline">
                  @php
                  $upload_type = (old("upload_type") == "new") ? "checked" : "checked";
                  @endphp
                  <input type="radio" name="upload_type" value="new" class="checking" {{$upload_type}}>
                  New Upload
                </label>
                <label class="radio-inline">
                  @php
                  $from_old = (old("upload_type") == "from_old") ? "checked" : "";
                  @endphp
                  <input type="radio" name="upload_type" value="from_old" class="checking" {{$from_old}}>
                  From Old
                </label>
                <label class="radio-inline">
                  @php
                  $thumb_status = (old("upload_type") == "off") ? "checked" : "";
                  @endphp
                  <input type="radio" name="upload_type" value="off" class="checking" {{$thumb_status}}>
                  Off
                </label>
              </div>
              @php
              $from_old = (old("upload_type") == "from_old") ? "hide" : "";
              @endphp
              <div class="form-group col-sm-12 {{$from_old}}" id="for_New_upload">
                <label title="Select Image">
                  <input type="file" name="newPicture" value="{{old("newPicture")}}">
                </label>
              </div>
              @php
              $from_old = (old("upload_type") == "from_old") ? "" : "hide";
              @endphp
              <div class="form-group col-sm-12 {{$from_old}}" id="for_old_upload">
                <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder"
                  title="Select Image">
                  @if(old("picture"))
                  <img src="{{asset(old("picture"))}}" title="select picture" id="holder"
                    class="img-responsive user-picture m-0" alt="select picture">
                  @else
                  <img src="{{asset($editItem["picture"] ?? 'img/no-image.gif')}}" title="select picture" id="holder"
                    class="img-responsive user-picture m-0" alt="select picture">
                  @endif
                </label>
                <label for="thumbnail" class="hide">thumbnail</label>
                <input type="text" name="picture" value="{{old("picture")}}" class="hidden" id="thumbnail">
              </div>
            </div> <!-- /.row -->
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-5 -->
    </div>
    <!--/.row -->
  </form>
</section>
@endsection


@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
@endsection

@section('custom-script')
<script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
<script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
<script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
<script>
  $(document).ready(function () {
      simple_editor(".editor", 450);
    });

    $(function () {
      $(".checking").click(function () {
        const status = $(this).val();
        if (status === "schedule") {
          $("#scheduleDate").removeClass("hide");
        } else if (status === "new") {
          $("#for_New_upload").removeClass("hide");
          $("#for_old_upload").addClass("hide");
        } else if (status === "from_old") {
          $("#for_old_upload").removeClass("hide");
          $("#for_New_upload").addClass("hide");
        } else if (status === "off") {
          $("#for_old_upload").addClass("hide");
          $("#for_New_upload").addClass("hide");
        } else {
          $("#scheduleDate").addClass("hide");
        }
      });

      // date time picker
      const dateNow = new Date();
      $('.dateTimePicker').datetimepicker({
        format: "DD-MM-YYYY hh:mm a",
        defaultDate: dateNow,
        useCurrent: false
      });

    })

</script>

@endsection