@extends('admin.layouts.app')

@section('title', 'Show all Companies')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Company</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Form Element sizes -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Company data table</h3>
          <a href="{{url("admin/company/create")}}" class="btn btn-link">Register new</a>
        </div>
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped table-bordered">
            <tr>
              <th>ID</th>
              <th>Company</th>
              <th>Location</th>
              <th>address</th>
              <th>Status</th>
              <th>Description</th>
              <th>Created by</th>
              <th class="text-center">Option</th>
            </tr>
            @forelse ($companies as $company)
            <tr>
              <td>{{$company->id}}</td>
              <td>{{$company->name}}</td>
              <td>{{$company->location}}</td>
              <td>{{$company->address}}</td>
              <td>{!! $company->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                  class="label label-danger">Inactive</span>' !!}</td>
              <td>{{$company->description}}</td>
              <td>{{$company->user['firstName']." ".$company->user['LastName'] }}</td>
              <td class="text-center">
                <a href="{{ url("admin/company/{$company->id}/edit")}}" class="label label-warning" title="Edit">
                  <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>

                <a href="javascript:" class="label label-danger"
                  onclick="delete_with_confirm('{{"form-{$company->id}"}}')">
                  <i class="fa fa-trash-o" aria-hidden="true"></i>
                </a>
                <form id="{{"form-{$company->id}"}}" action="{{ url("admin/company/{$company->id}") }}" method="POST"
                  style="display: none;">
                  @method('delete')
                  @csrf
                </form>
              </td>
            </tr>
            @empty
            <tr class="bg-danger">
              <td colspan="8">No data</td>
            </tr>
            @endforelse

          </table>
        </div> <!-- /.box-body -->
        <div class="box-footer clearfix">
          <div class="pull-right">
            {{ $companies->links() }}
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