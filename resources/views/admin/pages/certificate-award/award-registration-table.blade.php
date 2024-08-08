@extends('admin.layouts.app')

@section('title', 'Registration Info Table for Certificate Awarding Ceremony')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Registration Info Table</li>
</ol>
@stop

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="headerbox-navigation" style="margin-bottom: 10px;">
            <h3 class="box-title">Registration Info Table</h3>
            <a role="button" data-toggle="collapse" href="#filter-form" aria-expanded="false"
              aria-controls="filter-form">
              <i class="fa fa-filter"></i> Filter
            </a>
            <a href="/admin/certificate-award">
              <i class="fa fa-refresh"></i> Clear Filter
            </a>
          </div>
          <div style="  display: inline; float: right;">
            Last Round: <b>{{$lastRound->round}}</b>, Total Applicant: <b>{{$totalApplicant}}</b>
          </div>
        </div> <!-- .box-header -->
        <div class="box-body no-padding collapse" id="filter-form">
          <form class="post-filter">
            <div class="form-group col-sm-4 pr-0 margin-bottom-none">
              <label for="round" class="sr-only"></label>
              <select name="round" id="round" class="form-control longOption margin-bottom-none">
                <option value="">Select Round</option>
                @foreach($rounds as $round)
                <option value="{{$round->round}}">{{$round->round}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-4 pr-0 margin-bottom-none">
              <label for="course" class="sr-only"></label>
              <select name="course" id="course" class="form-control shortOption margin-bottom-none">
                <option value="">Select Course</option>
                @foreach($courses as $course)
                <option value="{{$course->course}}">{{$course->course}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group col-sm-4 margin-bottom-none">
              <label for="order" class="sr-only"></label>
              <select name="order" id="order" class="form-control shortOption margin-bottom-none">
                <option value="desc">Descending</option>
                <option value="asc">Ascending</option>
              </select>
            </div>
          </form>
        </div>
        <div class="box-body" id="post-container">
          @include('admin.pages.certificate-award.info-table')
        </div> <!-- .box-body -->

        <div class="modal fade" id="details">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Students Details</h4>
              </div>
              <div class="modal-body" id="student-details"></div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div>
      </div> <!-- .box -->
    </div> <!-- .col-md-7 -->
  </div> <!-- .row -->
</section>


@stop


@section('custom-script')
<script>
  $(document).on('click', '.details', function (event) {
    event.preventDefault();
    $.ajax({
      url: $(this).attr('href'),
      type: 'GET',
      datatype: 'html'
    }).done(function (data) {
      $('#student-details').empty().html(data);
      $('#details').modal('show');
    }).fail(function (jqXHR, ajaxOptions, thrownError) {
      $('#student-details').empty().html('500 error! No Data Found');
      $('#details').modal('show');
    });
  });


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
        if (typeof newArray[i] !== 'undefined') {
          const name = newArray[i].name;
          const value = newArray[i].value;
          if (value !== "") {
            newObj = newObj + name + "=" + value + "&";
          }
        }
      }
      const myUrl = 'certificate-award?' + newObj;
      window.history.pushState("Details", "title", myUrl);
      return myUrl;
    }

    $(".longOption,.shortOption, .datepicker").change(function () {
      const dataUrl = filter_post();      
      getData(dataUrl);
    });

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
      }).fail(function (jqXHR, ajaxOptions, thrownError) {
        alert('No response from server');
      });
    }
</script>
@stop