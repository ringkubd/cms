@extends('admin.layouts.app')

@section('title', 'Your Api Token')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">API Token form</li>
  </ol>
@endsection

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-sm-8">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title">Get VT trainee picture</h3>
          </div>
          <div class="box-body">
            <table class="table table-bordered table-striped">
              <tr>
                <td colspan="2">
                  Api Url Key
                </td>
              </tr>
              <tr>
                <td>
                  url:
                </td>
                <td>
                  {{url('/')}}
                </td>
              </tr>
              <tr>
                <td>
                  api_token:
                </td>
                <td>
                  {{$token}}
                </td>
              </tr>
              <tr>
                <td>
                  trainee_id:
                </td>
                <td>
                  Dynamic
                </td>
              </tr>
              <tr>
                <td>
                  round:
                </td>
                <td>
                  Dynamic
                </td>
              </tr>
              <tr>
                <td>
                  applyDate:
                </td>
                <td>
                  Dynamic
                </td>
              </tr>
            </table>

            <form action="{{url('admin/api-token')}}" method="post">
              @csrf
              <div class="form-group">
                <label for="api_token">Your Api Token</label>
                <input type="hidden" name="api_token" class="form-control" id="api_token" value="{{$token}}" readonly>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-success" value="Re-Generate">
              </div>
            </form>
          </div> <!-- .box-body -->
        </div> <!-- .box -->
      </div> <!-- .col-md-4 -->
    </div> <!-- .row -->
  </section>
@endsection
