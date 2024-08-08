@extends('admin.layouts.app')

@section('title', 'Show all Rounds')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Round</li>
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
                    <h3 class="box-title">Round data table</h3>
                    <a href="{{url("admin/round/create")}}" class="btn btn-link">Register new</a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Module</th>
                            <th>Created by</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($rounds as $round)
                        <tr>
                            <td>{{$round->id}}</td>
                            <td>{{$round->name}}</td>
                            <td>{{$round->description}}</td>
                            <td>{!! $round->active == 1 ? '<span class="label label-success">Active</span>' : '<span
                                    class="label label-danger">Inactive</span>' !!}</td>
                            <td>{{$round->module["name"]}}</td>
                            <td>{{$round->user['firstName']." ".$round->user['LastName'] }}</td>
                            <td class="text-center">
                                <a href="{{ url("admin/round/{$round->id}/edit")}}" class="label label-warning" title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="javascript:" class="label label-danger" onclick="delete_with_confirm('{{"form-{$round->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$round->id}"}}" action="{{ url("admin/round/{$round->id}") }}" method="POST"
                                    style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
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
                        {{ $rounds->links() }}
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
