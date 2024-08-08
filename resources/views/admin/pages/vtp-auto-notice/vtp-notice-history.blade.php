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
            <a href="{{url('admin/vtp-auto-notice-refresh')}}">
              <i class="fa fa-refresh"></i> Notice Refresh
            </a>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th style="width: 400px">Description</th>
                <th class="text-center">Status</th>
                <th class="text-center">Date</th>
              </tr>
              @forelse ($notices as $notice)
                <tr>
                  <td>{{$notice->id}}</td>
                  <td>
                    <span class="post-title">{{word_limiter($notice->post_title, 12)}}</span>
                    <p>
                      <a href="{{url("admin/type/vocational-training-programme/{$notice->id}/edit")}}" class="nav-link" title="Edit">Edit
                      </a>|
                      <a href="javascript:" class="nav-link text-danger" onclick="delete_with_confirm('{{$notice->id}}')"
                         title="Delete Item"> Delete </a>|
                      <a href="{{url("vocational-training-programme/{$notice->id}/{$notice->post_slug}")}}" class="nav-link" title="View"
                         target="_blank">View</a>
                    </p>
                    <form id="{{$notice->id}}" action="{{ url("admin/type/vocational-training-programme/{$notice->id}") }}" method="POST"
                          style="display: none;">
                      @method('delete') @csrf
                    </form>
                  </td>
                  <td>{{word_limiter(strip_tags($notice->post_content), 20)}}</td>
                  <td class="text-center">
                    @if($notice->active)
                      <span class="label label-success">Active</span>
                    @else
                      <span class="label label-danger">Inactive</span>
                    @endif
                  </td>
                  <td>
                    {{web_date($notice->created_at)}}
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
              {{ $notices->links() }}
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
