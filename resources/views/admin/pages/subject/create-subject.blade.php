@extends('admin.layouts.app')

@section('title', 'Register new Subject ')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Subject</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
<section class="content">
  <form action="{{ url('admin/course') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Register new Course</h3>
            <a href="{{url("admin/course")}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" checked> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="subjectName">Course Name <span class="text-danger">*</span></label>
                <input type="text" name="subjectName" value="{{old('subjectName')}}" class="form-control"
                  id="subjectName" placeholder="course name">
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
                  <option value="{{$module->id}}">{{$module->name}}</option>
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
                  placeholder="Subject description">{{old('description')}}</textarea>
                @if ($errors->has('description'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('description') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
              <a href="{{ url('admin/course/create') }}" class="btn btn-danger">Reset</a>
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
