@extends('admin.layouts.app')

@section('title', 'Manage Taxonomy')

@inject('admin', 'App\Admin')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomies</li>
  </ol>
@endsection

@php
  $module_slug = request()->segment(3);
  $uriCollection = request()->segments();
  $module = $admin->get_module_by_slug($module_slug);
  if($module){
    $module_slug = $module->slug;
    $term = request()->segment(4);
  }else{
    $module_slug = null;
    $term = request()->segment(3);
  }
  $action = 'admin/term/taxonomy';
  if(isset($edit)){
    $action = 'admin/term/taxonomy/'.$taxonomy->id;
  }
  $taxonomyData = $admin->get_taxonomy_parent($term, $module_slug);
@endphp

{{-- main content section strat  --}}
@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-4 pr-0">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <form action="{{url($action)}}" method="POST">
            @csrf
            @isset($edit)
              @method("PUT")
            @endisset

            @if ($module)
              <input type="hidden" name="module" value="{{$module->slug}}">
            @endif
            <div class="box-header with-border">
              <h3 class="box-title">
                {{ isset($edit) ? "Edit" : "Create new"}}
                {{ucfirst($term)}}
              </h3>
              @isset($edit)
                <a href="{{ url("term/".$module."/".$term) }}" class="nav-link pull-right"> Add
                  new {{ucfirst($term)}}</a>
              @endisset
            </div>
            <input type="hidden" name="term" value="{{$term}}">
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline">
                    @if (isset($edit))
                      <input type="checkbox" name="active" value="1" @if($taxonomy->active == 1) checked @endif> Active
                    @else
                      <input type="checkbox" name="active" value="1" checked> Active
                    @endif
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{ $taxonomy->name ?? old('name')  }}"
                           class="form-control" id="name" placeholder="{{$taxonomy->name ?? $term }}">
                    @error('name')
                    <p class="text-danger margin-bottom-none">{{ $message }}</p>
                    @enderror
                  </div>
                  @if ($term !== "tags" && $term !== "tag")
                    <div class="form-group">
                      <label for="parent_id">Parent</label>
                      <select name="parent_id" class="form-control shortoption" id="parent_id">
                        <option value="">None</option>
                        @foreach ($admin->get_taxonomy_parent($term, $module_slug) as $item)
                          @if(isset($edit))
                            @if($taxonomy->id !== $item->id)
                              <option value="{{$item->id}}"
                                      @if($taxonomy->parent_id == $item->id) selected @endif>{{$item->name}}</option>
                            @endif
                          @else
                            <option value="{{$item->id}}"
                                    @if(old('parent_id') == $item->id) selected @endif>{{$item->name}}</option>
                          @endif
                        @endforeach
                      </select>
                      @error('parent_id')
                      <p class="text-danger margin-bottom-none">{{ $message }}</p>
                      @enderror
                    </div>
                  @endif
                </div>
                <div class="col-sm-4">
                  <div class="form-group ">
                    <label for="customFile" id="customFile" data-input="thumbnail" data-preview="holder"
                           title="Select Image">
                      <img src="{{asset($taxonomy->picture ?? 'img/no-image.png')}}" title="Upload picture"
                           id="holder" class="img-responsive user-picture">
                    </label>
                    <input type="text" name="picture" class="form-control hidden" id="thumbnail">
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="3" maxlength="400" class="form-control"
                              placeholder="description">{{ $taxonomy->description ?? old('description') }}</textarea>
                    @error('description')
                    <p class="text-danger margin-bottom-none">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div> <!-- /.row -->

              <div class="form-group">
                @if (isset($edit))
                  <input type="submit" class="btn btn-green" value="Update" title="Update">
                  <a href="{{ url("admin/term/".$term."/{$taxonomy->id}"."/edit") }}" class="btn btn-danger">Reset</a>
                @else
                  <input type="submit" class="btn btn-green" value="Create" title="submit">
                  <a href="{{ url("admin/term/".$term) }}" class="btn btn-danger">Reset</a>
                @endif
              </div>
            </div> <!-- /.box-body -->
          </form>
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-5 -->

      <div class="col-sm-8">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">{{ ucfirst($term)}} Data Table</h3>
          </div>
          <div class="box-body no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Module</th>
                <th class="text-center">#</th>
              </tr>
              @forelse ($taxonomyData as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->slug}}</td>
                  <td>{{word_limiter($item->description, 4)}}</td>
                  <td>{{$item->ParentMenu->name ?? 'none'}}</td>
                  <td>
                    @if($item->active)
                      <span class="label label-success" title="Active"><i class="fa fa-eye"></i></span>
                    @else
                      <span class="label label-danger" title="Inactive"><i class="fa fa-eye"></i></span>
                    @endif
                  </td>
                  <td>{{$item->module ? $item->module : 'All Module'}}</td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button class="btn btn-sm btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                              data-toggle="dropdown">
                        <span class="glyphicon glyphicon-option-vertical"></span>
                      </button>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenu1"
                          style="right: 0; left: auto; min-width: 80px">
                        <li>
                          @if ($module_slug)
                            <a href="{{ url("admin/term/{$module_slug}/{$term}/{$item->id}/edit")}}">Edit</a>
                          @else
                            <a href="{{ url("admin/term/{$term}/{$item->id}/edit")}}">Edit</a>
                          @endif
                        </li>
                        <li>
                          <a href="javascript:" class="text-red" onclick="delete_with_confirm('{{$item->id}}')">Delete</a>
                        </li>
                        <form id="{{$item->id}}" action="{{ url("admin/term/taxonomy/{$item->id}") }}" method="POST"
                              class="hide">
                          @csrf
                          @method('delete')
                        </form>
                      </ul>
                    </div>
                  </td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="8">No data</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- /.box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $taxonomyData->links() }}
            </div>
          </div> <!-- .box box-footer -->
        </div> <!-- .box -->
      </div> <!-- .col-md-5 -->
    </div> <!-- .row -->
  </section>
@endsection

@section('custom-css-file')
  <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

@section('custom-script')
  <script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
  <script src="{{ asset('vendor/laravel-filemanager/js/lfm.js') }}"></script>
  <script>
    $(function () {
      $('.shortoption').select2({
        minimumResultsForSearch: -1
      })
    })

    function delete_with_confirm(id) {
      var answar = confirm("Do you want to delete !");
      if (answar == true) {
        $("#" + id).submit();
      }
    }

    // image preview
    $('#customFile').filemanager('image');
  </script>

@endsection
