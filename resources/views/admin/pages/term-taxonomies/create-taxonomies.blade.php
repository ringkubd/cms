@extends('admin.layouts.app')

@section('title', 'Create term and taxonomies')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Terms</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">

  <form action="{{ url('admin/term') }}" method="POST">
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Create new Term</h3>
            <a href="{{url("admin/term")}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" checked> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="name">Term Name</label>
                  <input type="text" name="name" value="{{old('name')}}" class="form-control" id="name"
                    placeholder="Term Name">
                  @error('name')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                  <input type="hidden" name="slug" id="slug">
                </div>
                <div class="form-group">
                  <label for="module_id">Module</label>
                  <select name="module_id" id="module_id" class="form-control">
                    <option value="0">All Module</option>
                    @foreach ($modules as $module)
                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                    @endforeach
                  </select>
                  @error('module_id')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Term Description</label>
                  <textarea name="description" id="description" rows="3" maxlength="400" class="form-control"
                    placeholder="Term description">{{old('description')}}</textarea>
                  @error('description')
                  <p class="text-danger">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Create" name="submitbtn" title="submit">
              <a href="{{ url('admin/term-taxonomy/create') }}" class="btn btn-danger">Reset</a>
            </div>

          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div>
      <!--/.col-md-7 -->
      <div class="col-sm-5">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Help</h3>
          </div>
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Term Name</strong>
            <p class="text-muted">
              Taxonom is the post group. create new Term organized post.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Term Description</strong>
            <p class="text-muted">
              This description is about the Term that you create.
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
  $(document).on("keyup", "#name", function () {
      const name = $(this).val();
      const url = "{{url('/')}}/get-slug-from-title";
      ajax_slug_url(name, url);
    });

    function ajax_slug_url(title, ajaxurl) {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
          'title': title
        },
        success: function (data) {
          $("#slug").val(data);
        },
      });
    }

</script>

@endsection