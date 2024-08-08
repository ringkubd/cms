@extends('admin.layouts.app')

@section('title', 'Show all roles')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Role</li>
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
                    <h3 class="box-title">Roles data table</h3>
                    <a href="{{url("admin/role/create")}}" class="btn-link">Create new</a>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Role</th>
                            <th>Description</th>
                            <th class="text-center">Status</th>
                            <th>Created</th>
                            <th class="text-center">#</th>
                        </tr>
                        @forelse ($roles as $role)
                        <tr>
                            <td>{{$role->id}}</td>
                            <td>{{$role->name}}</td>
                            <td>{{ word_limiter($role->description, 15) }}</td>
                            <td class="text-center">
                                @if($role->active == 1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{"{$role->user->firstName} {$role->user->LastName}"}}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="btn-link dropdown-toggle no-padding" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-option-vertical"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="{{ url("admin/role/{$role->id}/edit")}}">Edit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="text-red"
                                                onclick="del_confirm('{{$role->id}}')">Delete</a>
                                        </li>
                                        <form id="{{$role->id}}" action="{{ url("admin/role/{$role->id}") }}"
                                            method="POST" class="hide">
                                            @method('delete') @csrf
                                        </form>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-danger">
                            <td colspan="6">No data</td>
                        </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $roles->links() }}
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