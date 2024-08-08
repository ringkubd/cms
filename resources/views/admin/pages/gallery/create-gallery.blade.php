@extends('admin.layouts.app')

@section('title', 'Add new post')
@inject('admin','App\Admin')

@php
$module = isset($module) ? $module : null;
@endphp
@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">{{$module->name}}</li>
</ol>
@endsection

@section('custom-css-file')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
<link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
@endsection
{{-- main content section strat  --}}
@section('content')
<section class="content">
  <input type="hidden" name="post_type" value="{{ $module->slug }}">
  <input type="hidden" name="module_id" id="module_id" value="{{ $module->id }}">
  <input type="hidden" name="get_url" id="get_url" value="{{ url("/") }}">
  <div class="row">
    <div class="col-md-9">
      <!-- Form Element sizes -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Add new Pictures</h3>
          <a href="{{url("admin/type/photo-gallery")}}" class="btn-link">Show all</a>
        </div>
        <div class="box-body">
          <form method="post" action="{{url('admin/image/upload/store')}}" enctype="multipart/form-data"
            class="dropzone " id="dropzone">
            @csrf
          </form>
        </div> <!-- /.box-body -->
        <div class="box-footer">
          <div class="form-group col-sm-12">
            <input type="button" class="btn btn-green" id="submitUpload" value="Save" name="submit" title="submit">
            <a href="{{url("admin/photo-gallery/create")}}" class="btn btn-danger">Reset</a>
          </div>
        </div>
      </div> <!-- /.box -->
    </div>
    <!--/.col-md-7 -->

    <form action="{{url("admin/image-save")}}" method="POST" id="finalSave">
      @csrf
      {{-- post sidebar are listed here --}}
      <div class="col-sm-3 pl-0">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Publishing Tools</h3>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="col-sm-12">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                    <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Caption</a>
                  </li>
                  <li role="presentation">
                    <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Caption Bangla</a>
                  </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content" style="padding-top: 10px">
                  <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="form-group">
                      <label>
                        <input type="text" class="form-control" name="caption" id="caption" value="{{old('caption')}}"
                          placeholder="Caption">
                      </label>
                      @error('caption')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="form-group">
                      <label>
                        <input type="text" class="form-control" name="caption_bn" id="caption_bn"
                          value="{{old('caption_bn')}}" placeholder="Caption Bangla">
                      </label>
                      @error('caption_bn')
                      <p class="text-danger">{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="radio-inline">
                  <input type="radio" name="post_status" value="publish" class="cheking" checked> Publish
                </label>
                <label class="radio-inline">
                  <input type="radio" name="post_status" value="draft" class="cheking" @if(old("post_status")=='draft' )
                    checked @endif>
                  Draft
                </label>
                <label class="radio-inline">
                  <input type="radio" name="post_status" value="schedule" class="cheking"
                    @if(old("post_status")=='schedule' ) checked @endif> Schedule
                </label>
              </div>
              <div class="form-group col-sm-12 @if(old(" post_status") !='schedule' ) hide @endif" id="scheduleDate">
                <div class="form-group">
                  <div class='input-group dateTimePicker'>
                    <label for="scheduleTime" class="hide"></label>
                    <input type='text' value="{{old("scheduleTime")}}" name="scheduleTime" class="form-control"
                      id="scheduleTime" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="col-sm-12">
                @foreach ($terms as $term)
                @php $taxoModule = 0 @endphp
                <div class="catblock">
                  <h5>{{ $term->name }}</h5>
                  <ul class="post_taxonomy">
                    @foreach ( $admin->find_post_taxonomies($term->slug, $taxoModule, 0) as $item)
                    <li>
                      <label class="checkbox-inline">
                        @php
                        $item = isset($item) ? $item : "";
                        $taxonomyArray = old("taxonomy") ?? array();
                        $checked = in_array($item->id,$taxonomyArray) ? "checked" : ""
                        @endphp
                        <input type="checkbox" name="taxonomy[]" value="{{$item->id}}" {{$checked}}> {{$item->name }}
                      </label>
                      @if (count($admin->find_post_taxonomies($item->term, $taxoModule, $item->id)) > 0)
                      <ul>
                        @foreach ( $admin->find_post_taxonomies($item->term, $taxoModule, $item->id) as
                        $item2)
                        <li>
                          @php
                          $item2 = isset($item2) ? $item2 : "";
                          $checked = in_array($item2->id,$taxonomyArray) ? "checked" : ""
                          @endphp
                          <label class="checkbox-inline">
                            <input type="checkbox" name="taxonomy[]" value="{{$item2->id}}" {{$checked}}>
                            {{$item2->name}}
                          </label>

                          @if (count($admin->find_post_taxonomies($item2->term, $taxoModule,
                          $item2->id)) > 0)
                          <ul>
                            @foreach ( $admin->find_post_taxonomies($item2->term, $taxoModule,
                            $item2->id) as $item3)
                            <li>
                              @php
                              $item3 = isset($item3) ? $item3 : "";
                              $checked = in_array($item3->id,$taxonomyArray) ? "checked" : "";
                              @endphp
                              <label class="checkbox-inline">
                                <input type="checkbox" name="taxonomy[]" value="{{$item3->id}}" {{$checked}}>
                                {{$item3->name}}
                              </label>
                            </li>
                            @endforeach
                          </ul>
                          @endif
                        </li>
                        @endforeach
                      </ul>
                      @endif
                    </li>
                    @endforeach
                  </ul>
                </div>
                @endforeach
              </div>
            </div> <!-- /.row -->
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-5 -->
    </form>
  </div>
  <!--/.row -->
</section>
@endsection


@section('custom-script')
<script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
<script type="text/javascript">
  $("#submitUpload").click(function () {
      $("#finalSave").submit();
    });

    Dropzone.options.dropzone =
      {
        maxFilesize: 15000000, // MB
        init: function() {
          this.on("uploadprogress", function(file, progress) {
            console.log("File progress", progress);
          });
        },
        renameFile: function (file) {
          const dt = new Date();
          const time = dt.getTime();
          return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        timeout: 60000,
        removedfile: function (file) {
          const name = file.upload.filename;
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/admin/image/delete',
            data: {filename: name},
            success: function (data) {
              console.log("File has been successfully removed!!");
            },
            error: function (e) {
              console.log(e);
            }
          });
          var fileRef;
          return (fileRef = file.previewElement) != null ?
            fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },
        success: function (file, response) {
          console.log(response);
        },
        error: function (file, response) {
          return false;
        }
      };

    $(function () {
      $(".cheking").click(function () {
        const checkStatus = $(this).val();
        if (checkStatus === "schedule") {
          $("#scheduleDate").removeClass("hide");
        } else if (checkStatus === "new") {
          $("#for_New_upload").removeClass("hide");
          $("#for_old_upload").addClass("hide");
        } else if (checkStatus === "from_old") {
          $("#for_old_upload").removeClass("hide");
          $("#for_New_upload").addClass("hide");
        } else if (checkStatus === "off") {
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