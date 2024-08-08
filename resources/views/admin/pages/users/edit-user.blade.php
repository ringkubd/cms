@extends('admin.layouts.app')

@section('title', 'Update selected user')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">User</li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <form action="{{ url("admin/user/{$user->id}") }}" method="POST" enctype="multipart/form-data">
      @method("PUT")
      @csrf
      <div class="row">
        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">User update form</h3>
              <a href="{{url("admin/user")}}" class="btn-link"> Show all</a>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="active" value="1" @if($user->active) checked @endif> Active
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-9">
                  <div class="form-group">
                    <label for="firstName">First name</label>
                    <input type="text" name="firstName" value="{{old('firstName',$user->firstName)}}"
                           class="form-control" id="firstName" placeholder="First name">
                    @error('firstName') <p class="text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="form-group">
                    <label for="LastName">Last name</label>
                    <input type="text" name="LastName" value="{{old('LastName',$user->LastName)}}" class="form-control"
                           id="LastName" placeholder="Last name">
                    @error('LastName') <p class="text-danger">{{ $message }}</p> @enderror
                  </div>
                  <div class="form-group">
                    <label class="gender">Gender: </label>
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="male" @if($user->gender == 'male') checked @endif> Male
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="gender" value="female" @if($user->gender == 'female') checked @endif> Female
                    </label>
                  </div>
                </div> <!-- /.col-sm-9 -->

                <div class="col-sm-3">
                  <div class="nav-tabs-custom margin-bottom-none">
                    <ul class="nav nav-tabs" id="myTabs">
                      <li class="active">
                        <a href="#tab_1" data-toggle="tab" aria-key="old" aria-expanded="true">Old</a>
                      </li>
                      <li class="">
                        <a href="#tab_2" data-toggle="tab" aria-key="new">New</a>
                      </li>
                    </ul>
                    <div class="tab-content">
                      <input type="hidden" name="picKey" id="picKey" value="old">
                      <div class="tab-pane active" id="tab_1">
                        <div class="form-group margin-bottom-none">
                          <label for="customFile" id="customFile" data-input="thumbnail"
                                 data-preview="holder" title="Select Image">
                            <img src="{{asset($user->picture)}}" id="holder"
                                 class="img-responsive user-picture">
                          </label>
                          <input type="text" name="picture" class="form-control hidden"
                                 id="thumbnail">
                        </div>
                      </div> <!-- /.tab-pane -->
                      <div class="tab-pane" id="tab_2">
                        <div class="form-group margin-bottom-none">
                          <label for="newPicture" title="Select Image">
                            <img src="{{asset("img/default-avatar.png")}}" id="new-holder"
                                 class="img-responsive user-picture">
                          </label>
                          <input type="file" name="newPicture" class="form-control hidden"
                                 id="newPicture">
                        </div>
                      </div> <!-- /.tab-pane -->
                    </div> <!-- /.tab-content -->
                  </div>
                </div> <!-- /.col-sm-3 -->
              </div> <!-- /.row -->
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" value="{{old('email',$user->email)}}" class="form-control"
                         id="email" placeholder="email">
                  @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group col-sm-6">
                  <label for="role_id">Role</label>
                  <select name="role_id" class="form-control shortoption" id="role_id">
                    <option value="">None</option>
                    @foreach ($roles as $role)
                      <option value="{{$role->id}}" @if($role->id == $user->role_id) selected @endif>{{$role->name}}</option>
                    @endforeach
                  </select>
                  @error('role_id') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
              </div> <!-- /.row -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="checkbox-inline">
                      <input type="checkbox" name="changedPassword" id="changedPassword" value="1"
                             @if(old('changedPassword')) checked @endif> Change password
                    </label>
                  </div>
                </div>
              </div>
              <div class="row changable @if(old('changedPassword') !== 1) hidden @endif">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="oldPassword">Old Password</label>
                    <input type="password" name="oldPassword" class="form-control" id="oldPassword"
                           placeholder="old password">
                    @error('oldPassword') <p class="text-danger">{{ $message }}</p> @enderror
                  </div>
                </div>
              </div>
              <div class="row changable @if(old('changedPassword') !== 1) hidden @endif">
                <div class="form-group col-sm-6">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control" id="password"
                         placeholder="password">
                  @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
                <div class="form-group col-sm-6">
                  <label for="password_confirmation">Confirm password</label>
                  <input type="password" name="password_confirmation" class="form-control"
                         id="password_confirmation" placeholder="confirm password">
                  @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror
                </div>
              </div> <!-- /.row -->
              <div class="form-group">
                <input type="submit" class="btn btn-green" value="Update" name="submit" title="submit">
                <a href="{{ url("admin/user/{$user->id}/edit") }}" class="btn btn-danger">Reset</a>
              </div>

            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div> <!-- .col-md-7 -->
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
                Email can not be changed in edit option
              </p>
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i> Role</strong>
              <p class="text-muted">
                Select a user role for grouping the user.
              </p>
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i> Change password</strong>
              <p class="text-muted">
                Checked change password you can find more field. Old password must be same that we given
                before. password and confirm password must be same and min 6 character.
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
  <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
  <script>
    $(function () {
      $('.shortoption').select2({
        minimumResultsForSearch: -1
      })

      $('#customFile').filemanager('image');

      $('#changedPassword').on('click', function () {
        if ($(this).is(':checked')) {
          $(".changable").removeClass('hidden');
        } else {
          $(".changable").addClass('hidden');
        }
      });

      $('#myTabs a').click(function (e) {
        e.preventDefault()
        const key = $(this).attr('aria-key');
        $("#picKey").val(key);
      });

      // image preview
      $("#newPicture").change(function () {
        preview_select_picture(this, "#new-holder");
      });

    });

  </script>
@endsection
