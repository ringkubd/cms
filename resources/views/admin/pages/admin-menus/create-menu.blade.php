@extends('admin.layouts.app')

@section('title', 'Register new admin menu')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Admin menu</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')
<section class="content">
  <div class="row">
    <div class="col-sm-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Create admin menu</h3>
          <a href="{{url("admin/admin-menu")}}" class="btn-link">Show all</a>
        </div>
        <div class="box-body">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              @php
              $tab = \Illuminate\Support\Facades\Cache::get("menu_tab");
              $common = ($tab !== "routeMenu" && $tab !== "resourceMenu") ? "active" : "";
              $routeMenu = $tab == "routeMenu" ? "active" : $common;
              $resourceMenuu = $tab == "resourceMenu" ? "active" : "";
              @endphp
              <li class="{{$routeMenu}}">
                <a href="#tab_1" data-toggle="tab" aria-expanded="true">Route menu</a>
              </li>
              <li class="{{$resourceMenuu}}">
                <a href="#tab_2" data-toggle="tab">Resource Menu</a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane {{$routeMenu}}" id="tab_1">
                <div class="row">
                  <div class="col-sm-8">
                    <form action="{{ url("admin/admin-menu") }}" method="POST">
                      @csrf
                      <div class="box-body">
                        <div class="row">
                          <div class="form-group col-sm-12">
                            <label class="checkbox-inline">
                              <input type="checkbox" name="active" value="1" checked>
                              Active
                            </label>
                            <label class="checkbox-inline">
                              <input type="checkbox" name="visibility" value="1" checked>
                              Visible
                            </label>
                          </div>
                        </div> <!-- /.row -->
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="name">Menu name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                              placeholder="Menu name" autofocus>
                            @error('name')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="icon">Menu Icon (Font awesome)</label>
                            <input type="text" name="icon" value="{{old('icon')}}" class="form-control" id="icon"
                              placeholder="fa-icon">
                            @error('icon')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <!--/.row -->
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="route_uri">Route URI</label>
                            <input type="text" name="route_uri" value="{{old('route_uri')}}" class="form-control"
                              id="route_uri" placeholder="Route URI">
                            @error('route_uri')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="method">Route Method</label>
                            <select name="route_method" id="method" class="form-control shortoption">
                              <option value="GET">GET</option>
                              <option value="POST">POST</option>
                              <option value="PUT">UPDATE</option>
                              <option value="DELETE">DELETE</option>
                            </select>
                            @error('method')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <!--/.row -->
                        <div class="row">
                          <div class="form-group col-sm-12">
                            <label for="parent_id">Menu parent</label>
                            <select name="parent_id" id="parent_id" class="form-control longOption">
                              <option value="0">none</option>
                              @foreach ($parents as $item)
                              @php
                              $item = isset($item) ? $item : "";
                              $selected = old("parent") == $item->id ? "selected" : "";
                              @endphp
                              <option value="{{$item->id}}" {{$selected}}>
                                {{"$item->id. $item->name"}}</option>
                              @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <!--/.row -->
                        <div class="row">
                          <div class="form-group col-sm-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" maxlength="400" class="form-control"
                              placeholder="Menu description">{{old('description')}}</textarea>
                            @error('description')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-12">
                            <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
                            <a href="{{ url('admin-menu/create') }}" class="btn btn-danger" title="Reset form">Reset</a>
                          </div>
                        </div> <!-- /.row -->
                      </div> <!-- /.box-body -->
                    </form>
                  </div>
                  <!--/.col-md-8 -->
                  <div class="col-sm-4">
                    <h3 class="box-title">Help</h3>
                    <div class="box-body">
                      <strong><i class="fa fa-book margin-r-5"></i> Menu name</strong>
                      <p class="text-muted">
                        Menu name is the visible name of the menu. we can modify Menu name
                        in anytime. Menu name
                        must be a relevend name.
                      </p>
                      <hr>
                      <strong><i class="fa fa-book margin-r-5"></i> Menu name
                        (Bangla)</strong>
                      <p class="text-muted">
                        Menu name (Bangla) is optional. It is helpfull for Bangla language
                        settings.
                      </p>
                      <hr>
                      <strong><i class="fa fa-book margin-r-5"></i> Route URL</strong>
                      <p class="text-muted">
                        Route URL Laravel Routing URL. You can set only the name of the
                        Route URL. Example <b>something/{id}/edit</b>
                      </p>
                      <hr>
                      <strong><i class="fa fa-book margin-r-5"></i> Route Action</strong>
                      <p class="text-muted">
                        Route Action is the Laravel Route Action. You can set Route action
                        controller. Example
                        <b>Controller@method</b>
                      </p>
                      <hr>
                    </div> <!-- /.box-body -->
                  </div>
                  <!--/.col-md-4 -->
                </div> <!-- /.row -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane {{$resourceMenuu}}" id="tab_2">
                <div class="row">
                  <div class="col-sm-8">
                    <form action="{{ url("admin/save-resource-menu") }}" method="POST">
                      @csrf
                      <div class="box-body">
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="name">Menu Display name</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                              placeholder="Menu Display Name">
                            @error('name')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="icon">Parent Icon (Font awesome)</label>
                            <input type="text" name="icon" value="{{old('icon')}}" class="form-control" id="icon"
                              placeholder="Parent Icon">
                            @error('icon')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <!--/.row -->
                        <div class="row">
                          <div class="form-group col-sm-6">
                            <label for="group">Menu Route Name</label>
                            <input type="text" name="group" value="{{old('group')}}" class="form-control" id="group"
                              placeholder="Menu Route Name">
                            @error('group')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-6">
                            <label for="parent_id">Menu parent</label>
                            <select name="parent_id" id="parent_id" class="form-control longOption">
                              <option value="0">none</option>
                              @foreach ($parents as $parent)
                              @php
                              $selected = old("parent_id") == $parent->id ? "selected" :
                              "";
                              @endphp
                              <option value="{{$parent->id}}" {{$selected}}>
                                {{"$parent->id. $parent->name"}}</option>
                              @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                        </div>
                        <!--/.row -->
                        <div class="row">
                          <div class="form-group col-sm-12">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" rows="3" maxlength="400" class="form-control"
                              placeholder="Menu description">{{old('description')}}</textarea>
                            @error('description')
                            <p class="text-danger margin-bottom-none">{{ $message }}</p>
                            @enderror
                          </div>
                          <div class="form-group col-sm-12">
                            <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
                            <a href="{{ url('admin-menu/create') }}" class="btn btn-danger" title="Reset form">Reset</a>
                          </div>
                        </div> <!-- /.row -->
                      </div> <!-- /.box-body -->
                    </form>
                  </div>
                  <!--/.col-md-8 -->
                  <div class="col-sm-4">
                    <h3 class="box-title">Help</h3>
                    <div class="box-body">
                      <strong><i class="fa fa-book margin-r-5"></i> Menu Resource name</strong>
                      <p class="text-muted">
                        Menu Resource name is the name of prefix that are controll all url with
                        this prefix.
                      </p>
                      <hr>
                      <strong><i class="fa fa-book margin-r-5"></i> Menu Group Name</strong>
                      <p class="text-muted">
                        Optional. if we want a parent name of this resource menu, then we set
                        this Menu Group Name.
                      </p>
                      <hr>
                      <strong><i class="fa fa-book margin-r-5"></i> Menu parent</strong>
                      <p class="text-muted">
                        Optional. If this rourse menu has a parent, you can set the parent of
                        this option.
                      </p>
                      <hr>
                    </div> <!-- /.box-body -->
                  </div>
                  <!--/.col-md-4 -->
                </div> <!-- /.row -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
        </div>
      </div>
    </div>
    <!--/.col-md-12 -->
  </div>

</section>
@endsection
