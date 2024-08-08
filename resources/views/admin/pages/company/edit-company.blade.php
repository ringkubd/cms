@extends('admin.layouts.app')

@section('title', "Edit {$company->name}")

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Company</li>
</ol>
@endsection

{{-- main content section strat  --}}
@section('content')

<section class="content">
  <form action="{{ url("admin/company/{$company->id}") }}" method="POST">
    @method("put")
    @csrf
    <div class="row">
      <div class="col-md-7">
        <!-- Form Element sizes -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit - {{$company->name}}</h3>
            <a href="{{url("admin/company/create")}}" class="btn btn-link">Register new</a>
            <a href="{{url("admin/company/all")}}" class="btn btn-link">show all</a>
          </div>
          <div class="box-body">
            <div class="row">
              <div class="form-group col-sm-12">
                <label class="checkbox-inline">
                  <input type="checkbox" name="active" value="1" {{ ($company->active == 1 ) ? "checked" : ""}}> Active
                </label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 form-group">
                <label for="name">Company Name <span class="text-danger">*</span></label>
                <input type="text" name="name" value="{{old('name') ?? $company->name}}" class="form-control" id="name"
                  placeholder="Company name">
                @if ($errors->has('name'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('name') }}</small>
                </p>
                @endif
              </div>
              <div class="col-sm-6 form-group">
                <label for="companyLocation">Company Location <span class="text-danger">*</span></label>
                <input type="text" name="companyLocation" value="{{old('companyLocation') ?? $company->location}}"
                  class="form-control" id="companyLocation" placeholder="Company Location">
                @if ($errors->has('companyLocation'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('companyLocation') }}</small>
                </p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="companyAddress">Company Address</label>
                <textarea name="companyAddress" id="companyAddress" rows="2" maxlength="200" class="form-control"
                  placeholder="Company Address">{{old('companyAddress') ?? $company->address}}</textarea>
                @if ($errors->has('companyAddress'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('companyAddress') }}</small>
                </p>
                @endif
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="4" maxlength="400" class="form-control"
                  placeholder="Company description">{{old('description') ?? $company->description}}</textarea>
                @if ($errors->has('description'))
                <p class="text-danger margin-bottom-none">
                  <small>{{ $errors->first('description') }}</small>
                </p>
                @endif
              </div>
            </div> <!-- /.row -->

            <div class="form-group">
              <input type="submit" class="btn btn-green" value="Update" name="update-btn" title="submit">
              <a href="{{ url("admin/company/{$company->id}/edit") }}" class="btn btn-danger">Reset</a>
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
            <strong><i class="fa fa-book margin-r-5"></i> Company Name </strong>
            <p class="text-muted">
              Fill the field with a Company name. This field is required
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Company Location</strong>
            <p class="text-muted">
              This is the required field. Fill the company current location. Example- Dhaka
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Company Address</strong>
            <p class="text-muted">
              This is the full address of the company. This field is not required. You can fill it
              later.
            </p>
            <hr>
            <strong><i class="fa fa-book margin-r-5"></i> Description</strong>
            <p class="text-muted">
              This is the short descriptions of the Company. It is optional to input. You can fill it
              later.
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