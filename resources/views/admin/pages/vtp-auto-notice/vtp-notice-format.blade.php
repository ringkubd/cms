@extends('admin.layouts.app')

@section('title', 'VTP Auto Notice History')


@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{url("admin/dashboard")}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">VTP Auto Notice History</li>
  </ol>
@endsection

{{-- main content start form here --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">VTP Auto Notice History</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Format</th>
                <th>Title</th>
                <th style="width: 500px">Description</th>
                <th class="text-center">Status</th>
              </tr>
              @forelse ($formats as $format)
                <tr>
                  <td><b>{{$format->notice_type}}</b></td>
                  <td>
                    <span class="post-title">{{$format->notice_title}}</span>
                    <p>
                      <a href="{{url("admin/vtp-auto-notice/{$format->id}/edit")}}" class="nav-link text-warning" title="Edit">Edit
                      </a>
                      <span> | </span>
                      <a href="{{url("admin/vtp-auto-notice/{$format->id}")}}" class="nav-link" title="View" >View</a>
                    </p>
                  </td>
                  <td>{{word_limiter(strip_tags($format->notice_details), 20)}}</td>
                  <td class="text-center">
                    @if($format->active)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="6">No Data found</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->
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
      var answer = confirm("Do you want to delete !");
      if (answer === true) {
        $("#" + id).submit();
      }
    }
  </script>

@endsection
