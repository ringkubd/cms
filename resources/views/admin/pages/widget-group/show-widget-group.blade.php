@extends('admin.layouts.app')

@section('title', 'Show all Widget group')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li>widget</li>
    <li>widget-group</li>
    <li class="active">show widget-group</li>
  </ol>
@endsection

{{-- main content start from here --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Widget Group data table</h3>
            <a href="{{url("admin/widget-group/create")}}" class="btn btn-link">Create new</a>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>description</th>
                <th>Status</th>
                <th>Created by</th>
                <th class="text-center">Option</th>
              </tr>
              @forelse ($WiGroups as $WiGroup)
                <tr>
                  <td>{{$WiGroup->id}}</td>
                  <td>{{$WiGroup->name}}</td>
                  <td>{{$WiGroup->slug}}</td>
                  <td>{{$WiGroup->description}}</td>
                  <td>
                    @if($WiGroup->active == 1)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td>
                    @if($WiGroup->user)
                      {{"{$WiGroup->user->firstName} {$WiGroup->user->LastName}"}}
                    @endif
                  </td>
                  <td class="text-center">
                    <a href="{{ url("admin/widget-group/{$WiGroup->id}/edit")}}" class="label label-warning" title="Edit">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>
                    <a href="javascript:" class="label label-danger btn-delete" data-delete-link="/admin/widget-group/{{$WiGroup->id}}">
                      <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="7">No data</td>
                </tr>
              @endforelse
            </table>
          </div> <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $WiGroups->links() }}
            </div>
          </div> <!-- /.box box-footer -->
        </div> <!-- /.box -->
      </div> <!-- .col-md-7 -->
    </div> <!-- .row -->
  </section>

@stop



@section('custom-script')
  <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
  <style>
    .swal2-styled:focus {
      outline: 0;
      box-shadow: none;
    }
  </style>
@stop
