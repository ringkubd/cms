@extends('admin.layouts.app')

@section('title', 'Show all users')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">User</li>
  </ol>
@endsection

{{-- main content start form here --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- Form Element sizes -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Users data table</h3>
            <a href="{{ url("admin/user/create")}}" class="btn-link">Create new</a>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Gender</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                <th class="text-center">#</th>
              </tr>
              @forelse ($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->firstName." ".$user->LastName}}</td>
                  <td>{{$user->gender}}</td>
                  <td>
                    <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                  </td>
                  <td>{{$user->role->name ?? 'not set'}}</td>
                  <td class="text-center">
                    @if($user->active == 1)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="dropdown">
                      <a href="javascript:void(0)" class="btn-link dropdown-toggle no-padding"
                         data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-right">
                        <li>
                          <a href="{{ url("admin/user/{$user->id}")}}">Profile</a>
                        </li>
                        <li>
                          <a href="{{ url("admin/user/{$user->id}/edit")}}">Edit</a>
                        </li>
                        <li>
                          <a href="javascript:void(0)" class="text-red"
                             onclick="del_confirm('{{$user->id}}')">Delete</a>
                        </li>
                        <form id="{{$user->id}}" action="{{ url("admin/user/{$user->id}") }}" method="POST"
                              class="hide">
                          @method('delete') @csrf
                        </form>
                      </ul>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="7">No Data found</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $users->links() }}
            </div>
          </div> <!-- /.box box-footer -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-7 -->
    </div>
    <!--/.row -->

  </section>

@endsection


@section('custom-script')

  <script>
    function delete_with_confirm(id) {
      var answar = confirm("Do you want to delete !");
      if (answar == true) {
        $("#" + id).submit();
      }
    }

  </script>

@endsection
