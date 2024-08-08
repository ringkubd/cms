@extends('admin.layouts.app')

@section('title', "Show all pages")

@inject('carbon', 'Carbon\Carbon')


@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Pages</li>
  </ol>
@endsection

{{-- custom style for this page --}}
@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="headerbox-navigation" style="margin-bottom: 10px;">
              <h3 class="box-title">All Pages</h3>
              <a role="button" data-toggle="collapse" data-target="#filter" aria-controls="filter">
                <i class="fa fa-filter"></i> Filter
              </a>
              <a href="{{url("admin/page")}}"> <i class="fa fa-refresh"></i> Clear Filter</a>
              <a href="{{url("admin/page/create")}}"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <form class="form-inline custom-post-search" action="#" method="get">
              <div class="form-group text-right">
                <label for="search" class="sr-only">Search</label>
                <input type="search" name="search" class="form-control" value="{{request('search')}}" id="search" placeholder="search">
              </div>
              <button type="button" class="btn btn-default" id="searchBtn">Search</button>
            </form>

            <div class="collapse @if(request("module")) in @endif" id="filter" style="margin-top: 10px;">
              <form action="#" method="get" class="post-filter">
                <div class="row">
                  <div class="form-group col-sm-2 pr-0">
                    <select name="module" class="form-control form-control-sm longOption">
                      <option value="">All Modules</option>
                      <option value="individual" @if(request("module") == "individual") selected
                        @endif>Individual
                      </option>
                      @foreach($modules as $module)
                        <option value="{{$module->slug}}" @if(request("module") == $module->slug) selected
                          @endif>{{$module->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-sm-2 pr-0">
                    <select name="author" class="form-control form-control-sm shortOption">
                      <option value="">All Author</option>
                      @foreach($authors as $author)
                        <option value="{{$author->id}}" @if(request("author") == $author->id) selected
                          @endif>{{"{$author->firstName} {$author->LastName}"}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-sm-2 pr-0">
                    <select name="status" class="form-control form-control-sm shortOption">
                      <option value="">All Status</option>
                      <option value="publish" @if(request("status") == "publish") selected @endif>Publish
                      </option>
                      <option value="draft" @if(request("status") == "draft") selected @endif>Draft</option>
                      <option value="schedule" @if(request("status") == "schedule") selected @endif>Schedule
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-sm-4 pr-0">
                    <div class="input-group text-center">
                      <input type="text" class="form-control datepicker" name="start" value="{{request('start')}}"
                             placeholder="{{$carbon->now()->subDays(30)->format("d-m-Y")}}"/>
                      <span class="input-group-addon mx-2"> to </span>
                      <input type="text" class="form-control datepicker" name="end"
                             value="{{request('end') ?? $carbon->now()->format("d-m-Y") }}"/>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <select name="order" class="form-control form-control-sm shortOption">
                      <option value="desc">DESC</option>
                      <option value="asc" @if(request()->input("order") == "asc") selected @endif>ASC</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
          </div>

          <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered table-hover">
              <tr class="vertical-middle">
                <th style="width: 10px">
                  <label><input type="checkbox" class="minimal" id="checkall"></label>
                </th>
                <th>Title</th>
                <th style="width: 180px" class="text-center">Modules</th>
                <th style="width: 120px" class="text-center">Author</th>
                <th style="width: 150px" class="text-center">Date</th>
              </tr>
              @forelse($posts as $post)
                @if($post->user)
                  <tr>
                    <td>
                      <input type="checkbox" name="checked_post[]" value="{{$post->id}}" class="minimal post-check">
                    </td>
                    <td>
                      <span class="post-title">{!! $post->post_title !!}</span>
                      <p>
                        <a href="{{url("admin/page/{$post->id}/edit")}}" class="nav-link" title="Edit">Edit </a>|
                        @if($post->pageModule)
                        <a href="{{url("{$post->pageModule->slug}/{$post->post_slug}")}}" class="nav-link" title="View" target="_blank">View</a>|
                        @else
                        <a href="{{url($post->post_slug)}}" class="nav-link" title="View" target="_blank">View</a>|
                        @endif
                        <a href="javascript:void(0)" class="nav-link text-danger"
                           onclick="delete_with_confirm('{{"form-{$post->id}"}}')" title="Delete Item"> Delete </a>
                      </p>
                      <form id="{{"form-{$post->id}"}}" action="{{ url("admin/page/{$post->id}") }}" method="POST"
                            style="display: none;">
                        @method('delete') @csrf
                      </form>
                    </td>
                    <td class="text-center">
                      @if($post->pageModule)
                        <a href="{{url("admin/page?module={$post->post_format}")}}">{{$post->pageModule->name}}</a>
                      @else
                        <a href="{{url("admin/page?module={$post->post_format}")}}">{{ ucfirst($post->post_format) }}</a>
                      @endif
                    </td>
                    <td class="text-center">
                      <a href="{{url("admin/page?author={$post->user_id}")}}">
                        {{$post->user->firstName." ".$post->user->LastName}}
                      </a>
                    </td>
                    <td class="text-center">
                      <p class="status">{{$post->post_status}}</p>
                      @if($post->post_status == "schedule")
                        <p class="date">{{ date("d-m-Y h:i a", strtotime($post->schedule_time)) }}</p>
                      @elseif($post->post_status == "draft")
                        <p class="date">{{ date("d-m-Y h:i a", strtotime($post->created_at)) }}</p>
                      @else
                        <p class="date">{{ date("d-m-Y h:i a", strtotime($post->created_at)) }}</p>
                      @endif
                    </td>
                  </tr>
                @endif
              @empty
                <tr>
                  <td colspan="5">No post data</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->

          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $posts->appends([
                    'module' => request("module"),
                    'author' => request("author"),
                    'status' => request("status"),
                    'start' => request("start"),
                    'end' => request("end"),
                    'order' => request("order")
              ])->links() }}
            </div>
          </div> <!-- /.box box-footer -->
        </div> <!-- /.box -->
      </div> <!--/.col-md-7 -->
    </div> <!--/.row -->
  </section>

@endsection

@section("custom-style")
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection
@section('custom-script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
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

      $('.datepicker').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        weekStart: 5,
        daysOfWeekHighlighted: "5",
        todayHighlight: true,
      });

    });

    function delete_with_confirm(id) {
      let answer = confirm("Do you want to delete !");
      if (answer === true) {
        $("#" + id).submit();
      }
    }

    function getUrlVars()
    {
      let queryStr = window.location.search,
        queryArr = queryStr.replace('?', '').split('&'),
        queryParams = [];
      for (let q = 0, qArrLength = queryArr.length; q < qArrLength; q++) {
        let qArr = queryArr[q].split('=');
        queryParams[qArr[0]] = qArr[1];
      }
      return queryParams;
    }

    function filter_post(){
      let queryString = getUrlVars();
      let searchTxt = $(".custom-post-search").serializeArray();
      let filter = $(".post-filter").serializeArray();
      let newArray = searchTxt.concat(filter,queryString);
      let newObj = "";
      for(let i = 0; i <= newArray.length; i++){
        if(typeof newArray[i] !== "undefined"){
          const name = newArray[i].name;
          const value = newArray[i].value;
          if(value !== ""){
            newObj = newObj+name+"="+value+"&";
          }
        }
      }
      window.location.href = "?"+newObj;
    }

    $(".longOption,.shortOption, .datepicker").change(function(){
      filter_post();
    })

    $("#searchBtn").click(function(){
      filter_post();
    })


  </script>

@endsection
