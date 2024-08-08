@extends('admin.layouts.app')

@inject("home", "App\Home")

@section('title', 'Save your website General Settings')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">General Settings</li>
</ol>
@stop
{{-- main content section strat  --}}
@section('content')

@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<section class="content">
  <form action="{{ url('admin/settings/general-settings-save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">General Settings</h3>
          </div>
          <div class="box-body">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="site_title">Site Title</label>
                    <input type="text" name="site_title"
                      value="{{old('site_title') ?? $home->get_settings("site_title") }}" class="form-control"
                      id="siteTitle" placeholder="Site Title" autofocus>
                    @error('site_title')
                    <p class="text-danger margin-bottom-none">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="tagline">Tagline</label>
                    <input type="text" name="tagline" value="{{old('tagline') ?? $home->get_settings("tagline") }}"
                      class="form-control" id="tagline" placeholder="Tagline">
                    @error('tagline')
                    <p class="text-danger margin-bottom-none">{{$message}}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label class="inline-radio-title">Preview</label>
                    @php
                    $logo_preview = old("logo_preview") ?? $home->get_settings("logo_preview");
                    $logo = $logo_preview == "logo" ? "checked" : "";
                    @endphp
                    <label class="radio-inline">
                      <input type="radio" name="logo_preview" value="title" checked> Site Title
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="logo_preview" value="logo" {{$logo}}> Site Logo
                    </label>
                  </div>
                </div>
                <div class="col-sm-4">
                  @php
                  $logo_picture = $home->get_settings("logo_picture");
                  $logo_picture = !empty($logo_picture) ? $logo_picture : "img/no-image.png";
                  @endphp
                  <div class="form-group margin-bottom-none ">
                    <label for="thumbnail">Site Logo</label>
                    <label for="thumbnail" title="Select Image">
                      <img src="{{asset($logo_picture)}}" title="upload" id="holder" class="img-responsive upload-logo"
                        alt="Logo">
                    </label>
                    <input type="file" name="logo_picture" class="form-control hidden" id="thumbnail">
                  </div>
                  @error('logo_picture')
                  <p class="text-danger margin-bottom-none">{{$message}}</p>
                  @enderror
                </div>
              </div>
              <div class="form-group">
                <label for="home_url">Site Address (URL)</label>
                <input type="url" name="home_url" value="{{old('home') ?? $home->get_settings("home_url") }}"
                  class="form-control" id="home_url" placeholder="{{url("/")}}">
                @error('home_url')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="meta_title">Meta title</label>
                <input type="text" name="meta_title" value="{{old('meta_title') ?? $home->get_settings("meta_title") }}"
                  class="form-control" id="meta_title" placeholder="Meta title">
                @error('meta_title')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="meta_key">Meta Keyword</label>
                <input type="text" name="meta_key" value="{{old('meta_key') ?? $home->get_settings("meta_key")}}"
                  class="form-control" id="meta_key" placeholder="meta keyword">
                @error('meta_key')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="meta_desc">Meta Description</label>
                <textarea name="meta_desc" class="form-control" id="meta_desc" rows="3"
                  placeholder="Website meta Description">{{old('meta_desc') ?? $home->get_settings("meta_desc")}}</textarea>
                @error('meta_desc')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group margin-bottom-none ">
                @php
                $meta_picture = $home->get_settings("meta_picture");
                $meta_picture = !empty($meta_picture) ? $meta_picture : "img/no-image.png";
                @endphp
                <label for="picture">Meta Pictures</label>
                <label for="meta_picture" title="Select Image">
                  <img src="{{asset($meta_picture)}}" title="upload" id="meta_holder" class="img-responsive upload-logo"
                    alt="Logo">
                </label>
                <input type="file" name="meta_picture" class="form-control hidden" id="meta_picture">
                @error('meta_picture')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-green" value="Save" name="submit" title="submit">
                <a href="{{ url('admin/settings/general-settings') }}" class="btn btn-danger">Reset</a>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="tranding_now">Trending Now Pages <button type="button" class="btn btn-link"
                    data-toggle="modal" data-target="#addPage"> Add Path</button></label>
                <select name="tranding_now[]" multiple="multiple" class="form-control longOption" id="tranding_now">
                  @foreach(trending_now_pages() as $key => $value)
                  @php
                  $path = explode(',',$home->get_settings("tranding_now"));
                  @endphp
                  <option value="{{$key}}" @if(in_array($key, $path)) selected @endif>{{$value}}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="date_format">Date format</label>
                <select name="date_format" class="form-control shortOption" id="date_format">
                  @foreach(set_date_time_format() as $key => $value)
                  <option value="{{$key}}" @if($home->get_settings("date_format") == $key) selected @endif>{{$value}}
                  </option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                @php
                $time = old("time_format") ?? $home->get_settings("time_format");
                $gia = $time == "g:i a" ? "checked" : "";
                $giA = $time == "g:i A" ? "checked" : "";
                $Hi = $time == "H:i" ? "checked" : "";
                @endphp
                <label for="theme">Time format</label>
                <br>
                <label class="radio-inline">
                  <input type="radio" name="time_format" value="g:i a" {{$gia}}> 10:00 am
                </label>
                <label class="radio-inline">
                  <input type="radio" name="time_format" value="g:i A" {{$giA}}> 10:00 AM
                </label>
                <label class="radio-inline">
                  <input type="radio" name="time_format" value="H:i" {{$Hi}}> 13:00
                </label>
              </div>
              <div class="form-group">
                @php
                $fbActive = $home->check_settings_active("facebook_url");
                $fbActive = old("facebook_active", $fbActive);
                $activeChecked = $fbActive ? "checked" : null;
                $fbUrl = $home->get_settings("facebook_url");
                @endphp
                <label for="facebook_url">Facebook page url</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <input type="checkbox" name="facebook_active" value="1" id="facebook_url" {{$activeChecked}}>
                  </div>
                  <input type="text" name="facebook_url" class="form-control" value="{{old("facebook_url", $fbUrl)}}"
                    placeholder="http://facebook.com/page_id">
                </div>
              </div>
              <div class="form-group">
                @php
                $inActive = $home->check_settings_active("linkedin_url");
                $inActive = old("linkedin_active", $inActive);
                $inChecked = $inActive ? "checked" : null;
                $inUrl = $home->get_settings("linkedin_url");
                @endphp
                <label for="linkedid_url">Linkedin url</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <input type="checkbox" name="linkedin_active" value="1" id="linkedid_url" {{$inChecked}}>
                  </div>
                  <input type="text" name="linkedid_url" class="form-control" value="{{old("linkedid_url", $inUrl)}}"
                    placeholder="http://linkedin.com/page_id">
                </div>
              </div>
              <div class="form-group">
                @php
                $ytActive = $home->check_settings_active("youtube_url");
                $ytActive = old("youtube_active", $ytActive);
                $ytChecked = $ytActive ? "checked" : null;
                $ytUrl = $home->get_settings("youtube_url");
                @endphp
                <label for="youtube_url">YouTube url</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <input type="checkbox" name="youtube_active" value="1" id="youtube_url" {{$ytChecked}}>
                  </div>
                  <input type="text" name="youtube_url" class="form-control" value="{{old("youtube_url", $ytUrl)}}"
                    placeholder="http://YouTube.com/channel">
                </div>
              </div>

              <div class="panel panel-default">
                <div class="panel-heading">Vocational Programme API Token</div>
                <div class="panel-body">
                  <div class="form-group">
                    <label for="vt_api_base_url">Base Url</label>
                    <input type="text" name="vt_api_base_url"
                      value="{{old('vt_api_base_url') ?? $home->get_settings("vt_api_base_url")}}" class="form-control"
                      id="vt_api_base_url" placeholder="vocational api token">
                    @error('vt_api_base_url')
                    <p class="text-danger margin-bottom-none">{{$message}}</p>
                    @enderror
                  </div> <!-- form-group -->
                  <div class="form-group">
                    <label for="vt_api_token">APi Token</label>
                    <input type="text" name="vt_api_token"
                      value="{{old('vt_api_token') ?? $home->get_settings("vt_api_token")}}" class="form-control"
                      id="vt_api_token" placeholder="vocational api token">
                    @error('vt_api_token')
                    <p class="text-danger margin-bottom-none">{{$message}}</p>
                    @enderror
                  </div> <!-- form-group -->
                </div>
              </div>

            </div> <!-- .col-sm-6 -->
          </div> <!-- .box-body -->
        </div> <!-- .box -->
      </div> <!-- .col-md-12 -->
    </div> <!-- .row -->
  </form>


  <!-- Modal -->
  <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="addPageLabel">
    <div class="modal-dialog" role="document">
      <form action="{{url('admin/settings/save-page-path')}}" method="post">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="addPageLabel">Add Restrictionable Page </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="page_name">Page name</label>
              <input type="text" name="page_name" class="form-control" id="page_name" value="{{old('page_name')}}"
                placeholder="page path">
            </div>
            <div class="form-group">
              <label for="page_path">Page path</label>
              <input type="text" name="page_path" class="form-control" id="page_path" value="{{old('page_path')}}"
                placeholder="page path">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div> <!-- /.modal-content -->
      </form>
    </div> <!-- /.modal-dialog -->
  </div> <!-- /.modal -->

</section>
@endsection


@section('custom-script')

<script>
  // image preview
    $("#thumbnail").change(function () {
      preview_select_picture(this, "#holder");
    });
    // image preview
    $("#meta_picture").change(function () {
      preview_select_picture(this, "#meta_holder");
    });
</script>

@endsection