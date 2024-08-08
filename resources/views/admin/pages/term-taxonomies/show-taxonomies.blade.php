@extends('admin.layouts.app')

@section('title', 'Show all term taxonomies')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomies</li>
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
                    <h3 class="box-title">Term Taxonomy data table</h3>
                    <a href="{{url("admin/term/create")}}" class="btn-link">Create</a>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Description</th>
                            <th>Module</th>
                            <th>Status</th>
                            <th>Created by</th>
                            <th class="text-center">#</th>
                        </tr>
                        @forelse ($termTaxonomies as $termTaxonomy)
                        <tr>
                            <td>{{$termTaxonomy->id}}</td>
                            <td>{{$termTaxonomy->name}}</td>
                            <td>{{$termTaxonomy->slug}}</td>
                            <td>{{$termTaxonomy->description}}</td>
                            <td>{{$termTaxonomy->module["name"]}}</td>
                            <td>
                                @if($termTaxonomy->active == 1)
                                <span class="label label-success">Active</span>
                                @else
                                <span class="label label-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{$termTaxonomy->user['firstName']}}</td>
                            <td>
                                <div class="dropdown">
                                    <a href="javascript:void(0)" class="btn btn-link no-padding dropdown-toggle"
                                        id="dropdownMenu1" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-option-vertical"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <li>
                                            <a href="{{ url("admin/term/{$termTaxonomy->id}/edit")}}">Edit</a>
                                        </li>
                                        <li>
                                            <a href="javascript:" class="text-red"
                                                onclick="delete_with_confirm('{{$termTaxonomy->id}}')">Delete</a>
                                        </li>
                                        <form id="{{$termTaxonomy->id}}"
                                            action="{{ url("admin/term/{$termTaxonomy->id}") }}" method="POST"
                                            class="hide">
                                            @method('delete') @csrf
                                        </form>
                                    </ul>
                                </div>
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
                        {{ $termTaxonomies->links() }}
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