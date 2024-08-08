@extends('admin.layouts.app')

@section('title', "Edit - {$position->position_name}")

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Round</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
<section class="content">
  <form action="{{ url("admin/position/{$position->id}") }}" method="POST">
    @method("put")
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit- {{$position->position_name}}</h3>
            <a href="{{url("admin/position/create")}}" class="btn btn-link">Register new</a>
            <a href="{{url("admin/position/all")}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" {{ ($position->active == 1 ) ? "checked" : ""}}> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="position_name">Position Name <span class="text-danger">*</span></label>
                <input type="text" name="position_name" value="{{old('position_name') ?? $position->position_name}}"
                  class="form-control" id="position_name" placeholder="Position name">
                @if ($errors->has('position_name'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('position_name') }}</small>
                </p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="description">Position Description</label>
                <textarea name="description" id="description" rows="4" maxlength="400" class="form-control"
                  placeholder="Position description">{{old('description') ?? $position->description}}</textarea>
                @if ($errors->has('description'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('description') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Update" name="update-btn" title="submit">
              <a href="{{ url("admin/position/{$position->id}/edit") }}" class="btn btn-danger">Reset</a>
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
            <strong><i class="fa fa-book margin-r-5"></i> Position/Designation</strong>
            <p class="text-muted">
              This is the name of Positon/Designation. Required field
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Position Description</strong>
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