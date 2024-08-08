@extends('admin.layouts.app')

@section('title', 'Edit Notice Format')


@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url("admin/dashboard") }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Edit Format</li>
  </ol>
@endsection

{{-- main content start from here --}}
@section('content')
  <section class="content">
    <form action="{{ url("admin/vtp-auto-notice/{$format->id}") }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col-md-8">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit VTP Notice <strong>{{$format->notice_type}}</strong> Format</h3>
              <a href="{{url('admin/vtp-auto-notice/create')}}" class="btn btn-link">Show all</a>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="active" value="1" @if($format->active) checked @endif> Active
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="notice_title">Notice Title <span class="text-danger">*</span></label>
                <input type="text" name="notice_title" value="{{ old('notice_title',$format->notice_title)}}" class="form-control"
                       id="notice_title" placeholder="Notice Title">
                @error('notice_title')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>
              <div class="form-group">
                <label for="notice_details">Notice Details <span class="text-danger">*</span></label>
                <textarea name="notice_details" class="form-control"
                          id="notice_details">{{ old("notice_details", $format->notice_details)}}</textarea>
                @error('notice_details')
                <p class="text-danger margin-bottom-none">{{$message}}</p>
                @enderror
              </div>

              <div class="form-group">
                <input type="submit" class="btn btn-green" value="Update" title="Update">
                <a href="{{ url("admin/vtp-auto-notice/{$format->id}/edit") }}" class="btn btn-danger">Reset</a>
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
              <strong><i class="fa fa-book margin-r-5"></i> Hints</strong>
              <p class="text-muted"> <b>[round]</b>  = for Showing Round. </p>
              <p class="text-muted"> <b>[lastdate]</b>  = for Showing Application Last date. </p>
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i> Guides</strong>
              <p class="text-muted">
                Use the text with squire bracket for placing the dynamic content on the notice post.
              </p>
              <hr>
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div> <!-- .col-md-4 -->
      </div> <!-- .row -->
    </form>
  </section>
@endsection


{{-- custom style for this page --}}
@section("custom-css-file")
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.3/summernote.css">
@endsection

{{-- custom script for this page --}}
@section('custom-script')
  <script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
  <script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
  <script>
    $(function () {
      small_editor("#notice_details", 400);
    })
  </script>
@endsection
