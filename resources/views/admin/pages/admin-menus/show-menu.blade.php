@extends('admin.layouts.app')

@section('title', 'Show all admin menus')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Admin Menu</li>
</ol>
@stop


@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- Form Element sizes -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="headerbox-navigation" style="margin-bottom: 10px;">
            <h3 class="box-title">All Amin Menus</h3>
            <a href="/admin/admin-menu/create">Create new</a>
          </div>
          <form class="form-inline custom-post-search" action="#" method="get">
            <div class="form-group text-right">
              <label for="search" class="sr-only">Search</label>
              <input type="search" name="search" class="form-control" value="{{request('search')}}" id="search"
                placeholder="search">
            </div>
          </form>
        </div> <!-- .box-header -->
        <div class="box-body" id="post-container">
          @include('admin.pages.admin-menus.admin-menu-table')
        </div> <!-- .box-body -->
      </div> <!-- .box -->
    </div> <!-- .col-md-7 -->
  </div> <!-- .row -->
</section>
@stop




@section('custom-script')
<script>
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
    myurl = 'admin-menu?' + newObj;
    window.history.pushState("Details", "Title", myurl);
    getData(myurl);
  }


  $("#search").keyup(function () {
    filter_post();
  });




  $(document).on('click', '.pagination a', function (event) {
    event.preventDefault();
    $('.pagination').find('li').removeClass('active');
    $(this).parent('li').addClass('active');
    const myurl = $(this).attr('href');
    const page = $(this).attr('href').split('page=')[1];
    getData(myurl, page);
  }); // end ajax pagination

  function getData(url, page = 0) {
  $.ajax({
    url: url,
    type: 'get',
    datatype: 'html'
  }).done(function (data) {
    $('#post-container').empty().html(data);
    if(page){
      location.hash = page
    }
  }).fail(function (jqXHR, ajaxOptions, thrownError) {
    alert('No response from server');
  });
}

</script>
@stop
