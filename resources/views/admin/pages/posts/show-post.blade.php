@extends('admin.layouts.app')


@inject('carbon', 'Carbon\Carbon')

@section('title', "{$module->name} all Posts")
@section('page-title', $module->name)

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">{{"{$module->name} Posts"}}</li>
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
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="headerbox-navigation" style="margin-bottom: 10px;">
              <h3 class="box-title">All Posts</h3>
              <a role="button" data-toggle="collapse" href="#filter" aria-controls="filter">
                <i class="fa fa-filter"></i> Filter
              </a>
              <a href="{{url("admin/type/{$module->slug}")}}">
                <i class="fa fa-refresh"></i> Filter Clear
              </a>
              <a href="{{url("admin/type/{$module->slug}/create")}}">
                <i class="fa fa-plus"></i> Add new
              </a>
            </div>
            <form class="form-inline custom-post-search" action="#" method="get">
              <div class="form-group text-right">
                <label for="search" class="sr-only">Search</label>
                <input type="search" name="search" class="form-control" value="{{request('search')}}" id="search"
                       placeholder="search">
              </div>
              <button type="button" class="btn btn-default" id="searchBtn">Search</button>
            </form>
          </div> <!-- .box-header -->
          <div class="box-body" style="padding: 0 15px">
            <div class="collapse @if(request()->has(" category")) in @endif" id="filter">
              <form action="#" method="get" class="post-filter">
                <div class="row">
                  <div class="form-group col-sm-2 pr-0 margin-bottom-none">
                    <select name="category" class="form-control form-control-sm longOption">
                      <option value="">All Category</option>
                      @foreach($moduleCats as $cat)
                        <option value="{{$cat->slug}}" @if(request()->input("category") == $cat->slug) selected
                          @endif>{{$cat->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-sm-2 pr-0 margin-bottom-none">
                    <select name="author" class="form-control form-control-sm shortOption">
                      <option value="">All Author</option>
                      @foreach($authors as $author)
                        <option value="{{$author->id}}" @if(request()->input("author") == $author->id) selected
                          @endif>{{"{$author->firstName} {$author->LastName}"}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-sm-2 pr-0 margin-bottom-none">
                    <select name="status" class="form-control form-control-sm shortOption">
                      <option value="">All Status</option>
                      <option value="publish" @if(request()->input("status") == "publish") selected @endif>Publish
                      </option>
                      <option value="draft" @if(request()->input("status") == "draft") selected @endif>Draft</option>
                      <option value="schedule" @if(request()->input("status") == "schedule") selected @endif>Schedule
                      </option>
                    </select>
                  </div>
                  <div class="form-group col-sm-4 pr-0 margin-bottom-none">
                    <div class="input-group text-center">
                      <input type="text" class="form-control datepicker" name="start" value="{{request('start')}}"
                             placeholder="{{$carbon->now()->subDays(30)->format("d-m-Y")}}" autocomplete="off"/>
                      <span class="input-group-addon mx-2"> to </span>
                      <input type="text" class="form-control datepicker" name="end"
                             value="{{request('end') ?? $carbon->now()->format("d-m-Y") }}" autocomplete="off"/>
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
          <div class="box-body no-padding" id="post-container">
            @include('admin.pages.posts.post-table')
          </div> <!-- /.box-body -->
        </div> <!--  .box -->
      </div> <!-- .col-md-7 -->
    </div> <!-- .row -->
  </section>
@endsection

@section("custom-style")
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

@section('custom-script')
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    function icheck_check_box() {
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
      // check uncheck all
      icheck_iuncheck("input#checkall", "input.single-check");
    }

    $(function () {
      icheck_check_box(); // initialization on load

      $('.scheduleTime').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        forceParse: false,
        daysOfWeekHighlighted: "0",
        todayHighlight: true,
      });


      //Date range picker
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
      const answer = confirm("Do you want to delete !");
      if (answer === true) {
        $("#" + id).submit();
      }
    }

    function getUrlVars() {
      let queryStr = window.location.search,
        queryArr = queryStr.replace('?', '').split('&'),
        queryParams = [];
      for (let q = 0, qArrLength = queryArr.length; q < qArrLength; q++) {
        let qArr = queryArr[q].split('=');
        queryParams[qArr[0]] = qArr[1];
      }
      return queryParams;
    }

    function filter_post() {
      let queryString = getUrlVars();
      let searchTxt = $(".custom-post-search").serializeArray();
      let filter = $(".post-filter").serializeArray();
      let newArray = searchTxt.concat(filter, queryString);
      let newObj = "";
      for (let i = 0; i <= newArray.length; i++) {
        if (typeof newArray[i] !== "undefined") {
          const name = newArray[i].name;
          const value = newArray[i].value;
          if (value !== "") {
            newObj = newObj + name + "=" + value + "&";
          }
        }
      }
      const myUrl = "{{$module->slug}}?" + newObj;
      window.history.pushState("Details", "Title", myUrl);
      getData(myUrl);
    }

    $(".longOption,.shortOption, .datepicker").change(function () {
      filter_post();
    });

    $("#searchBtn").click(function () {
      filter_post();
    });


    $(document).on('click', '.pagination a', function (event) {
      event.preventDefault();
      $('.pagination').find('li').removeClass('active');
      $(this).parent('li').addClass('active');
      const myUrl = $(this).attr('href');
      const page = $(this).attr('href').split('page=')[1];
      getData(myUrl, page);
    }); // end ajax pagination

    function getData(url, page = '') {
      $.ajax({
        url: url,
        type: 'get',
        datatype: 'html'
      }).done(function (data) {
        $('#post-container').empty().html(data);
        if (page) {
          location.hash = page
        }
        icheck_check_box(); // initialization on load
      }).fail(function (jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
      });
    }

  </script>

@endsection
