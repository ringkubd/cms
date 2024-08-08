@extends('admin.layouts.app')

@section('title', 'Menu alignment settings')

{{-- custom style for this page --}}
@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/plugins/iCheck/all.css") }}">
@endsection


@section('page-title', "")

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Access control</li>
  </ol>
@endsection

{{-- main content section strat  --}}
@section('content')

  <section class="content">

    <form action="{{ url("admin/save-alignment") }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Drag and Drop Menu Alignment</h3>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-sm-3">
                  <h4 class="menuTitle">Main menu</h4>
                  <div class="group-menu">
                    <ul class="todo-list" id="menu1"></ul>
                  </div>
                </div>
                <div class="col-sm-3">
                  <h4 class="menuTitle">Submenu 1 </h4>
                  <div class="group-menu">
                    <ul class="todo-list" id="menu2"></ul>
                  </div>
                </div>
                <div class="col-sm-3">
                  <h4 class="menuTitle">Submenu 2 </h4>
                  <div class="group-menu">
                    <ul class="todo-list" id="menu3"></ul>
                  </div>
                </div>
                <div class="col-sm-3">
                  <h4 class="menuTitle">Submenu 3 </h4>
                  <div class="group-menu">
                    <ul class="todo-list" id="menu4"></ul>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="submit" class="btn btn-green" value="Save Alignment" name="submit"
                           title="Save Alignment">
                    <a href="{{ url('admin/access-control') }}" class="btn btn-danger" title="Reset form">Reset</a>
                  </div>
                </div>
              </div> <!-- /.row -->
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div>
        <!--/.col-md-12 -->
      </div>
      <!--/.row -->
    </form>
  </section>
@endsection


{{-- custom script for this page --}}
@section('custom-script')
  <!-- jquery ui -->
  <script src="{{ asset("assets/bower_components/jquery-ui/jquery-ui.min.js") }}"></script>
  <script>
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
      $("#menu2").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
      $("#menu3").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
      $("#menu4").html('<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>');
    }

    // defauld load

    $(document).ready(function () {
      $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
      });

      // default alignment menu
      const url = '{{ url('find-alignment-menu') }}';
      const menu_id = 0;
      const menu_depth = "menu1";
      const preview = "#menu1";
      find_alignment_menu(url, menu_id, menu_depth, preview);
      overlayIcon();
    });

    // first menu change event
    $(document).on("click", "#menu1 li", function () {
      const url = '{{ url('find-alignment-menu') }}';
      const menu_id = $(this).find("#menuId").val();
      const menu_depth = "menu2";
      const preview = "#menu2";
      find_alignment_menu(url, menu_id, menu_depth, preview);
      singleColor('#menu1 li', this);
    });

    // second menu change event
    $(document).on("click", "#menu2 li", function () {
      const url = '{{ url('find-alignment-menu') }}';
      const menu_id = $(this).find("#menuId").val();
      const menu_depth = "menu3";
      const preview = "#menu3";
      find_alignment_menu(url, menu_id, menu_depth, preview);
      singleColor('#menu2 li', this);
    });

    // third menu change event
    $(document).on("click", "#menu3 li", function () {
      const url = '{{ url('find-alignment-menu') }}';
      const menu_id = $(this).find("#menuId").val();
      const menu_depth = "menu4";
      const preview = "#menu4";
      find_alignment_menu(url, menu_id, menu_depth, preview);
      singleColor('#menu3 li', this);
    });

    function find_alignment_menu(url, menu_id, menu_depth, preview) {
      $(preview).html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: url,
        data: {'menuId': menu_id, 'menuDepth': menu_depth},
        success: function (data) {
          $(preview).html(data);
        },
      });
    }

  </script>
@endsection
