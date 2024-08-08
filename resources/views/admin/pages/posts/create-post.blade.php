@extends('admin.layouts.app')

@section('title', 'Create new post')

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

@php
  $module = isset($module) ? $module : null;
@endphp
@section('content')
  <section class="content">
    <form action="{{ url("admin/type/".$module->slug) }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="post_type" value="{{ $module->slug }}">
      <input type="hidden" name="module_id" id="module_id" value="{{ $module->id }}">
      <input type="hidden" name="get_url" id="get_url" value="{{ url("/") }}">
      <div class="row">
        <div class="col-md-9">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Post</h3>
              <a href="{{url("admin/type/".$module->slug)}}" class="btn-link">Show all</a>
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
                          <label for="title" class="hide"></label>
                          <input type="text" name="titleEnglish" value="{{old('titleEnglish')}}" class="form-control"
                                 id="title" placeholder="post title">
                          @error('titleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <span>URL: </span>
                          <a href="javascript:" id="editslug" title="click to edit">/{{$module->slug}}/<span
                              class="slugSpan">{{old('post_slug')}}</span></a>
                          <label for="slug" class="hide"></label>
                          <input type="text" name="post_slug" class="hide" value="{{old('post_slug')}}" id="slug"
                                 style="width: 300px;">
                          @if ($errors->has('post_slug'))
                            <p class="text-danger margin-bottom-none">
                              <small>{{ $errors->first('post_slug') }}</small>
                            </p>
                          @endif
                        </div>
                        <div class="form-group">
                          <label for="articleEnglish" class="hide"></label>
                          <textarea name="articleEnglish" id="articleEnglish"
                                    class="form-control editor">{{old('articleEnglish')}}</textarea>
                          @error('articleEnglish')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                      </div> <!-- /.tab-pane -->
                      <div class="tab-pane" id="bangla">
                        <div class="form-group">
                          <label for="titleBangla" class="hide"></label>
                          <input type="text" name="titleBangla" id="titleBangla" value="{{old('titleBangla')}}"
                                 class="form-control" placeholder="post title">
                          @error('titleBangla')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                        <div class="form-group">
                          <span>URL: </span>
                          {{ url("/")}}/bn/<span class="slugSpan">{{old('post_slug')}}</span>
                        </div>
                        <div class="form-group">
                          <label for="articleBangla" class="hide"></label>
                          <textarea name="articleBangla" id="articleBangla"
                                    class="form-control editor">{{old('articleBangla')}}</textarea>
                          @error('articleBangla')
                          <p class="text-danger margin-bottom-none">{{$message}}</p>
                          @enderror
                        </div>
                      </div> <!-- .tab-pane -->
                    </div> <!-- .tab-content -->
                  </div> <!-- .nav-tabs-custom -->
                </div> <!-- .col-sm-12 -->
              </div> <!-- .row -->

              {{-- attachement option --}}
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline" title="check to show post excerpt field">
                    <input type="checkbox" name="excerpt" class="attachment" value="excerpt"  @if(old('excerpt')) checked @endif>Post Excerpt
                  </label>
                  <label class="checkbox-inline" title="check to show attachment">
                    <input type="checkbox" name="attached" class="attachment" value="attached" @if(old('attached')) checked @endif>Attachment
                  </label>
                  <label class="checkbox-inline" title="Allow comments">
                    <input type="checkbox" name="comment_status" class="attachment" value="comments"
                           @if(old('comment_status')) checked @endif>Allow Comments
                  </label>
                  <label class="checkbox-inline" title="Check to Success Stories Options ">
                    <input type="checkbox" name="stories" class="attachment" value="stories" @if(old('stories')) checked @endif> Student Info
                  </label>
                  <label class="checkbox-inline" title="Check to show other options">
                    <?php $option = old("option") ? "checked" : "" ?>
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
                        <li>
                          <a href="#excerpt-bangla" data-toggle="tab">Excerpt Bangla</a>
                        </li>
                      </ul>
                      <div class="tab-content">
                        <div class="active tab-pane" id="excerpt-english">
                          <div class="form-group">
                            <label for="excerptEnglish" class="hide"></label>
                            <textarea name="excerptEnglish" id="excerptEnglish" rows="2" class="form-control"
                                      placeholder="excerpt-english">{{old('excerptEnglish')}}</textarea>
                            @error('excerptEnglish')
                            <p class="text-danger margin-bottom-none">{{$message}}</p>
                            @enderror
                          </div>
                        </div> <!-- /.tab-pane -->
                        <div class="tab-pane" id="excerpt-bangla">
                          <div class="form-group">
                            <label for="excerptBangla" class="hide"></label>
                            <textarea name="excerptBangla" id="excerptBangla" rows="2" class="form-control"
                                      placeholder="excerpt-bangla">{{old('excerptBangla')}}</textarea>
                            @error('excerptBangla')
                            <p class="text-danger margin-bottom-none">{{$message}}</p>
                            @enderror
                          </div>
                        </div> <!-- /.tab-pane -->

                      </div> <!-- /.tab-content -->
                    </div> <!-- /.nav-tabs-custom -->
                  </div>
                </div>
                <!--/.excerpt -->
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
                              $oldAttachment = old("attachType") ?? array();
                              $local = in_array("video", $oldAttachment) ? "checked" : "checked";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="video" class="path" {{$local}}>Video
                          </label>
                        </li>
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $audio = in_array("audio", $oldAttachment) ? "checked" : "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="audio" class="path" {{$audio}}>Audio
                          </label>
                        </li>
                        <li>
                          <label class="checkbox-inline">
                            @php
                              $file = in_array("file", $oldAttachment) ? "checked" : "";
                            @endphp
                            <input type="checkbox" name="attachType[]" value="file" class="path" {{$file}}>Other File
                          </label>
                        </li>
                      </ul> <!-- .post_attachment -->
                    </div><!-- /input-group -->
                  </div><!-- /.col-sm-3 -->
                  <div class="col-sm-10">
                    @php
                      $showVideo = in_array("video", $oldAttachment) ? "" : "";
                    @endphp
                    <div class="row {{$showVideo}}" id="attVideo">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Video attachment path type : </span>
                          <label class="radio-inline">
                            <?php $local = (old("video") == "local") ? "checked" : "checked" ?>
                            <input type="radio" name="video" value="local" class="path" {{$local }}> Local
                          </label>
                          <label class="radio-inline">
                            <?php $youtube = (old("video") == "youtube") ? "checked" : "" ?>
                            <input type="radio" name="video" value="youtube" class="path" {{$youtube}}>YouTube
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          <?php $local = (old("video") == "youtube") ? "hide" : "" ?>
                          <div class="input-group {{$local}}" id="localPath">
                            <div class="input-group-addon" id="videoFile" data-input="localVideoPath">
                              <i class="fa fa-film"></i>
                            </div>
                            <label for="localVideoPath" class="hide"></label>
                            <input type="text" name="localVideo" value="{{old("localVideo")}}" class="form-control"
                                   id="localVideoPath" placeholder="Local video file path" readonly>
                          </div>
                          <?php $youtube = (old("video") == "youtube") ? "" : "hide" ?>
                          <label for="youtubePath" class="hide"></label>
                          <input type="text" name="youtubeVideo" value="{{old("youtubeVideo")}}"
                                 class="form-control {{$youtube}}" id="youtubePath" placeholder="YouTube Video embeded link">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                    @php
                      $showAudio = in_array("audio", $oldAttachment) ? "" : "hide";
                    @endphp
                    <div class="row {{$showAudio}}" id="attAudio">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Audio attachment path type : </span>
                          <label class="radio-inline">
                            @php
                              $localAudio = (old("audio") == "localAudio") ? "checked" : "checked";
                            @endphp
                            <input type="radio" name="audio" value="localAudio" class="path" {{$localAudio}}>Local Audio
                          </label>
                          <label class="radio-inline">
                            @php
                              $otherAudio = (old("audio") == "otherAudio") ? "checked" : "";
                            @endphp
                            <input type="radio" name="audio" value="otherAudio" class="path" {{$otherAudio}}>Other Audio
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $localAudio = (old("audio") == "otherAudio") ? "hide" : "";
                          @endphp
                          <div class="input-group {{$localAudio}}" id="localAudio">
                            <div class="input-group-addon" id="localAudioAddOn" data-input="localAudioPath">
                              <i class="fa fa-file-audio-o"></i>
                            </div>
                            <label for="localAudioPath" class="hljs-id"></label>
                            <input type="text" name="localAudio" value="{{old("localAudio")}}" class="form-control"
                                   id="localAudioPath" placeholder="Local Audio file path" readonly>
                          </div>
                          @php
                            $localAudio = (old("audio") == "otherAudio") ? "" : "hide";
                          @endphp
                          <label for="otherAudioPath" class="hide"></label>
                          <input type="text" name="otherAudio" value="{{old("otherAudio")}}"
                                 class="form-control {{$localAudio}}" id="otherAudioPath" placeholder="Other Audio file path">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                    @php
                      $showFile = in_array("file", $oldAttachment) ? "" : "hide";
                    @endphp
                    <div class="row {{$showFile}}" id="attFile">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <span class="attachment-info">Video attachment path type : </span>
                          <label class="radio-inline">
                            @php
                              $localFile = (old("file") == "localFile") ? "checked" : "checked";
                            @endphp
                            <input type="radio" name="file" value="localFile" class="path" {{$localFile}}>Local File
                          </label>
                          <label class="radio-inline">
                            @php
                              $otherFile = (old("file") == "otherFile") ? "checked" : "";
                            @endphp
                            <input type="radio" name="file" value="otherFile" class="path" {{$otherFile}}>Other File
                          </label>
                        </div><!-- /input-group -->
                        <div class="form-group">
                          @php
                            $otherFile = (old("file") == "otherFile") ? "hide" : "";
                          @endphp
                          <div class="input-group {{$otherFile}}" id="localFile">
                            <div class="input-group-addon" id="localFileAddOn" data-input="localFilePath">
                              <i class="fa fa-file"></i>
                            </div>
                            <label for="localFilePath" class="hide"></label>
                            <input type="text" name="localFile" value="{{old("localFile")}}" class="form-control"
                                   id="localFilePath" placeholder="Local file path" readonly>
                          </div>
                          @php
                            $otherFile = (old("file") == "otherFile") ? "" : "hide";
                          @endphp
                          <label for="otherFile" class="hide"></label>
                          <input type="text" name="otherFile" value="{{old("otherFile")}}"
                                 class="form-control {{$otherFile}}" id="otherFile" placeholder="Other file path">
                        </div><!-- /input-group -->
                      </div>
                    </div> <!-- .row -->
                  </div><!-- /.col-sm-9 -->
                </div>
                <!--/.attached -->
                <div id="comments" class="hide">
                  <div class="form-group col-sm-12">
                    <h4><label for="comments">Add first Comments</label></h4>
                    <textarea name="comments" id="comments" rows="2" class="form-control"
                              placeholder="comments">{{old('comments')}}</textarea>
                    @error('comments')
                    <p class="text-danger margin-bottom-none">{{$message}}</p>
                    @enderror
                  </div>
                </div>
                <!--/.stories -->
                <div id="stories" class="hide">
                  <div class="col-sm-12">
                    <h4>Add Success Stories Students</h4>
                  </div>
                  <div class="form-group col-sm-4">
                    <label for="subject">Course</label>
                    <select name="subject_id" id="subject" class="form-control longoption">
                      @php
                        $subjects = App\Models\ContentModels\Post::get_module_subjects($module->id);
                      @endphp
                      @forelse($subjects as $subject)
                        <option value="{{$subject->id}}">{{$subject->subject_name}}</option>
                      @empty
                        <option value="0">None</option>
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
                        <option value="{{$round->id}}">{{$round->name}}</option>
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
                  </div>
                </div>
                <!--/.option -->
              </div>
              <!--/.row -->
              <div class="row">
                <div class="form-group col-sm-12">
                  <input type="submit" class="btn btn-green" value="Save" name="submit" title="submit">
                  <a href="{{ url("admin/{$module}/create") }}" class="btn btn-danger">Reset</a>
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
                  <h5>Post date</h5>
                  <div class='input-group dateTimePicker'>
                    @php
                      $created_at = \Carbon\Carbon::parse()->format("d-m-Y h:i a");
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
                            $template = isset($template) ? $template : "";
                            $checkFormat = $key == 0 ? "checked" : "";
                            $template_slug = slug_url($template);
                            $format = (old("postFormat") == $template_slug ) ? "checked" : $checkFormat;
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
                      @if ($term->slug == "tags")
                        <div class="form-group">
                          <h5><label for="tags">{{ $term->name }}</label></h5>
                          <select class="form-control shortoption" id="tags" name="tags[]" multiple="multiple"
                                  data-placeholder="Select a tags" style="width: 100%;">
                            @php $tagsArray = old("tags") ?? array(); @endphp
                            @forelse ( $admin->find_post_taxonomies($term->slug, $taxoModule) as $tags)
                              @php
                                $tags = isset($tags) ? $tags : "";
                                $tagsSelect = in_array($tags->id, $tagsArray ) ? "selected" : "";
                              @endphp
                              <option value="{{$tags->id}}" {{$tagsSelect}}>{{$tags->name}}</option>
                            @empty
                            @endforelse
                          </select>
                        </div>
                      @else
                        <h5>{{ $term->name }}</h5>
                        <ul class="post_taxonomy">
                          @foreach ( $admin->find_post_taxonomies($term->slug, $taxoModule) as $item)
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
                           class="img-responsive user-picture m-0" alt="upload picture">
                    @else
                      <img src="{{asset($editItem["picture"] ?? 'img/no-image.gif')}}" title="select picture" id="holder"
                           class="img-responsive user-picture m-0" alt="upload picture">
                    @endif
                  </label>
                  <label for="thumbnail" class="hide"></label>
                  <input type="text" name="picture" value="{{old("picture")}}" class="hidden" id="thumbnail"
                         alt="upload picture">
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
  <script src="{{ asset("vendor/laravel-filemanager/js/lfm.js") }}"></script>
  <script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
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
      const ajaxurl = url + "/get-slug-from-title";
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
    });

    // set_the_case_style_info
    function set_the_case_style_info(method_id, subject, round, ajaxurl) {
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
        },
        success: function (data) {
          $("#student").html(data);
        }
      });
    }

    // case student info auto load
    function case_study_info_auto_load() {
      const method_id = $("#module_id").val();
      const subject = $("#subject").val();
      const round = $("#round").val();
      const ajaxurl = url + "/get-case-study-info";
      set_the_case_style_info(method_id, subject, round, ajaxurl);
    }


    $(function () {
      $("#editslug").click(function () {
        $("#slug").removeClass("hide").focus();
        $(".slugSpan").addClass("hide")
      });
      $("#slug").blur(function () {
        const title = $(this).val();
        const ajaxurl = url + "/get-slug-from-title";
        ajax_slug_url(title, ajaxurl);
        $(this).addClass("hide");
        $(".slugSpan").removeClass("hide")
      });


      //case_study_info_auto_load
      case_study_info_auto_load();

      // case_study_info_load on change event
      $("#subject, #round").on("change", function () {
        const method_id = $("#module_id").val();
        const subject = $("#subject").val();
        const round = $("#round").val();
        const ajaxurl = url + "/get-case-study-info";
        set_the_case_style_info(method_id, subject, round, ajaxurl);
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
