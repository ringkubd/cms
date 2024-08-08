@extends('admin.layouts.app')

@section('title', 'Register new Student ')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Student</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">
  <form action="{{ url('admin/student') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Register new Student</h3>
            <a href="{{url("admin/student")}}" class="btn btn-link">show all</a>
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
              <div class="col-sm-12 form-group">
                <label for="studentName">Student Full Name <span class="text-danger">*</span></label>
                <input type="text" name="studentName" value="{{old('studentName')}}" class="form-control"
                  id="studentName" placeholder="Student name">
                @if ($errors->has('studentName'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('studentName') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="fatherName">Father Name</label>
                <input type="text" name="fatherName" value="{{old('fatherName')}}" class="form-control" id="fatherName"
                  placeholder="Father name">
                @if ($errors->has('fatherName'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('fatherName') }}</small>
                </p>
                @endif
              </div>
              <div class="col-sm-6 form-group">
                <label for="motherName">Mother Name</label>
                <input type="text" name="motherName" value="{{old('motherName')}}" class="form-control" id="motherName"
                  placeholder="Mother name">
                @if ($errors->has('motherName'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('motherName') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                  placeholder="Email">
                @if ($errors->has('email'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('email') }}</small>
                </p>
                @endif
              </div>
              <div class="col-sm-6 form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" id="phone"
                  placeholder="Phone">
                @if ($errors->has('phone'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('phone') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="address">Student Address</label>
                <textarea name="address" id="address" rows="3" maxlength="200" class="form-control"
                  placeholder="Student Address">{{old('address')}}</textarea>
                @if ($errors->has('address'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('address') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="project">Project <span class="text-danger">*</span></label>
                <select name="module_id" id="project" class="form-control longoption">
                  @forelse ($modules as $module)
                  @php $selected = (old("module_id") == $module->id) ? "selected" : "" @endphp
                  <option value="{{$module->id}}" {{$selected}}>{{$module->name}}</option>
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
              <div class="form-group col-sm-6">
                <label for="round">Round <span class="text-danger">*</span> </label>
                <a href="{{url("admin/round/create")}}" class="nav-link" title="create round">
                  <i class="fa fa-link"></i>
                </a>
                <select name="round_id" id="round" class="form-control longoption">
                  @forelse ($rounds as $round)
                  @php $selected = (old("round_id") == $round->id) ? "selected" : "" @endphp
                  <option value="{{$round->id}}" {{$selected}}>{{$round->name}}</option>
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
            </div> <!-- .row -->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="course">Course Name <span class="text-danger">*</span></label>
                <a href="{{url("admin/course/create")}}" class="nav-link" title="create course">
                  <i class="fa fa-link"></i>
                </a>
                <select name="course_id" id="course" class="form-control longoption">
                  @forelse ($subjects as $subject)
                  @php $selected = (old("course_id") == $subject->id) ? "selected" : "" @endphp
                  <option value="{{$subject->id}}" {{$selected}}>{{$subject->subject_name}}</option>
                  @empty
                  <option value="0">none</option>
                  @endforelse
                </select>
                @if ($errors->has('course_id'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('course_id') }}</small>
                </p>
                @endif
              </div>
              <div class="form-group col-sm-6">
                <label for="position">Current Position <span class="text-danger">*</span></label>
                <a href="{{url("admin/position/create")}}" class="nav-link" title="create position">
                  <i class="fa fa-link"></i>
                </a>
                <select name="position_id" id="position" class="form-control longoption">
                  @forelse ($positions as $position)
                  @php $selected = (old("position_id") == $position->id) ? "selected" : "" @endphp
                  <option value="{{$position->id}}" {{$selected}}>{{$position->position_name}}
                  </option>
                  @empty
                  <option value="0">none</option>
                  @endforelse
                </select>
                @if ($errors->has('position_id'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('position_id') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->
            <div class="row">
              <div class="form-group col-sm-12">
                <label for="company">Company</label>
                <a href="{{url("admin/company/create")}}" class="nav-link" title="create company">
                  <i class="fa fa-link"></i>
                </a>
                <select name="company_id" id="company" class="form-control longoption">
                  <option value="0">none</option>
                  @foreach ($companies as $company)
                  @php $selected = (old("company_id") == $company->id) ? "selected" : "" @endphp
                  <option value="{{$company->id}}" {{$selected}}>{{$company->name}}</option>
                  @endforeach
                </select>
                @if ($errors->has('company_id'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('company_id') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->

            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="profile_link">Profile Link</label>
                <input type="text" name="profile_link" value="{{old('profile_link')}}" class="form-control" id="profile_link"
                  placeholder="www.upwork.com/ringkubd">
                @if ($errors->has('profile_link'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('profile_link') }}</small>
                </p>
                @endif
              </div>
              <div class="col-sm-6 form-group">
                <label for="expertise">Expertise</label>
                <input type="text" name="expertise" value="{{old('expertise')}}" class="form-control" id="expertise"
                  placeholder="SEO Expert">
                @if ($errors->has('expertise'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('expertise') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->

            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="job_type">Job Type</label>
                <select name="job_type" id="job_type" class="form-control select2">
                  <option value=""></option>
                  <option value="freelancer">Freelancer</option>
                  <option value="it">IT</option>
                  <option value="other">Other</option>
                </select>
                @if ($errors->has('job_type'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('job_type') }}</small>
                </p>
                @endif
              </div>
              <div class="col-sm-6 form-check" style="padding-top: 2em!important">
                <label for="is_success_stories" class="form-check-label">Is Success Stories?</label>
                <input type="checkbox" value="1" name="is_success_stories" value="{{old('is_success_stories')}}" class="form-check-input" id="is_success_stories">
                @if ($errors->has('is_success_stories'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('is_success_stories') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- .row -->

            <div class="row">
              <div class="form-group col-sm-12">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                    <i class="fa fa-picture-o"></i> Choose Photo
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="profile_image">
                @if ($errors->has('profile_image'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('profile_image') }}</small>
                </p>
                @endif
              </div>
              <img id="holder" style="margin-top:15px;max-height:100px;">
            </div> <!-- .row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Create" name="submit" title="submit">
              <a href="{{ url('admin/student/create') }}" class="btn btn-danger">Reset</a>
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
            <strong><i class="fa fa-book margin-r-5"></i> Student Full Name</strong>
            <p class="text-muted">
              Fill the field with Student Full Name. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Father Name and Mother Name</strong>
            <p class="text-muted">
              Fill the field with student father and mother name.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Email and Phone </strong>
            <p class="text-muted">
              Student active Email address and Phone number. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Student Current Address</strong>
            <p class="text-muted">
              Fill the field with student full current address.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Schorship Project</strong>
            <p class="text-muted">
              Select the Schorship Project for the student. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Round</strong>
            <p class="text-muted">
              Select the Round for the student. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Course</strong>
            <p class="text-muted">
              Select the Course for the student. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Current Position</strong>
            <p class="text-muted">
              Select the Current Position for the success stories of the student. This field can't empty.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Company </strong>
            <p class="text-muted">
              Select the Company for the success stories of the student. This field can't empty.
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
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

<!-- custom script for this page  -->
@section('custom-script')
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script>
  $(function () {
    $('.longoption').select2();
    $('.shortoption').select2({
      minimumResultsForSearch: -1
    });
    $('#lfm').filemanager('image');
    $('#job_type').select2();
  })

</script>
@endsection
