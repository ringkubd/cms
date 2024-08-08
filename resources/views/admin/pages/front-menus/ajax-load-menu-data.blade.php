@forelse ($menus as $menu)
@php
$menu = isset($menu) ? $menu : "";
$data = json_decode($menu->options);
$class = $data->menu_class;
$title = $data->menu_title;
$window = $data->menu_window;
$icon = $data->menu_icon;
@endphp
<li class="item clearfix">
  <span class="showName">{{$menu->name}}</span>
  <input type="hidden" class="menu-item" menu-name="{{$menu->name}}" menu-class="{{$class}}" menu-title="{{$title}}"
    new-window="{{$window}}" menu-icon="{{$icon}}" value="{{$menu->url}}" menu-type="{{$menu->menu_type}}"
    menu-id="{{$menu->id}}">
  <span class="delete pull-right" title="delete"> <i class="fa fa-trash"></i> </span>
  <span class="edit pull-right" title="edit"> <i class="fa fa-pencil"></i> </span>
  <div class="menu-edit-form hide">
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="menu-name">Menu name</label>
        <input type="text" class="menu-name form-control" value="{{$menu->name}}" placeholder="menu name">
      </div>
      <div class="form-group col-sm-6">
        <label for="menu-url">Menu url</label>
        <input type="text" class="menu-url form-control" value="{{$menu->url}}" placeholder="menu url">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="menu-class">Menu class</label>
        <input type="text" class="menu-class form-control" value="{{$class}}" placeholder="menu class">
      </div>
      <div class="form-group col-sm-6">
        <label for="menu-title">Title</label>
        <input type="text" class="menu-title form-control" value="{{$title}}" placeholder="menu title">
      </div>
    </div>
    <div class="row">
      <div class="form-group col-sm-6">
        <label for="menu-icon" class="hidden">new window</label> <br>
        <label class="checkbox-inline">
          @php
          $window = isset($window) ? $window : "";
          $checked = $window == 1 ? "checked" : "";
          @endphp
          <input type="checkbox" class="new-tab" {{$checked}}> New tab
        </label>
      </div>
      <div class="form-group col-sm-6">
        <label for="menu-icon">Menu Icon</label>
        <input type="text" class="menu-icon form-control" value="{{$icon}}" placeholder="menu icon">
      </div>
    </div>
    <div class="form-group">
      <input type="button" class="btnUpdate btn btn-bitbucket btn-sm" value="Update">
    </div>
  </div> <!-- .menu-edit-form -->
</li>
@empty
@endforelse