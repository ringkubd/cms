@extends('admin.layouts.app')

@section('title', 'Create new user')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">User</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')
<section class="content">

  <form action="{{ url('admin/user') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create new user</h3>
            <a href="{{url("admin/user")}}" class="btn-link"> Show all</a>
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
              <div class="col-sm-9">
                <div class="form-group">
                  <label for="firstName">First name</label>
                  <input type="text" name="firstName" value="{{old('firstName')}}" class="form-control" id="firstName"
                    placeholder="First name" autofocus>
                  @error('firstName')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="lastName">Last name</label>
                  <input type="text" name="lastName" value="{{old('lastName')}}" class="form-control" id="lastName"
                    placeholder="Last name">
                  @error('lastName')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="gender">Gender: </label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="male" checked> Male
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="female"> Female
                  </label>
                </div>

                @error('picture')
                <p class="text-danger">{{ $message }}</p>
                @enderror

              </div> <!-- /.col-sm-9-->
              <div class="form-group col-sm-3">
                <label for="thumbnail" title="Select Image">
                  <img src="{{asset('img/default-avatar.png')}}" title="upload profile picture" id="holder"
                    class="img-responsive user-picture">
                </label>
                <input type="file" name="picture" class="form-control hidden" id="thumbnail">
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="email"
                  placeholder="email" required>
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group col-sm-6">
                <label for="userRole">Role</label>
                <select name="userRole" class="form-control shortoption" id="userRole">
                  @forelse ($roles as $role)
                  <option value="{{$role->id}}">{{$role->name}}</option>
                  @empty
                  <option value="">None</option>
                  @endforelse
                </select>
                @error('userRole')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
            </div> <!-- /.row -->
            <div class="row">
              <div class="form-group col-sm-6">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="password"
                  required>
                @error('password')
                <p class="text-danger">{{ $message }}</p>
                @enderror
              </div>
              <div class="form-group col-sm-6">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                  placeholder="confirm password" required>
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Create" title="submit">
              <a href="{{ url('admin/user/create') }}" class="btn btn-danger">Reset</a>
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
            <strong><i class="fa fa-book margin-r-5"></i> First name and Last name</strong>
            <p class="text-muted">
              User first name and last name are different field that are combine or user only one on the
              view.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Upload Picture</strong>
            <p class="text-muted">
              Upload user picture format as jpeg, jpg, png, gif. Picture size must be lower than 1mb.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Email</strong>
            <p class="text-muted">
              Email must be a unique email. That means This email must not use before for this website.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Role</strong>
            <p class="text-muted">
              Select a user role for grouping the user.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Password and Confirm Password</strong>
            <p class="text-muted">
              Password and confirm password must be same and min 6 caracter.
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


{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

{{-- custom script for this page --}}
@section('custom-script')
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
  $(function () {
        $('.shortoption').select2({
            minimumResultsForSearch: -1
        });

        $("#thumbnail").change(function () {
            preview_select_picture(this, "#holder");
        });
    })
</script>
@endsection