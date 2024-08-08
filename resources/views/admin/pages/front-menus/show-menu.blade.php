@extends('admin.layouts.app')

@section('title', 'Show all menus')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Front-menu</li>
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
          <h3 class="box-title">
            Menu data table
          </h3>
          <a href="{{url("admin/menu/create")}}" class="btn btn-link">Create new</a>
        </div>
        <div class="box-body">
          <div class="col-sm-4">
            <h3 class="box-title">Select menu from here</h3>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsePost"
                      aria-expanded="true" aria-controls="collapsePost">
                      Posts
                    </a>
                  </h4>
                </div>
                <div id="collapsePost" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body module-menu">
                    @foreach ($posts as $key => $post)
                    <div class="selectable-menu">
                      <label class="checkbox-inline">
                        @if($post->post_format !== "individual")
                        @php $post_url = $post->post_type."/".$post->id."/".$post->post_slug; @endphp
                        @endif
                        <input type="checkbox" class="post_menu" onclick="check_uncheck('.post_menu','.all-post')"
                          menu-name="{{$post->post_title}}" menu-class="" menu-title="{{$post->post_title}}"
                          new-window="0" value="{{$post_url}}"> {{$post->post_title}} | <b>{{$post->post_type}}</b>
                      </label>
                    </div>
                    @endforeach
                  </div> <!-- .panel-body -->
                  <div class="panel-footer clearfix">
                    <label class="checkbox-inline float-left">
                      <input type="checkbox" class="all-post" onClick="all_check_uncheck(this.checked, '.post_menu');">
                      Select all
                    </label>
                    <button class="btn btn-link float-right" onClick="menu_added('.post_menu','.all-post')">Add to
                      menu
                    </button>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                      aria-expanded="true" aria-controls="collapseOne">
                      Pages
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body module-menu">
                    @foreach ($pages as $key => $page)
                    <div class="selectable-menu">
                      <label class="checkbox-inline">
                        @if($page->post_format !== "individual")
                        @php
                        $page = isset($page) ? $page : "";
                        $page_url = $page->post_format."/".$page->post_slug;
                        @endphp
                        @else
                        @php $page_url = $page->post_slug; @endphp
                        @endif
                        <input type="checkbox" class="page_menu" onclick="check_uncheck('.page_menu','.all-page')"
                          menu-name="{{$page->post_title}}" menu-class="" menu-title="{{$page->post_title}}"
                          new-window="0" value="{{$page_url}}"> {{$page->post_title}} | <b>{{$page->post_format}}</b>
                      </label>
                    </div>
                    @endforeach
                  </div> <!-- .panel-body -->
                  <div class="panel-footer clearfix">
                    <label class="checkbox-inline float-left">
                      <input type="checkbox" class="all-page" onClick="all_check_uncheck(this.checked, '.page_menu');">
                      Select all
                    </label>
                    <button class="btn btn-link float-right" onClick="menu_added('.page_menu','.all-page')">Add to
                      menu</button>
                  </div> <!-- .panel-footer -->
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                      href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"> Categories
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body module-menu">
                    @foreach ($taxonomies as $key => $taxonomy)
                    <div class="selectable-menu">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="cats_menu" onclick="check_uncheck('.cats_menu','.all-category')"
                          menu-name="{{$taxonomy->name}}" menu-class="" menu-title="{{$taxonomy->name}}" new-window="0"
                          value="{{"?category=".$taxonomy->slug}}"> {{$taxonomy->name }}
                      </label>
                    </div>
                    @endforeach
                  </div> <!-- .panel-body -->
                  <div class="panel-footer clearfix">
                    <label class="checkbox-inline float-left">
                      <input type="checkbox" class="all-category"
                        onClick="all_check_uncheck(this.checked, '.cats_menu');">
                      Select all
                    </label>
                    <button class="btn btn-link float-right" onClick="menu_added('.cats_menu','.all-category')">Add
                      to menu
                    </button>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                      href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Modules
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body module-menu">
                    @foreach ($modules as $key => $module)
                    <div class="selectable-menu">
                      <label class="checkbox-inline">
                        <input type="checkbox" class="module_menu" onclick="check_uncheck('.module_menu','.all-module')"
                          menu-name="{{$module->name }}" menu-class="" menu-title="{{$module->name }}" new-window="0"
                          value="{{$module->slug}}"> {{$module->name }}
                      </label>
                    </div>
                    @endforeach
                  </div> <!-- .panel-body -->
                  <div class="panel-footer clearfix">
                    <label class="checkbox-inline float-left">
                      <input type="checkbox" class="all-module"
                        onClick="all_check_uncheck(this.checked,'.module_menu');">
                      Select all
                    </label>
                    <button class="btn btn-link float-right" onClick="menu_added('.module_menu','.all-module')">Add
                      to menu
                    </button>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                      href="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                      Custom
                    </a>
                  </h4>
                </div>
                <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body custom-menu">
                    <div class="selectable-menu">
                      <div class="form-group">
                        <label for="custom-menu-name">Menu name</label>
                        <input type="text" class="form-control" id="custom-menu-name" placeholder="menu name">
                      </div>
                      <div class="form-group">
                        <label for="custom-menu-url">Menu url</label>
                        <input type="text" class="form-control" id="custom-menu-url" placeholder="menu url">
                      </div>
                    </div>
                  </div>
                  <div class="panel-footer clearfix">
                    <button class="btn btn-link float-right" id="add-custom-menu">Add to menu</button>
                  </div>
                </div>
              </div>
            </div>
          </div> <!-- .col-sm-4 -->
          <div class="col-sm-8">
            <div class="row">
              <div class="form-group col-sm-5 pr-0">
                <label for="email">Menu Group</label>
                <select name="group" class="form-control shortOption" id="group">
                  @forelse($groups as $group)
                  @if(\Illuminate\Support\Facades\Cache::has("group_id"))
                  @php
                  $group = isset($group) ? $group : "";
                  $request_group_id = \Illuminate\Support\Facades\Cache::get("group_id");
                  $selected = $group->id == $request_group_id ? "selected" : "";
                  @endphp
                  @endif
                  <option value="{{$group->id}}" {{$selected ?? ""}}>{{$group->name}}</option>
                  @empty
                  <option value="0">None</option>
                  @endforelse
                </select>
              </div>
              <div class="form-group col-sm-5 pr-0">
                <label for="parent">Parent</label>
                <select name="parent" class="form-control longOption" id="parent">
                  <option value="0">None</option>
                  @foreach($parents as $parent)
                  @if(\Illuminate\Support\Facades\Cache::has("parent_id"))
                  @php
                  $parent = isset($parent) ? $parent : "";
                  $request_parent_id = \Illuminate\Support\Facades\Cache::get("parent_id");
                  $selected = $parent->id == $request_parent_id ? "selected" : "";
                  @endphp
                  @endif
                  <option value="{{$parent->id}}" {{$selected ?? ""}}>{{$parent->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-sm-2">
                <div class="form-group">
                  <p for="check" class="invisible m-0" style="margin-top: 5px !important;">find</p>
                  <button type="button" class="btn btn-success" id="find">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div> <!-- col-sm-2 -->
            </div> <!-- .row -->
            <div class="group-menu">
              <ul class="todo-list" id="menu">
              </ul>
            </div>
            <button class="btn btn-success" id="save-menu">Save menu</button>
            <a href="{{url("admin/menu")}}" id="refresh" class="hide">refresh</a>
          </div> <!-- .col-sm-8 -->
        </div>
        <!-- /.box-body -->
      </div> <!-- /.box -->
    </div>
    <!--/.col-md-7 -->
  </div>
  <!--/.row -->
</section>

<!-- start make menu -->
<ul class="hide make_menu">
  <li class="item clearfix">
    <span class="showName"></span>
    <input type="hidden" class="menu-item" menu-name="" menu-class="" menu-title="" new-window="0" menu-icon="" value=""
      menu-type="internal" menu-id="0">
    <span class="delete pull-right" title="delete"> <i class="fa fa-trash"></i> </span>
    <span class="edit pull-right" title="edit"> <i class="fa fa-pencil"></i> </span>
    <div class="menu-edit-form hide">
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="menu-name">Menu name</label>
          <input type="text" class="menu-name form-control" value="" placeholder="menu name">
        </div>
        <div class="form-group col-sm-6">
          <label for="menu-url">Menu url</label>
          <input type="text" class="menu-url form-control" value="" placeholder="menu url">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="menu-class">Menu class</label>
          <input type="text" class="menu-class form-control" value="" placeholder="menu class">
        </div>
        <div class="form-group col-sm-6">
          <label for="menu-title">Title</label>
          <input type="text" class="menu-title form-control" value="" placeholder="menu title">
        </div>
      </div>
      <div class="row">
        <div class="form-group col-sm-6">
          <label for="menu-icon" class="hidden">new window</label> <br>
          <label class="checkbox-inline">
            <input type="checkbox" class="new-tab" onClick="open_new_tab(this.checked);"> New tab
          </label>
        </div>
        <div class="form-group col-sm-6">
          <label for="menu-icon">Menu Icon</label>
          <input type="text" class="menu-icon form-control" value="" placeholder="menu icon">
        </div>
      </div>
      <div class="form-group">
        <input type="button" class="btnUpdate btn btn-bitbucket btn-sm" value="Update">
      </div>
    </div> <!-- .menu-edit-form -->
  </li>
</ul> <!-- .hide -->
<!-- end make menu -->
@endsection


{{-- custom style for this page --}}
@section('custom-css-file')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

{{-- custom script for this page --}}
@section('custom-script')
<script src="{{asset("assets/js/front-menu-control.js")}}"></script>
<script src="{{ asset("assets/bower_components/jquery-ui/jquery-ui.min.js") }}"></script>
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
  $(document).ready(function () {
    $('.todo-list').sortable({
      placeholder: "ui-state-highlight",
      forcePlaceholderSize: true,
      zIndex: 9999
    }).disableSelection();
    $('.longOption').select2();
    $('.shortOption').select2({
      minimumResultsForSearch: -1
    });
  });

  $(document).on("click", ".new-tab", function () {
    if ($(this).prop("checked")) {
      $(this).val(1);
    } else {
      $(this).val(0);
    }
  });

  function all_check_uncheck(isChecked, cats_menu) {
    if (isChecked) {
      $(cats_menu).each(function () {
        this.checked = true;
      });
    } else {
      $(cats_menu).each(function () {
        this.checked = false;
      });
    }
  }

  function check_uncheck(menuClass, allBtn) {
    const single = $(menuClass + ":checked");
    if (single.length == $(menuClass).length) {
      $(allBtn).prop("checked", true);
    } else {
      $(allBtn).prop("checked", false);
    }
  }

  function menu_added(menuBtn, allBtn) {
    if ($(menuBtn + ":checked").length > 0) {
      $(menuBtn + ':checked').each(function (i, e) {
        const menuName = $(this).attr("menu-name");
        const menuClass = $(this).attr("menu-class");
        const menuTitle = $(this).attr("menu-title");
        const menuUrl = $(this).val();
        const newWindow = $(this).attr("new-window");
        const menuIcon = "";

        const makeMenu = $(".make_menu");
        makeMenu.find(".showName").html(menuName);
        makeMenu.find(".menu-item").attr("menu-name", menuName).attr("menu-class", menuClass).attr("menu-title",
          menuTitle).val(menuUrl);
        makeMenu.find(".menu-name").attr("value", menuName);
        makeMenu.find(".menu-url").attr("value", menuUrl);
        makeMenu.find(".menu-class").attr("value", menuClass);
        makeMenu.find(".menu-title").attr("value", menuTitle);
        makeMenu.find(".menu-icon").attr("value", menuIcon);
        // makeMenu.attr("menu-type", "internal");

        if (newWindow) {
          makeMenu.find(".menu-item").attr("new-window", newWindow);
        }
        const item = makeMenu.html();
        $("#menu").append(item);
      });
      $(menuBtn).prop("checked", false);
      $(allBtn).prop("checked", false);
    } else {
      alert("Check minimum one Item !");
    }
  }

</script>
@endsection
