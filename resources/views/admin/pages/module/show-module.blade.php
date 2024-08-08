@extends('admin.layouts.app')

@section('title', 'Show all modules')


@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Module</li>
  </ol>
@endsection

{{-- main content start form here --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Module data table</h3>
            <a href="{{url("admin/module/create")}}" class="btn btn-link">Create new</a>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Inception</th>
                <th style="width: 400px">Description</th>
                <th class="text-center">Status</th>
                <th class="text-center">#</th>
              </tr>
              @forelse ($modules as $module)
                <tr>
                  <td>{{$module->id}}</td>
                  <td>{{$module->name}}</td>
                  <td>{{$module->slug}}</td>
                  <td class="text-center">{{date('Y', strtotime($module->start_form) )}}</td>
                  <td>{!! word_limiter($module->description, 8) !!}</td>
                  <td class="text-center">
                    @if($module->active)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td class="text-center">
                    <div class="dropdown">
                      <a href="javascript:void(0)" class="btn btn-link no-padding dropdown-toggle" id="dropdownMenu1"
                         data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                        <li>
                          <a href="{{ url("admin/module/{$module->id}/edit")}}">Edit</a>
                        </li>
                        <li>
                          <a href="javascript:" class="text-red"
                             onclick="delete_with_confirm('{{"form-{$module->id}"}}')">Delete</a>
                        </li>
                        <form id="{{"form-{$module->id}"}}" action="{{ url("admin/module/{$module->id}") }}" method="POST"
                              class="hide">
                          @method('delete') @csrf
                        </form>
                      </ul>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="6">No Data found</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $modules->links() }}
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
