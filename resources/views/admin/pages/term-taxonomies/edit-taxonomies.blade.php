@extends('admin.layouts.app')

@section('title', 'Update selected term and taxonomies')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Taxonomy</li>
  </ol>
@endsection

{{-- main content section start form here --}}
@section('content')
  <section class="content">
    <form action="{{ url("admin/term/{$termTaxonomies->id}") }}" method="POST">
      @method("PUT")
      @csrf
      <div class="row">
        <div class="col-md-6">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Term</h3>
              <a href="{{url("admin/term-taxonomy")}}" class="btn btn-link">show all</a>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="form-group col-sm-12">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="active" value="1" {{ $termTaxonomies->active > 0 ? 'checked' : '' }}>
                    Active
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="name">Term Name</label>
                    <input type="text" name="name" value="{{$termTaxonomies->name ?? old('name')}}"
                           class="form-control" id="name" placeholder="Taxonomy name">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <input type="hidden" name="slug" value="{{$termTaxonomies->slug}}">
                  </div>
                  <div class="form-group">
                    <label for="module_id">Module</label>
                    <select name="module_id" id="module_id" class="form-control" disabled>
                      <option value="0">All Module</option>
                      @foreach ($modules as $module)
                        @php
                          $termTaxonomies = isset($termTaxonomies) ? $termTaxonomies : "";
                          $selected = $module->id !== $termTaxonomies->module_id ? "selected" : "";
                        @endphp
                        <option value="{{ $module->id }}" {{$selected}}>{{ $module->name }}</option>
                      @endforeach
                    </select>
                    @error('module_id')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Term Description</label>
                    <textarea name="description" id="description" rows="5" maxlength="400" class="form-control"
                              placeholder="Taxonomy description">{{$termTaxonomies->description ?? old('description')}}</textarea>
                    @error('description')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                  </div>
                </div>
              </div> <!-- /.row -->

              <div class="form-group">
                <input type="submit" class="btn btn-green" value="Update" name="submitbtn" title="Update">
                <a href="{{ url("admin/term-taxonomy/{$termTaxonomies->id}/edit") }}" class="btn btn-danger"
                   title="Reset">Reset</a>
              </div>

            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div>
        <!--/.col-md-7 -->
        <div class="col-sm-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Help</h3>
            </div>
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Taxonomy Name</strong>
              <p class="text-muted">
                Taxonom is the post group. create new Taxonomy organized post.
              </p>
              <hr>
              <strong><i class="fa fa-book margin-r-5"></i> Taxonomy Description</strong>
              <p class="text-muted">
                This description is about the Taxonomy that you create.
              </p>
              <hr>
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div>
        <!--/.col-md-5 -->
      </div>
      <!--/.row -->

    </form>


  </section>

@endsection


@section('custom-script')

  <script>
    //code goes there
  </script>

@endsection
