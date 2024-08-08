@extends('admin.layouts.app')
@section('title', "Edit post - {$post->post_title}")
@section('page-title', $module->name)

@inject('admin','App\Admin')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">{{$module->name}}</li>
  </ol>
@endsection

@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
@endsection

{{-- main content section strat  --}}
@section('content')
  <section class="content">
    <form action="{{ url("admin/type/{$module->slug}/{$post->id}") }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method("PUT")
      <input type="hidden" name="post_type" value="{{ $module->slug }}">
      <input type="hidden" name="module_id" id="module_id" value="{{ $module->id }}">
      <input type="hidden" name="get_url" id="get_url" value="{{ url("/") }}">
      <div class="row">
        <div class="col-md-9">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Post</h3>
              <a href="{{url("admin/type/".$module->slug)}}" class="btn-link">Show all</a>
              <a href="{{url("admin/type/".$module->slug."/create")}}" class="btn-link">Create new</a>
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
                          <input type="text" name="titleEnglish" value="{{ old('titleEnglish', $post->post_title) }}"
                                 class="form-control" placeholder="post title" ajax-url="{{url("get-slug-from-title")}}">
                          @error('titleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <span>URL: </span>
                          <a href="javascript:" id="editslug" title="click to edit">
                            {{ url("/")}}/<span class="slugSpan">{{$post->post_slug ?? old('post_slug')}}</span>
                          </a>
                          <input type="text" name="post_slug" class="hide"
                                 value="{{$post->post_slug ?? old('post_slug')}}" id="slug" style="width: 250px;">
                          @if ($errors->has('post_slug'))
                            <p class="text-danger margin-bottom-none">
                              <small>{{ $errors->first('post_slug') }}</small>
                            </p>
                          @endif
                        </div>
                        <div class="form-group">
                        <textarea name="articleEnglish"
                                  class="form-control editor">{{old('articleEnglish', $post->post_content)}}</textarea>
                          @error('articleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                      </div> <!-- /.tab-pane -->
                      <div class="tab-pane" id="bangla">
                        <div class="form-group">
                          <input type="text" name="titleBangla" value="{{old('titleBangla', $post->post_title_bn)}}"
                                 class="form-control" placeholder="post title" ajax-url="{{url("get-slug-from-title")}}">
                          @error('titleBangla')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <span>URL: </span>
                          {{ url("/")}}/bn/<span class="slugSpan">{{ old('post_slug', $post->post_slug)}}</span>
                        </div>
                        <div class="form-group">
                        <textarea name="articleBangla"
                                  class="form-control editor">{{old('articleBangla', $post->post_content_bn)}}</textarea>
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
                  <label class="checkbox-inline" title="Check to Success Stories Options ">
                    @php
                      $stories_info = \App\Admin::get_post_stories_info($post->id);
                      $stories = old("stories") || !empty($stories_info) ? "checked" : "";
                    @endphp
                    <input type="checkbox" name="stories" class="attachment" value="stories" {{$stories}}>Success Stories
                  </label>
                  <label class="checkbox-inline" title="Check to show other options">
                    <?php $option = $post->option_status ? "checked" : "" ?>
                    <input type="checkbox" name="option" class="attachment" value="option" {{$option}}>Other Options
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
                              $audioAtt = App\Admin::get_post_attachment($post->id, "audio");
                              $audioTttachment_type = $audioAtt->attachment_type ?? null;
                              $audio = in_array("audio", $oldAttachment) || $audioTttachment_type == "audio" ? "checked" :
                              "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="audio" class="path" {{$audio}}>Audio
                          </label>
                        </li>
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $fileAtt = App\Admin::get_post_attachment($post->id, "file");
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
                      $showVideo = in_array("video", $oldAttachment) || $videoAttachment_type == "video" ?
                      "" : "";
                    @endphp
                    <div class="row {{$showVideo}}" id="attVideo">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Video attachment path type : </span>
                          <label class="radio-inline">
                            @php
                              $local = old("video") == "local" || $videoAttPath_type == "local" ?
                              "checked" : "checked";
                            @endphp
                            <input type="radio" name="video" value="local" class="path" {{$local }}> Local
                          </label>
                          <label class="radio-inline">
                            <?php $youtube = old("video") == "youtube" || $videoAttPath_type == "youtube" ? "checked" : "" ?>
                            <input type="radio" name="video" value="youtube" class="path" {{$youtube}}>YouTube
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $localVideo_value = $videoAttPath_type == "local" ? $videoAttPath_value : null;
                            $local = old("video") == "youtube" || $videoAttPath_type == "youtube" ? "hide" : null;
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
                            $youtube = old("video") == "youtube" || $videoAttPath_type == "youtube" ? "" : "hide";
                          @endphp
                          <input type="text" name="youtubeVideo" value="{{old("youtubeVideo") ?? $youtubeVideo_value}}"
                                 class="form-control {{$youtube}}" id="youtubePath" placeholder="YouTube Video embeded link">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                    @php
                      $audioAttPath_type = $audioAtt->attachment_path_type ?? null;
                      $audioAttPath_value = $audioAtt->attachment_path ?? null;
                      $showAudio = in_array("audio", $oldAttachment) || $audioTttachment_type == "audio" ?
                      "" : "hide";
                    @endphp
                    <div class="row {{$showAudio}}" id="attAudio">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Audio attachment path type : </span>
                          <label class="radio-inline">
                            @php
                              $localAudio = old("audio") == "localAudio" || $audioAttPath_type ==
                              "localAudio" ? "checked" : "checked";
                            @endphp
                            <input type="radio" name="audio" value="localAudio" class="path" {{$localAudio}}>Local Audio
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
                            @php
                              $localFile = old("file") == "localFile" || $fileAttPath_type ==
                              "localFile" ? "checked" : "checked";
                            @endphp
                            <input type="radio" name="file" value="localFile" class="path" {{$localFile}}>Local File
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
                <div id="stories" class="hide">
                  <div class="col-sm-12">
                    <h4>Add Success Stories Students</h4>
                    <a href="{{url("admin/student/create")}}" target="_blank">
                      <i class="fa fa-link"></i>
                    </a>
                  </div>
                  @php
                    $story_id = $stories_info->id ?? null;
                    $story_subject_id = $stories_info->subject_id ?? null;
                    $story_round_id = $stories_info->round_id ?? null;
                    $story_student_id = $stories_info->student_id ?? null;
                  @endphp
                  <input type="hidden" name="stories_id" value="{{$story_id}}">
                  <input type="hidden" id="select_student_id" value="{{$story_student_id}}">
                  <div class="form-group col-sm-4">
                    <label for="subject">Course</label>
                    <select name="subject_id" id="subject" class="form-control longoption">

                      <option value="0">None</option>
                      @php
                        $subjects = App\Models\ContentModels\Post::get_module_subjects($module->id);
                      @endphp
                      @forelse($subjects as $subject)
                        @php
                          $subject = isset($subject) ? $subject : null;
                          $selectSubject = $subject->id == $story_subject_id ? "selected" : "";
                        @endphp
                        <option value="{{$subject->id}}" {{$selectSubject}}>{{$subject->subject_name}}
                        </option>
                      @empty
                      @endforelse
                    </select>
                  </div> <!-- /. col-sm-4 -->
                  <div class="form-group col-sm-4">
                    <label for="round">Round</label>
                    <select name="round_id" id="round" class="form-control longoption">
                      @php
                        $rounds = App\Models\ContentModels\Post::get_module_rounds($module->id);
                      @endphp
                      @forelse($rounds as $round)
                        @php
                          $round = isset($round) ? $round : null;
                          $selectRound = $round->id == $story_round_id ? "selected" : "";
                        @endphp
                        <option value="{{$round->id}}" {{$selectRound}}>{{$round->name}}</option>
                      @empty
                        <option value="0">None</option>
                      @endforelse
                    </select>
                  </div> <!-- /. col-sm-4 -->
                  <div class="form-group col-sm-4">
                    <label for="student">Student</label>
                    <select name="student_id" id="student" class="form-control longoption">
                    </select>
                  </div> <!-- /. col-sm-4 -->
                </div>
                <!--/.stories -->
                <div id="option" class="hide">
                  <div class="col-sm-12">
                    <h5>Other Options</h5>
                  </div>
                  <div class="col-sm-6">
                    <span>Other Options can be integrated</span>
                  </div>
                </div>
                <!--/.option -->

              </div>
              <!--/.row -->
              <hr>
              <div class="row">
                <div class="form-group col-sm-12">
                  <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="Update post">
                  <a href="{{ url("admin/{$module}/{$post->id}/edit") }}" class="btn btn-danger" title="Reset">Reset</a>
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
                    <?php $publish = ($post->post_status == "publish") ? "checked" : "checked" ?>
                    <input type="radio" name="post_status" value="publish" class="checking" {{$publish}}>
                    Publish
                  </label>
                  <label class="radio-inline">
                    <?php $draft = ($post->post_status == "draft") ? "checked" : "" ?>
                    <input type="radio" name="post_status" value="draft" class="checking" {{$draft}}>
                    Draft
                  </label>
                  <label class="radio-inline">
                    <?php $schedule = ($post->post_status == "schedule") ? "checked" : "" ?>
                    <input type="radio" name="post_status" value="schedule" class="checking" {{$schedule}}>
                    Schedule
                  </label>
                </div>

                @php
                  $schedule = ($post->post_status == "schedule") ? null : "hide";
                @endphp
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

                <div class="form-group col-sm-12">
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

                <div class="form-group col-sm-12">
                  <h5>Post Template</h5>
                  <ul class="post_taxonomy formate">
                    @forelse (post_template() as $key => $template)
                      <li>
                        <label class="radio-inline">
                          @php
                            $template = isset($template) ? $template : null;
                            $template_slug = slug_url($template);
                            $format = ( $post->post_format == $template_slug ) ? "checked" : "";
                          @endphp
                          <input type="radio" name="postFormat" value="{{$template_slug}}" {{$format}}>
                          {{$template }}
                        </label>
                      </li>
                    @empty
                      <li>
                        <span>Template not set</span>
                      </li>
                    @endforelse
                  </ul>
                </div>

              </div> <!-- /.row -->

              <div class="row">
                <div class="col-sm-12">
                  @foreach ($terms as $term)
                    @if($term->module_id == 0)
                      @php $taxoModule = 0; @endphp
                    @else
                      @php $taxoModule = $module; @endphp
                    @endif
                    <div class="catblock">
                      @php
                        $post_taxonomy = $admin->get_post_taxonomy($post->id);
                      @endphp
                      @if ($term->slug == "tags")
                        <div class="form-group">
                          <h5>{{ $term->name }}</h5>
                          <select class="form-control shortoption" name="tags[]" multiple="multiple"
                                  data-placeholder="Select a tags" style="width: 100%;">
                            @php $oldTags = old("tags") ?? array() @endphp
                            @foreach ( $admin->find_post_taxonomies($term->slug, $taxoModule) as $tags)
                              @php
                                $tags = isset($tags) ? $tags : "";
                                $tagsSelect = $post_taxonomy->contains('id', $tags->id) || in_array($tags->id, $oldTags) ?
                                "selected" : "";
                              @endphp
                              <option value="{{$tags->id}}" {{$tagsSelect}}>{{$tags->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      @else
                        <h5>{{ $term->name }}</h5>
                        <ul class="post_taxonomy">
                          @foreach ($admin->find_post_taxonomies($term->slug, $taxoModule) as $item)
                            <li>
                              <label class="checkbox-inline">
                                @php
                                  $item = isset($item) ? $item : "";
                                  $taxonomyArray = old("taxonomy") ?? array();
                                  $checked = $post_taxonomy->contains('id', $item->id) || in_array($item->id, $taxonomyArray) ?
                                  "checked" : "";
                                @endphp
                                <input type="checkbox" name="taxonomy[]" value="{{$item->id}}" {{$checked}}> {{$item->name }}
                              </label>
                              @if (count($admin->find_post_taxonomies($item->term, $taxoModule, $item->id)) > 0)
                                <ul>
                                  @foreach ( $admin->find_post_taxonomies($item->term, $taxoModule, $item->id) as $item2)
                                    <li>
                                      @php
                                        $item2 = isset($item2) ? $item2 : "";
                                        $checked = $post_taxonomy->contains('id', $item2->id) || in_array($item2->id, $taxonomyArray)
                                        ? "checked" : "";
                                      @endphp
                                      <label class="checkbox-inline">
                                        <input type="checkbox" name="taxonomy[]" value="{{$item2->id}}" {{$checked}}>
                                        {{$item2->name}}
                                      </label>
                                      @if (count($admin->find_post_taxonomies($item2->term, $taxoModule, $item2->id)) > 0)
                                        <ul>
                                          @foreach ( $admin->find_post_taxonomies($item2->term, $taxoModule,
                                          $item2->id) as $item3)
                                            <li>
                                              @php
                                                $item3 = isset($item3) ? $item3 : "";
                                                $checked = $post_taxonomy->contains('id', $item3->id) || in_array($item3->id,
                                                $taxonomyArray) ? "checked" : "";
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
                      @endif
                    </div>
                  @endforeach
                </div>
              </div> <!-- /.row -->

              <div class="row">
                <div class="form-group col-sm-12">
                  <h5>Thumbnail</h5>
                  <label class="radio-inline">
                    @php
                      $upload_type = (old("upload_type") == "new") ? "checked" : "checked";
                    @endphp
                    <input type="radio" name="upload_type" value="new" class="checking" {{$upload_type}}>
                    New Upload
                  </label>
                  <label class="radio-inline">
                    @php
                      $from_old = (old("upload_type") ?? $post->upload_type == "from_old") ? "checked" :
                      "";
                    @endphp
                    <input type="radio" name="upload_type" value="from_old" class="checking" {{$from_old}}>
                    From Old
                  </label>
                  <label class="radio-inline">
                    @php
                      $thumb_status = (old("upload_type") ?? $post->upload_type == "off") ? "checked" :
                      "";
                    @endphp
                    <input type="radio" name="upload_type" value="off" class="checking" {{$thumb_status}}>
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


@section('custom-script')
  <script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
  <script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
  <script src="{{ asset("assets/js/summernote-lfg.js")}}"></script>
  <script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
  <script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
  <script>
    var url = $("#get_url").val();
    var options = {
      filebrowserImageBrowseUrl: url + '/file-manager?type=Images',
      filebrowserImageUploadUrl: url + '/file-manager/upload?type=Images&_token=',
      filebrowserBrowseUrl: url + '/file-manager?type=files',
      filebrowserUploadUrl: url + '/file-manager/upload?type=files&_token=',
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

    // set_the_case_style_info
    function set_the_case_style_info(method_id, subject, round, ajaxurl, select_student_id) {
      jQuery.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
          'method_id': method_id,
          'subject': subject,
          'round': round,
          'select_student_id': select_student_id,
        },
        success: function (data) {
          $("#student").html(data);
        }
      });
    }

    // case stude info auto load
    function case_study_info_auto_load() {
      var method_id = $("#module_id").val();
      var subject = $("#subject").val();
      var round = $("#round").val();
      var select_student_id = $("#select_student_id").val();
      var ajaxurl = url + "/get-case-study-info";
      set_the_case_style_info(method_id, subject, round, ajaxurl, select_student_id);
    }


    $(function () {
      $(document).on("keyup", "#title", function () {
        var title = $(this).val();
        var ajaxurl = url + "/get-slug-from-title";
        ajax_slug_url(title, ajaxurl);
      });
      $("#editslug").click(function () {
        $("#slug").removeClass("hide").focus();
        $(".slugSpan").addClass("hide")
      });
      $("#slug").blur(function () {
        var title = $(this).val();
        var ajaxurl = url + "/get-slug-from-title";
        ajax_slug_url(title, ajaxurl);
        $(this).addClass("hide")
        $(".slugSpan").removeClass("hide")
      });


      //case_study_info_auto_load
      case_study_info_auto_load();

      // case_study_info_load on change event
      $("#subject, #round").on("change", function () {
        var method_id = $("#module_id").val();
        var subject = $("#subject").val();
        var round = $("#round").val();
        var select_student_id = $("#select_student_id").val();
        var ajaxurl = url + "/get-case-study-info";
        set_the_case_style_info(method_id, subject, round, ajaxurl, select_student_id);
      });

      $(".checking").click(function () {
        let check = $(this).val();
        if (check === "schedule") {
          $("#scheduleDate").removeClass("hide");
        } else if (check === "new") {
          $("#for_New_upload").removeClass("hide");
          $("#for_old_upload").addClass("hide");
        } else if (check === "from_old") {
          $("#for_old_upload").removeClass("hide");
          $("#for_New_upload").addClass("hide");
        } else if (check === "off") {
          $("#for_old_upload").addClass("hide");
          $("#for_New_upload").addClass("hide");
        } else {
          $("#scheduleDate").addClass("hide");
        }
      });
      // date time picker
      let dateNow = new Date();
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

      $(".attachment").each(function () {
        value = $(this).val();
        check_uncheck(this, value);
      });
      // option and attachment option start from here
      $(".attachment").click(function () {
        value = $(this).val();
        check_uncheck(this, value);
      });

      $(document).on("click", ".path", function () {
        let current = $(this);
        let value = $(this).val();
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

@endsection
