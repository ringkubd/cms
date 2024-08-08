@extends('admin.layouts.app')

@section('title', "Edit Note - {$note->note_title}")


@inject('admin','App\Admin')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Notes</li>
  </ol>
@endsection

@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
@endsection

@section('content')
  <section class="content">
    <form action="{{ url("admin/note/{$note->id}") }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <input type="hidden" name="note_type" value="notes">
      <div class="row">
        <div class="col-md-9">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Your Note</h3>
              <a href="{{url('admin/note')}}" class="btn-link">Show all</a>
            </div>
            <div class="box-body">
              <div class="form-group">
                <label for="title" class="sr-only">Note Title</label>
                <input type="text" name="note_title" value="{{old('note_title', $note->note_title)}}" class="form-control"
                       id="title" placeholder="Note Title">
                @error('note_title')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="description" class="sr-only">Note Details</label>
                <textarea name="note_content" id="description"
                          class="form-control editor">{{old('note_content', $note->note_content)}}</textarea>
                @error('note_content')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="row">
                <div class="form-group col-sm-12">
                  <input type="submit" class="btn btn-green" value="Save" title="submit">
                  <input type="reset" class="btn btn-danger" value="Reset" title="Reset">
                </div>
              </div>
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div>
        <!--/.col-md-7 -->

        {{-- post sidebar are listed here --}}
        <div class="col-sm-3 pl-0">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Publishing Tools</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="radio-inline">
                    <input type="radio" name="note_status" value="publish" class="checking" checked>
                    Publish
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="note_status" value="draft" class="checking"
                           @if(old('note_status', $note->note_status) == 'draft') checked @endif>
                    Draft
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="note_status" value="schedule" class="checking"
                           @if(old('note_status', $note->note_status) == 'schedule') checked @endif>
                    Schedule
                  </label>
                </div>
                <div class="form-group col-sm-12 @if(old('note_status', $note->note_status) !== 'schedule') hide @endif" id="scheduleDate">
                  <div class="form-group">
                    <div class='input-group dateTimePicker'>
                      <label for="scheduleTime" class="hide"></label>
                      <input type='text' value="{{old("scheduleTime")}}" name="scheduleTime" class="form-control"
                             id="scheduleTime"/>
                      <div class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div> <!-- /.row -->
              <div class="row">
                <div class="form-group col-sm-12">
                  <h5>Note date</h5>
                  <div class='input-group dateTimePicker'>
                    <label for="created_at" class="sr-only">Created At</label>
                    @php
                      $created_at = \Carbon\Carbon::parse($note->created_at)->format('d-m-Y h:i a');
                    @endphp
                    <input type='text' name="created_at" id="created_at" value="{{ old("created_at") ?? $created_at }}"
                           class="form-control"/>
                    <div class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </div>
                  </div>
                </div>
              </div> <!-- /.row -->
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div> <!-- .col-md-5 -->
      </div> <!-- .row -->
    </form>
  </section>
@endsection


@section('custom-script')
  <script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
  <script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
  <script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
  <script>
    const url = $("#get_url").val();
    const options = {
      filebrowserImageBrowseUrl: url + '/file-manager?type=Images',
      filebrowserImageUploadUrl: url + '/file-manager/upload?type=Images&_token=',
      filebrowserBrowseUrl: url + '/file-manager?type=files',
      filebrowserUploadUrl: url + '/file-manager/upload?type=files&_token=',
      height: 350,
    };
    // image preview
    $('#customFile').filemanager('Images');
    $('#videoFile').filemanager('files');
    $('#localAudioAddOn').filemanager('files');
    $('#localFileAddOn').filemanager('files');

    $(document).ready(function () {
      simple_editor(".editor", 450);
    });


    $(document).on("keyup", "#title", function () {
      const title = $(this).val();
      const ajaxUrl = '/get-slug-from-title';
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: ajaxUrl,
        data: {
          'title': title
        },
        success: function (data) {
          $("#slug").val(data);
          $(".slugSpan").html(data);
        },
      });
    });


    $(function () {
      $("#editslug").click(function () {
        $("#slug").removeClass("hide").focus();
        $(".slugSpan").addClass("hide")
      });
      $("#slug").blur(function () {
        const title = $(this).val();
        const ajaxUrl = '/get-slug-from-title';
        ajax_slug_url(title, ajaxUrl);
        $(this).addClass("hide");
        $(".slugSpan").removeClass("hide")
      });


      $(".checking").click(function () {
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

      function check_uncheck(checkId, value = "") {
        if ($(checkId).is(":checked")) {
          if (value === "attached") {
            $("#attached").removeClass("hide");
          } else if (value === "option") {
            $("#option").removeClass("hide");
          } else if (value === "excerpt") {
            $("#excerpt").removeClass("hide");
          } else if (value === "popup") {
            $("#popup").removeClass("hide");
          } else if (value === "comments") {
            $("#comments").removeClass("hide");
          } else if (value === "stories") {
            $("#stories").removeClass("hide");
          }
        }
        if (!$(checkId).is(":checked")) {
          if (value === "attached") {
            $("#attached").addClass("hide");
          } else if (value === "option") {
            $("#option").addClass("hide");
          } else if (value === "excerpt") {
            $("#excerpt").addClass("hide");
          } else if (value === "popup") {
            $("#popup").addClass("hide");
          } else if (value === "comments") {
            $("#comments").addClass("hide");
          } else if (value === "stories") {
            $("#stories").addClass("hide");
          }
        }
      }

      const attachment = $(".attachment");
      attachment.each(function () {
        const value = $(this).val();
        check_uncheck(this, value);
      });
      attachment.click(function () {
        const value = $(this).val();
        check_uncheck(this, value);
      });

      $(document).on("click", ".path", function () {
        const current = $(this);
        const value = $(this).val();
        if (current.is(":checked")) {
          if (value === "video") {
            $("#attVideo").removeClass("hide");
          }
          if (value === "audio") {
            $("#attAudio").removeClass("hide");
          }
          if (value === "file") {
            $("#attFile").removeClass("hide");
          }
        }
        if (!current.is(":checked")) {
          if (value === "video") {
            $("#attVideo").addClass("hide");
          }
          if (value === "audio") {
            $("#attAudio").addClass("hide");
          }
          if (value === "file") {
            $("#attFile").addClass("hide");
          }
        }
        if (value === "local") {
          $("#youtubePath").addClass("hide");
          $("#localPath").removeClass("hide");
        }
        if (value === "youtube") {
          $("#localPath").addClass("hide");
          $("#youtubePath").removeClass("hide");
        }
        if (value === "localAudio") {
          $("#localAudio").removeClass("hide");
          $("#otherAudioPath").addClass("hide");
        }
        if (value === "otherAudio") {
          $("#otherAudioPath").removeClass("hide");
          $("#localAudio").addClass("hide");
        }
        if (value === "localFile") {
          $("#localFile").removeClass("hide");
          $("#otherFile").addClass("hide");
        }
        if (value === "otherFile") {
          $("#otherFile").removeClass("hide");
          $("#localFile").addClass("hide");
        }
      });
    });
  </script>
@endsection
