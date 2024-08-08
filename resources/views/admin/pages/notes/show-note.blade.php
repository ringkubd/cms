@extends('admin.layouts.app')

@inject('carbon', 'Carbon\Carbon')

@section('title', 'Your Notes')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Note</li>
  </ol>
@stop

{{-- custom style for this page --}}
@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset('assets/plugins/iCheck/all.css') }}">
@stop

{{-- main content start from here --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <div class="headerbox-navigation" style="margin-bottom: 10px;">
              <h3 class="box-title">All Posts</h3>
              <a role="button" data-toggle="collapse" href="#filter" aria-expanded="false" aria-controls="filter">
                <i class="fa fa-filter"></i> Filter
              </a>
              <a href="{{url('admin/note/create')}}">New Note</a>
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
          <div class="box-body no-padding collapse" id="filter">
            <table class="no-border table">
              <tr>
                <td>
                  <select name="round" class="form-control longOption">
                    <option value="1">Round 1</option>
                  </select>
                </td>
                <td>
                  <select name="round" class="form-control longOption">
                    <option value="1">Round 1</option>
                  </select>
                </td>
                <td>
                  <select name="round" class="form-control longOption">
                    <option value="1">Round 1</option>
                  </select>
                </td>
                <td>
                  <select name="round" class="form-control longOption">
                    <option value="1">Round 1</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="box-body no-padding" id="post-container">
            @include('admin.pages.notes.note-table')
          </div> <!-- /.box-body -->
          <div class="modal fade" id="modal-quick-edit" style="display: none;">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Quick Edit</h4>
                </div>
                <div class="modal-body">
                  <form action="" method="post" id="quick-edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="note_title">Note Title</label>
                      <input type="text" name="note_title" id="note_title" class="form-control" value="">
                    </div>
                    <div class="form-group">
                      <label class="radio-inline">
                        <input type="radio" name="note_status" value="publish" class="checking"> Publish
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="note_status" value="draft" class="checking"> Draft
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="note_status" value="schedule" class="checking">Schedule
                      </label>
                    </div>
                    <div class="form-group">
                      <label for="created_at">Note Date</label>
                      <input type="text" name="created_at" id="created_at" class="form-control scheduleTime" value="">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                  </form>
                </div>
              </div> <!-- /.modal-content -->
            </div> <!-- /.modal-dialog -->
          </div>
        </div> <!--  .box -->
      </div> <!-- .col-md-7 -->
    </div> <!-- .row -->
  </section>
@stop

@section("custom-style")
  <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@stop

@section('custom-script')
  <script src="{{ asset("assets/bower_components/moment/min/moment.min.js")}}"></script>
  <script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <script>
    function icheck_check_box() {
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
      icheck_iuncheck("input#checkall", "input.single-check");
    }

    $(document).on('click', '.quick-edit', function (event) {
      event.preventDefault();
      const modal = $('#modal-quick-edit');
      const QuickForm = $('#quick-edit-form');
      QuickForm.attr('action', '/admin/note/' + $(this).attr('data-id') + '/quick-edit');
      QuickForm.find('#note_title').val($(this).attr('data-title'));
      QuickForm.find('input[value="' + $(this).attr('data-status') + '"]').attr('checked', true);
      QuickForm.find('#created_at').val($(this).attr('data-create'));
      modal.modal('show');
    });


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
      const myUrl = "admin/type?" + newObj;
      window.history.pushState("Details", "Title", myUrl);
      getData(myurl);
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

    function getData(url, page = 0) {
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

@stop
