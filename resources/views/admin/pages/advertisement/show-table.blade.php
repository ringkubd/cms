@extends('admin.layouts.app')
@section('title', "Show all Advertisement Table")
@php
$filters = isset($filters) ? $filters : array();
$module_id = $filters["module_id"] ?? null;
$author_id = $filters["author_id"] ?? null;
$status = $filters["status"] ?? null;
$dateFilter = $filters["dateFilter"] ?? null;
$dateRange = $filters["dateRange"] ?? null;
if(!empty($filters)){
$adverts =
\App\Models\ContentModels\Advertisement::get_advertisement_filter_data($module_id,$author_id,$status,$dateFilter,$dateRange
);
}
@endphp

@section('breadcrumb')
<ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Advertisement</li>
</ol>
@endsection

{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- Form Element sizes -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Advertisement Data table </h3>
                    <button class="btn btn-sm btn-info" type="button" data-toggle="collapse" data-target="#filter"
                        aria-expanded="false" aria-controls="filter">
                        Filter
                    </button>
                    <a href="{{url("admin/advertisement/create")}}">Add New</a>
                    <div class="collapse" id="filter">
                        <form action="{{url("admin/filter-advertisement")}}" method="get">
                            <div class="row">
                                <div class="col-sm-11" style="padding: 0">
                                    <div class="form-group col-sm-3">
                                        <label for="author">Author</label>
                                        <select name="author" id="author" class="form-control">
                                            <option value="all">All</option>
                                            @foreach($authors as $key => $author)
                                            @php $select = $author_id == $key ? "selected" : ""; @endphp
                                            <option value="{{$key}}" {{$select}}>{{$author}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="module">Module</label>
                                        <select name="module" id="module" class="form-control">
                                            <option value="all">All</option>
                                            @foreach($modules as $key => $module)
                                            @php
                                            $item_id = isset($module->id) ? $module->id : "";
                                            $select = $module_id == $item_id ? "selected" : "";
                                            @endphp
                                            <option value="{{$item_id}}" {{$select}}>{{$module->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="status">Status</label>
                                        <select name="status" id="status" class="form-control">
                                            @php
                                            $status = isset($status) ? $status : "";
                                            $all = $status == "all" ? "selected" : "";
                                            $publish = $status == "publish" ? "selected" : "";
                                            $draft = $status == "draft" ? "selected" : "";
                                            $schedule = $status == "schedule" ? "selected" : "";
                                            @endphp
                                            <option value="all" {{$all}}>All</option>
                                            <option value="publish" {{$publish}}>Publish</option>
                                            <option value="draft" {{$draft}}>Draft</option>
                                            <option value="schedule" {{$schedule}}>Schedule</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-3">
                                        <label for="dateRange">Date Range</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                @php
                                                $check = old("dateFilter") ?? $dateFilter == 1 ? "checked" : "";
                                                @endphp
                                                <input type="checkbox" name="dateFilter" value="1" {{$check}}>
                                            </div>
                                            <input type="text" name="dateRange" value="{{$dateRange}}"
                                                class="form-control pull-right" id="dateRange">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="Submit" style="visibility: hidden">submit</label>
                                        <input type="submit" value="Submit" class="btn btn-info">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-striped table-bordered table-hover">
                        <tr class="vertical-middle">
                            <th width="10">
                                <input type="checkbox" class="minimal" id="checkall">
                            </th>
                            <th width="250">Title</th>
                            <th width="100" class="text-center">Picture</th>
                            <th width="120" class="text-center">Module</th>
                            <th width="80" class="text-center">Home</th>
                            <th width="120" class="text-center">Author</th>
                            <th width="150" class="text-center">Date</th>
                        </tr>
                        @forelse($adverts as $item)
                        <tr>
                            <td>
                                <input type="checkbox" name="checked_post[]" value="{{$item->id}}"
                                    class="minimal post-check">
                            </td>
                            <td>
                                <span class="post-title">{!! $item->title !!}</span>
                                <p>
                                    <a href="{{url("admin/advertisement/{$item->id}/edit")}}" class="nav-link"
                                        title="Edit">Edit </a>|
                                    <a href="javascript:" class="nav-link text-danger"
                                        onclick="delete_with_confirm('{{"form-{$item->id}"}}')" title="Delte Item">
                                        Delete </a>
                                </p>
                                <form id="{{"form-{$item->id}"}}" action="{{ url("admin/advertisement/{$item->id}") }}"
                                    method="POST" style="display: none;">
                                    @method('delete') @csrf
                                </form>
                            </td>
                            <td style="padding: 0" class="text-center">
                                <img src="{{asset(thumbs_url($item->picture))}}" width="100" alt="{!! $item->title !!}">
                            </td>
                            <td class="text-center">
                                @php
                                $item = isset($item) ? $item : "";
                                $ad_Module =
                                \App\Models\ContentModels\Advertisement::get_advertisement_module_array($item->id);
                                @endphp
                                @foreach($ad_Module as $module)
                                <a href="{{url("admin/filter-advertisement?author=all&module={$module->id}&status=all&dateFilter=''&dateRange=''")}}"
                                    title="{{$module->name}}">
                                    {{$module->name}}
                                </a>
                                <span>, </span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($item->home_page == 1)
                                <input type="checkbox" disabled="" checked>
                                @elseif($item->home_page == 0)
                                <input type="checkbox" disabled="">
                                @endif
                            </td>
                            <td class="text-center">
                                <a
                                    href="{{url("admin/filter-advertisement?author={$item->user_id}&module=all&status=all&dateFilter=''&dateRange=''")}}">{{$item->firstName." ".$item->LastName}}
                                </a>
                            </td>
                            <td class="text-center">
                                <p class="status">{{$item->status}}</p>
                                @if($item->status == "schedule")
                                <p class="date">{{ date("d-m-Y h:i a", strtotime($item->schedule_time)) }}</p>
                                @elseif($item->status == "draft")
                                <p class="date">{{ date("d-m-Y h:i a", strtotime($item->created_at)) }}</p>
                                @else
                                <p class="date">{{ date("d-m-Y h:i a", strtotime($item->created_at)) }}</p>
                                @endif
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="5">No post data</td>
                        </tr>
                        @endforelse

                    </table>
                </div> <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <div class="pull-right">
                        {{ $adverts->appends([
                                'author' => $author_id,
                                'module' => $module_id,
                                'status' => $status,
                                'dateFilter' => $dateFilter,
                                'dateRange' => $dateRange
                            ])->links() }}
                    </div>
                </div> <!-- /.box box-footer -->
            </div> <!-- /.box -->
        </div>
        <!--/.col-md-7 -->
    </div>
    <!--/.row -->

</section>

@endsection

@section("custom-style")
<link rel="stylesheet" href="{{asset("assets/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
@endsection

@section('custom-script')
<script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
<script src="{{ asset("assets/bower_components/bootstrap-daterangepicker/daterangepicker.js") }}"></script>
<script>
    $(function () {
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $(document).on('ifChecked', '#checkall', function () {
                $(".post-check").iCheck('check');
            });
            $(document).on('ifUnchecked', '#checkall', function () {
                $(".post-check").iCheck('uncheck');
            });
            //Date range picker
            $('#dateRange').daterangepicker()
        });

        function delete_with_confirm(id) {
            var answar = confirm("Do you want to delete !");
            if (answar == true) {
                $("#" + id).submit();
            }
        }
</script>

@endsection