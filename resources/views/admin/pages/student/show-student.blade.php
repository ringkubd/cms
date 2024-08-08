@extends('admin.layouts.app')

@section('title', 'Show all Students')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Students</li>
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
                    <h3 class="box-title">Student data table</h3>
                    <a href="{{url("admin/student/create")}}" class="btn btn-link">Register new</a>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th width="150">Position</th>
                            <th width="150">Company</th>
                            <th width="150">Subject</th>
                            <th>Round</th>
                            <th>Module</th>
                            <th>Created by</th>
                            <th class="text-center">Option</th>
                        </tr>
                        @forelse ($students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td>{{$student->name}}</td>
                            <td>{{$student->position["position_name"]}}</td>
                            <td>{{$student->company["name"]}}</td>
                            <td>{{$student->subject["subject_name"]}}</td>
                            <td>{{$student->round["name"]}}</td>
                            <td>{{$student->module["name"]}}</td>
                            <td>{{$student->user["firstName"]." ".$student->user["LastName"]}}</td>
                            <td class="text-center">
                                <a href="{{ url("admin/student/{$student->id}/edit")}}" class="label label-warning"
                                    title="Edit">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>

                                <a href="javascript:" class="label label-danger"
                                    onclick="delete_with_confirm('{{"form-{$student->id}"}}')">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <form id="{{"form-{$student->id}"}}" action="{{ url("admin/student/{$student->id}") }}"
                                    method="POST" style="display: none;">
                                    @method('delete')
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-danger">
                            <td colspan="9">No data</td>
                        </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $students->links() }}
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