@extends('admin.layouts.app')

@section('title', "Edit - {$subject->subject_name}")

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Subject</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
<section class="content">
  <form action="{{ url("admin/course/{$subject->id}") }}" method="POST">
    @method("put")
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit- {{$subject->subject_name}}</h3>
            <a href="{{url("admin/course")}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" {{ ($subject->active == 1 ) ? "checked" : ""}}> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="subjectName">Subject Name <span class="text-danger">*</span></label>
                <input type="text" name="subjectName" value="{{old('subjectName') ?? $subject->subject_name}}"
                  class="form-control" id="subjectName" placeholder="Subject name">
                @if ($errors->has('subjectName'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('subjectName') }}</small>
                </p>
                @endif
              </div>
              <div class="form-group col-sm-6">
                <label for="project">Project</label>
                <select name="module_id" id="project" class="form-control longoption">
                  @forelse ($modules as $module)
                  @php $select = ($module->id == $subject->module_id) ? "selected" : "" @endphp
                  <option value="{{$module->id}}" {{$select}}>{{$module->name}}</option>
                  @empty
                  <option value="0">none</option>
                  @endforelse
                </select>
                @if ($errors->has('module_id'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('module_id') }}</small>
                </p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="description">Subject Description</label>
                <textarea name="description" id="description" rows="4" maxlength="400" class="form-control"
                  placeholder="Subject description">{{old('description') ?? $subject->description}}</textarea>
                @if ($errors->has('description'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('description') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- /.row -->
            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Update" name="update-btn" title="submit">
              <a href="{{ url("admin/course/{$subject->id}/edit") }}" class="btn btn-danger">Reset</a>
            </div>

          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-7 -->
      <div class="col-sm-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Help</h3>
          </div>
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Subject Name</strong>
            <p class="text-muted">
              This is the name of Subject. Required field
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Subject Description</strong>
            <p class="text-muted">
              This is the short descriptions of the Position. It is optional to input. You can fill it
              later.
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

<!-- custom style for this page -->
@section('custom-css-file')
<!-- bootstrap-datetimepicker -->
<link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
<!-- select 2 -->
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

<!-- custom script for this page  -->
@section('custom-script')
<!-- datepicker -->
<script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
<!-- Select2 -->
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
  $(function () {
    $('.longoption').select2();
    $('.shortoption').select2({
      minimumResultsForSearch: -1
    });

    // date time picker
    var dateNow = new Date();
    $('.dateTimePicker').datetimepicker({
      format: "DD-MM-YYYY hh:mm a",
      // defaultDate: moment().subtract(1, 'days'),
      defaultDate: moment(),
      useCurrent: false
    });
  })

</script>
@endsection
