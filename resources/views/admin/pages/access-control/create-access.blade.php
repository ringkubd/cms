@extends('admin.layouts.app')

@section('title', 'User role permission settings')

{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
<link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Access control</li>
</ol>
@stop

@section('content')
<div class="alert alert-success custom-alert alert-dismissible hide">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  <span class="text"></span>
</div>
<div class="alert alert-danger custom-alert alert-dismissible hide">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-check"></i> Alert!</h4>
  <span class="text"></span>
</div>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Menu permission by Role</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class="form-group col-sm-3">
              <label for="roleId">Select user role</label>
              <select name="roleId" id="roleId" class="form-control shortOption">
                @forelse ($roles as $role)
                <option value="{{$role->id}}">{{$role->name}}</option>
                @empty
                <option value="">none</option>
                @endforelse
              </select>
              @error('roleId')
              <p class="text-danger m-0">{{ $message }}</p>
              @enderror
            </div>
          </div> <!-- /.row -->
          <div class="row">
            <div class="col-sm-3">
              <h4 class="menuTitle">Main menu <span class="pull-right">
                  <input type="checkbox" id="allactive" class="flat-red" value="1"></span></h4>
              <div class="group-menu">
                <ul class="todo-list" id="menu1"></ul>
              </div>
            </div>
            <div class="col-sm-3">
              <h4 class="menuTitle">Submenu 1 <span class="pull-right">
                  <input type="checkbox" id="allactive" class="flat-red"></span></h4>
              <div class="group-menu">
                <ul class="todo-list" id="menu2">
                  <div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>
                </ul>
              </div>
            </div>
            <div class="col-sm-3">
              <h4 class="menuTitle">Submenu 2 <span class="pull-right">
                  <input type="checkbox" id="allactive" class="flat-red"></span></h4>
              <div class="group-menu">
                <ul class="todo-list" id="menu3"></ul>
              </div>
            </div>
            <div class="col-sm-3">
              <h4 class="menuTitle">Submenu 3 <span class="pull-right">
                  <input type="checkbox" id="allactive" class="flat-red"></span></h4>
              <div class="group-menu">
                <ul class="todo-list" id="menu4"></ul>
              </div>
            </div>
          </div> <!-- /.row -->
        </div> <!-- /.box-body -->
      </div> <!-- /.box -->
    </div> <!-- .col-md-12 -->

  </div> <!-- .row -->

</section>
@stop


@section('custom-script')
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="{{ asset("assets/plugins/iCheck/icheck.min.js") }}"></script>
<script>
  // default load ajax event
    $(document).ready(function () {
      const role_id = $("#roleId").val();
      const menu_id = 0;
      const url = '{{ url("find-admin-menu")}}';
      overlayIcon();
      find_menu_by_ajax(role_id, menu_id, "#menu1", url);
    });

    $(document).on("ifChecked ifUnchecked", "input.flat-red", function () {
      const checkall = $(this).closest(".menuTitle").find("input.flat-red");
      const singlecheck = $(this).closest(".menuTitle").siblings().find(".todo-list input.flat-red");
      // check uncheck all
      icheck_iuncheck(checkall, singlecheck, true);
    });

    // role change ajax event
    $(document).on('change', '#roleId', function () {
      const role_id = $(this).val();
      const menu_id = 0;
      const url = '/find-admin-menu';
      overlayIcon();
      find_menu_by_ajax(role_id, menu_id, "#menu1", url);
    });

    // first menu change event
    $(document).on("click", "#menu1 li", function () {
      const menu_id = $(this).find("#menuId").val();
      const role_id = $("#roleId").val();
      const url = '{{ url("find-admin-menu")}}';
      singleColor('#menu1 li', this);
      find_menu_by_ajax(role_id, menu_id, "#menu2", url);
    });

    // second menu change event
    $(document).on("click", "#menu2 li", function () {
      const menu_id = $(this).find("#menuId").val();
      const role_id = $("#roleId").val();
      const url = '{{ url("find-admin-menu")}}';
      singleColor('#menu2 li', this);
      find_menu_by_ajax(role_id, menu_id, "#menu3", url);
    });

    // third menu change event
    $(document).on("click", "#menu3 li", function () {
      const menu_id = $(this).find("#menuId").val();
      const role_id = $("#roleId").val();
      const url = '{{ url("find-admin-menu")}}';
      singleColor('#menu3 li', this);
      find_menu_by_ajax(role_id, menu_id, "#menu4", url);
    });

    function minimalLoad() {
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
      });
    }


    $(document).on('ifChecked ifUnchecked', 'input[type="checkbox"].flat-red', function (event) {
      let menuId = event.target.value;
      let active = event.target.checked === true ? 1 : 0;
      let roleId = $("#roleId").val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: "/admin/setup-access",
        data: {
          'active': active,
          'menuId': menuId,
          'roleId': roleId
        },
        success: function (data) {
          let success = $(".alert.alert-success");
          success.css({
            'display': 'block'
          });
          success.removeClass('hide');
          success.find(".text").text(data);
        },
        error: function (data) {
          let success = $(".alert.alert-danger");
          success.css({
            'display': 'block'
          });
          success.removeClass('hide');
          success.find(".text").text(data);
        },
      });
    });

    // single menu background menu color
    function singleColor(depth, color) {
      $(depth).css({'background': '', 'color': '#454545', 'border': '1px solid #c5c5c5'});
      $(color).css({
        'background': '#E0FFE6',
        'color': '#222',
        'border': '1px solid transparent'
      });
    }

    // menu overlay
    function overlayIcon() {
      $("#menu1").html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      $("#menu2").html('<div class="overlay"><i class="fa fa-info-circle"></i></div>');
      $("#menu3").html('<div class="overlay"><i class="fa fa-info-circle"></i></div>');
      $("#menu4").html('<div class="overlay"><i class="fa fa-info-circle"></i></div>');
    }


    // comon function for find menu by ajax
    function find_menu_by_ajax(role_id, menu_id, preview, url) {
      $(preview).html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: url,
        data: {'menuId': menu_id, 'roleId': role_id},
        success: function (data) {
          $(preview).html(data);
          minimalLoad();
        },
      });
    }

    $(function () {
      $('.longOption').select2();
      $('.shortOption').select2({
        minimumResultsForSearch: -1
      });
      // default checkbox load functions
      minimalLoad();
    });
</script>
@endsection