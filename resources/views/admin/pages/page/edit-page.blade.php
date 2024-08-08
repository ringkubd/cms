@extends('admin.layouts.app')

@section('title', "Edit Page {$post->post_title}")

@section('page-title', "Edit Page")

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Edit Page</li>
  </ol>
@endsection

{{-- main content section strat  --}}
@section('content')
  <section class="content">
    <form action="{{ url("admin/page/{$post->id}") }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <input type="hidden" name="post_type" value="page">
      <div class="row">
        <div class="col-md-9">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Page</h3>
              <a href="{{url("admin/page/create")}}" class="btn-link">Create new</a>
              <a href="{{url("admin/page")}}" class="btn-link">Show all</a>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active">
                        <a href="#english" data-toggle="tab">English</a>
                      </li>
                      <li><a href="#bangla" data-toggle="tab">Bangla</a></li>
                    </ul>
                    <div class="tab-content">
                      <div class="active tab-pane" id="english">
                        <div class="form-group">
                          <input type="text" name="titleEnglish" value="{{ old('titleEnglish',$post->post_title) }}"
                                 class="form-control" id="title" placeholder="post title"
                                 ajax-url="{{url("get-slug-from-title")}}">
                          @error('titleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <span>URL: </span>
                          <a href="javascript:" id="editslug" title="click to edit">{{ url("/")}}/<span
                              class="slugSpan">{{$post->post_slug ?? old('post_slug')}}</span></a>
                          <input type="text" name="post_slug" class="hide" value="{{old('post_slug',$post->post_slug)}}"
                                 id="slug" style="width: 250px;">
                          @error('post_slug')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                        <textarea name="articleEnglish"
                                  class="form-control editor">{!! $post->post_content ?? old('articleEnglish') !!}</textarea>
                          @error('articleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                      </div> <!-- /.tab-pane -->
                      <div class="tab-pane" id="bangla">
                        <div class="form-group">
                          <input type="text" name="titleBangla" value="{{old('titleBangla',$post->post_title_bn)}}"
                                 class="form-control" placeholder="post title" ajax-url="{{url("get-slug-from-title")}}">
                          @error('titleBangla')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <div>URL:</div>
                          {{ url("/")}}/bn/
                          <div class="slugSpan">{{ $post->post_slug ?? old('post_slug')}}</div>
                        </div>
                        <div class="form-group">
                        <textarea name="articleBangla"
                                  class="form-control editor">{!! old('articleBangla',$post->post_content_bn) !!}</textarea>
                          @error('articleBangla')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                      </div> <!-- /.tab-pane -->
                    </div> <!-- /.tab-content -->
                  </div> <!-- /.nav-tabs-custom -->
                </div> <!-- /.col-sm-12 -->
              </div> <!-- /.row -->

              {{-- attachement option --}}
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline" title="check to show post excerpt field">
                    <?php $excerpt = $post->post_excerpt ? "checked" : "" ?>
                    <input type="checkbox" name="excerpt" class="attachment" value="excerpt" {{$excerpt}}>Post Excerpt
                  </label>
                  <label class="checkbox-inline" title="check to show attachment">
                    <?php $attached = $post->attachment_status ? "checked" : "" ?>
                    <input type="checkbox" name="attached" class="attachment" value="attached" {{$attached}}>Attachment
                  </label>
                  <label class="checkbox-inline" title="Check to show other options">
                    <?php $option = $post->option_status ? "checked" : "" ?>
                    <input type="checkbox" name="option" class="attachment" value="option" {{ $option }}> Other Options
                  </label>
                </div>
              </div>
              <hr class="m-0">
              <div class="row">
                <div id="excerpt" class="hide">
                  <div class="col-sm-12">
                    <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                        <li class="active">
                          <a href="#excerpt-english" data-toggle="tab">Excerpt English</a>
                        </li>
                        <li><a href="#excerpt-bangla" data-toggle="tab">Excerpt Bangla</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="active tab-pane" id="excerpt-english">
                          <div class="form-group">
                          <textarea name="excerptEnglish" rows="3" class="form-control"
                                    placeholder="excerpt-english">{!! old('excerptEnglish', $post->post_excerpt) !!}</textarea>
                            @error('excerptEnglish')
                            <p class="text-danger margin-bottom-none">{{$message}}</p>
                            @enderror
                          </div>
                        </div> <!-- /.tab-pane -->
                        <div class="tab-pane" id="excerpt-bangla">
                          <div class="form-group">
                          <textarea name="excerptBangla" rows="3" class="form-control"
                                    placeholder="excerpt-bangla">{!! old('excerptBangla', $post->post_excerpt_bn) !!}</textarea>
                            @error('excerptBangla')
                            <p class="text-danger margin-bottom-none">{{$message}}</p>
                            @enderror
                          </div>
                        </div> <!-- /.tab-pane -->

                      </div> <!-- /.tab-content -->
                    </div> <!-- /.nav-tabs-custom -->
                  </div>
                </div> <!-- .excerpt -->
                <div id="attached" class="hide">
                  <div class="col-sm-12">
                    <h4>Attachments</h4>
                  </div>
                  <div class="col-sm-2">
                    <div class="form-group">
                      <ul class="post_attachment">
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $videoAtt = \App\Admin::get_post_attachment($post->id, "video");
                              $oldAttachment = old("attachType") ?? array() ;
                              $videoAttachment_type = $videoAtt->attachment_type ?? null;
                              $local = in_array("video", $oldAttachment ) || $videoAttachment_type
                              == "video" ? "checked" : "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="video" class="path" {{$local}}>Video
                          </label>
                        </li>
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $audioAtt = \App\Admin::get_post_attachment($post->id, "audio");
                              $audioAttachment_type = $audioAtt->attachment_type ?? null;
                              $audio = in_array("audio", $oldAttachment) || $audioAttachment_type
                              == "audio" ? "checked" : "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="audio" class="path" {{$audio}}>Audio
                          </label>
                        </li>
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $fileAtt = \App\Admin::get_post_attachment($post->id, "file");
                              $fileAttachment_type = $fileAtt->attachment_type ?? null;
                              $file = in_array("file", $oldAttachment) || $fileAttachment_type ==
                              "file" ? "checked" : "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="file" class="path" {{$file}}>Other File
                          </label>
                        </li>
                      </ul> <!-- .post_attachment -->
                    </div><!-- /input-group -->
                  </div><!-- /.col-sm-3 -->
                  <div class="col-sm-10">
                    @php
                      $videoAttPath_type = $videoAtt->attachment_path_type ?? null;
                      $videoAttPath_value = $videoAtt->attachment_path ?? null;
                    @endphp
                    <div class="row hide" id="attVideo">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Video attachment path type : </span>
                          <label class="radio-inline">
                            <input type="radio" name="video" value="local" class="path"> Local
                          </label>
                          <label class="radio-inline">
                            <?php $youtube = old("video") == "youtube" || $videoAttPath_type == "youtube" ? "checked" : "" ?>
                            <input type="radio" name="video" value="youtube" class="path" {{$youtube}}>YouTube
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $localVideo_value = $videoAttPath_type == "local" ? $videoAttPath_value
                            : "";
                            $local = old("video") == "youtube" || $videoAttPath_type == "youtube" ?
                            "hide" : "";
                          @endphp
                          <div class="input-group {{$local}}" id="localPath">
                            <div class="input-group-addon" id="videoFile" data-input="localVideoPath">
                              <i class="fa fa-film"></i>
                            </div>
                            <input type="text" name="localVideo" value="{{old("localVideo") ?? $localVideo_value}}"
                                   class="form-control" id="localVideoPath" placeholder="Local video file path" readonly>
                          </div>
                          @php
                            $youtubeVideo_value = $videoAttPath_type == "youtube" ?
                            $videoAttPath_value : "";
                            $youtube = old("video") == "youtube" || $videoAttPath_type == "youtube"
                            ? "" : "hide";
                          @endphp
                          <input type="text" name="youtubeVideo" value="{{old("youtubeVideo") ?? $youtubeVideo_value}}"
                                 class="form-control {{$youtube}}" id="youtubePath" placeholder="YouTube Video embeded link">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                    @php
                      $audioAttPath_type = $audioAtt->attachment_path_type ?? null;
                      $audioAttPath_value = $audioAtt->attachment_path ?? null;
                      $showAudio = in_array("audio", $oldAttachment) || $audioAttachment_type == "audio" ?
                      "" : "hide";
                    @endphp
                    <div class="row {{$showAudio}}" id="attAudio">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Audio attachment path type : </span>
                          <label class="radio-inline">
                            <input type="radio" name="audio" value="localAudio" class="path" checked>Local Audio
                          </label>
                          <label class="radio-inline">
                            @php
                              $otherAudio = old("audio") == "otherAudio" || $audioAttPath_type ==
                              "otherAudio" ? "checked" : "";
                            @endphp
                            <input type="radio" name="audio" value="otherAudio" class="path" {{$otherAudio}}>Other Audio
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $localAudio_value = $audioAttPath_type == "localAudio" ?
                            $audioAttPath_value : "";
                            $localAudio = old("audio") == "otherAudio" || $audioAttPath_type ==
                            "otherAudio" ? "hide" : "";
                          @endphp
                          <div class="input-group {{$localAudio}}" id="localAudio">
                            <div class="input-group-addon" id="localAudioAddon" data-input="localAudioPath">
                              <i class="fa fa-file-audio-o"></i>
                            </div>
                            <input type="text" name="localAudio" value="{{old("localAudio") ?? $localAudio_value}}"
                                   class="form-control" id="localAudioPath" placeholder="Local Audio file path" readonly>
                          </div>
                          @php
                            $otherAudio_value = $audioAttPath_type == "otherAudio" ?
                            $audioAttPath_value : "";
                            $localAudio = old("audio") == "otherAudio" || $audioAttPath_type ==
                            "otherAudio" ? "" : "hide";
                          @endphp
                          <input type="text" name="otherAudio" value="{{old("otherAudio") ?? $otherAudio_value}}"
                                 class="form-control {{$localAudio}}" id="otherAudioPath" placeholder="Other Audio file path">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                    @php
                      $fileAttPath_type = $fileAtt->attachment_path_type ?? null;
                      $fileAttPath_value = $fileAtt->attachment_path ?? null;
                      $showFile = in_array("file", $oldAttachment) || $fileAttachment_type == "file" ? ""
                      : "hide";
                    @endphp
                    <div class="row {{$showFile}}" id="attFile">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Video attachment path type : </span>
                          <label class="radio-inline">
                            <input type="radio" name="file" value="localFile" class="path" checked>Local File
                          </label>
                          <label class="radio-inline">
                            @php
                              $otherFile = old("file") == "otherFile" || $fileAttPath_type ==
                              "otherFile" ? "checked" : "";
                            @endphp
                            <input type="radio" name="file" value="otherFile" class="path" {{$otherFile}}>Other File
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $otherFile_local_value = $fileAttPath_type == "localFile" ?
                            $fileAttPath_value : "";
                            $otherFile = old("file") == "otherFile" || $fileAttPath_type ==
                            "otherFile" ? "hide" : "";
                          @endphp
                          <div class="input-group {{$otherFile}}" id="localFile">
                            <div class="input-group-addon" id="localFileaddon" data-input="localFilePath">
                              <i class="fa fa-file"></i>
                            </div>
                            <input type="text" name="localFile" value="{{old("localFile") ?? $otherFile_local_value}}"
                                   class="form-control" id="localFilePath" placeholder="Local file path" readonly>
                          </div>
                          @php
                            $otherFile_other_value = $fileAttPath_type == "otherFile" ?
                            $fileAttPath_value : "";
                            $otherFile = old("file") == "otherFile" || $fileAttPath_type ==
                            "otherFile" ? "" : "hide";
                          @endphp
                          <input type="text" name="otherFile" value="{{old("otherFile") ?? $otherFile_other_value}}"
                                 class="form-control {{$otherFile}}" id="otherFile" placeholder="Other file path">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                  </div><!-- /.col-sm-9 -->
                </div> <!-- .attached -->
              </div> <!-- .row -->
              <hr>
              <div class="row">
                <div class="form-group col-sm-12">
                  <input type="submit" class="btn btn-green" value="Update" title="Update post">
                  <a href="{{ url("admin/page/{$post->id}/edit") }}" class="btn btn-danger" title="Reset">Reset</a>
                </div>
              </div>

            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div> <!-- .col-md-7 -->

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
                    <input type="radio" name="post_status" value="publish" class="cheking" checked>
                    Publish
                  </label>
                  <label class="radio-inline">
                    <?php $draft = ($post->post_status == "draft") ? "checked" : "" ?>
                    <input type="radio" name="post_status" value="draft" class="cheking" {{$draft}}>
                    Draft
                  </label>
                  <label class="radio-inline">
                    <?php $schedule = ($post->post_status == "schedule") ? "checked" : "" ?>
                    <input type="radio" name="post_status" value="schedule" class="cheking" {{$schedule}}>
                    Schedule
                  </label>
                </div>
                <?php $schedule = ($post->post_status == "schedule") ? "" : "hide" ?>
                <div class="form-group col-sm-12 {{$schedule}}" id="scheduleDate">
                  <div class="form-group">
                    <div class='input-group dateTimePicker'>
                      @php
                        $schedule_time = $post->schedule_time ?? $post->created_at;
                        $schedule_time = \Carbon\Carbon::parse($schedule_time)->format("d-m-Y h:i a");
                      @endphp
                      <input type='text' name="scheduleTime" value="{{ old("scheduleTime") ?? $schedule_time }}"
                             class="form-control"/>
                      <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                    </div>
                  </div>
                </div>
              </div> <!-- /.row -->
              <div class="row">
                <div class="col-sm-12">
                  <h5>Post date</h5>
                  <div class='input-group dateTimePicker'>
                    @php
                      $created_at = \Carbon\Carbon::parse($post->created_at)->format("d-m-Y h:i a");
                    @endphp
                    <input type='text' name="created_at" value="{{ old("created_at") ?? $created_at }}"
                           class="form-control"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="catblock">
                    <h4>Module</h4>
                    <ul class="post_taxonomy">
                      <li>
                        <label class="radio-inline">
                          <input type="radio" name="post_module" value="individual"> Individual Page
                        </label>
                      </li>
                      @forelse ($modules as $key => $module)
                        <li>
                          <label class="radio-inline">
                            <input type="radio" name="post_module" value="{{$module->slug}}"
                                   @if($post->post_format == $module->slug) checked @endif> {{$module->name }}
                          </label>
                        </li>
                      @empty
                      @endforelse
                      <li>
                        <label class="radio-inline">
                          <input type="radio" name="post_module" value="download-forms"
                                 @if($post->post_format == 'download-forms') checked @endif> Download Forms
                        </label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> <!-- /.row -->
              <div class="row">
                <div class="form-group col-sm-12">
                  <h5>Thumbnail</h5>
                  <label class="radio-inline">
                    @php
                      $upload_type = (old("upload_type") == "new") ? "checked" : "checked";
                    @endphp
                    <input type="radio" name="upload_type" value="new" class="cheking" {{$upload_type}}>
                    New Upload
                  </label>
                  <label class="radio-inline">
                    @php
                      $from_old = (old("upload_type") ?? $post->upload_type == "new") ? "checked" : "";
                    @endphp
                    <input type="radio" name="upload_type" value="from_old" class="cheking" {{$from_old}}>
                    From Old
                  </label>

                  <label class="radio-inline">
                    @php
                      $thumb_status = (old("upload_type") ?? $post->upload_type == "off") ? "checked" :
                      "";
                    @endphp
                    <input type="radio" name="upload_type" value="off" class="cheking" {{$thumb_status}}>
                    Off
                  </label>
                </div>
                @php
                  $new = (old("upload_type") ?? $post->upload_type == "new") ? "" : "hide";
                @endphp
                <div class="form-group col-sm-12 {{$new}}" id="for_New_upload">
                  <label title="Select Image">
                    <input type="file" name="newPicture" value="{{old("newPicture")}}">
                  </label>
                </div>
                @php
                  $from_old = (old("upload_type") ?? $post->upload_type == "from_old") ? "" : "hide";
                @endphp
                <div class="form-group col-sm-12 {{$from_old}}" id="for_old_upload">
                  <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder"
                         title="Select Image">
                    @if(old("picture"))
                      <img src="{{asset(old("picture"))}}" title="select picture" id="holder"
                           class="img-responsive user-picture m-0">
                    @else
                      <img src="{{asset($post->post_thumb ?? 'img/no-image-available.jpg')}}" title="select picture"
                           id="holder" class="img-responsive user-picture m-0">
                    @endif
                  </label>
                  <input type="text" name="picture" value="{{ $post->post_thumb ?? old("picture")}}"
                         class="form-control hidden" id="thumbnail">
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
  <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
@endsection

@push('scripts')
  <script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
  <script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
  <script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
  <script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
  <script>
    let url = "{{url('/')}}";
    let options = {
      filebrowserImageBrowseUrl: url + '/file-manager?type=Images',
      filebrowserImageUploadUrl: url + '/file-manager/upload?type=Images&_token=',
      filebrowserBrowseUrl: url + '/file-manager?type=Files',
      filebrowserUploadUrl: url + '/file-manager/upload?type=Files&_token=',
      height: 350,
    };
    // image preview
    $('#customFile').filemanager('Images');
    $('#videoFile').filemanager('files');
    $('#localAudioAddon').filemanager('files');
    $('#localFileaddon').filemanager('files');

    $(document).ready(function () {
      simple_editor(".editor", 450);
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
          $(".slugSpan").html(data);
        },
      });
    }

    $(function () {
      $("#editslug").click(function () {
        $("#slug").removeClass("hide").focus();
        $(".slugSpan").addClass("hide")
      });
      $("#slug").blur(function () {
        const title = $(this).val();
        const ajaxurl = $("#title").attr("ajax-url");
        ajax_slug_url(title, ajaxurl);
        $(this).addClass("hide")
        $(".slugSpan").removeClass("hide")
      });

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
      $('.longoption').select2();
      $('.shortoption').select2({
        minimumResultsForSearch: -1
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

      // attachment const
      const attachment = $(".attachment");

      attachment.each(function () {
        const value = $(this).val();
        check_uncheck(this, value);
      });
      // option and attachment option start from here
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
    })
  </script>

@endpush
