@extends('admin.layouts.app')

@section('title', 'Register new Round ')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
        <li class="active">Round</li>
    </ol>
@endsection

{{-- main content section strat  --}}
@section('content')

    <section class="content">
        <form action="{{ url('admin/round') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <!-- Form Element sizes -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Register new Round</h3>
                            <a href="{{url("admin/round")}}" class="btn btn-link">show all</a>
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
                                <div class="col-sm-6 form-group">
                                    <label for="roundName">Round Name <span class="text-danger">*</span></label>
                                    <input type="text" name="roundName" value="{{old('roundName')}}"
                                           class="form-control"
                                           id="roundName" placeholder="Round name">
                                    @if ($errors->has('roundName'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('roundName') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="project">Project</label>
                                    <select name="module_id" id="project" class="form-control longoption">
                                        @forelse ($modules as $module)
                                            <option value="{{$module->id}}">{{$module->name}}</option>
                                        @empty
                                            <option value="0">none</option>
                                        @endforelse
                                    </select>
                                    @if ($errors->has('module_id'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('module_id') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="start_date">Round Start</label>
                                    <div class='input-group dateTimePicker'>
                                        <input type='text' value="{{old("start_date")}}" name="start_date"
                                               class="form-control"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('start_date') }}</small>
                                        </p>
                                    @endif
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="end_date">Round End</label>
                                    <div class='input-group dateTimePicker'>
                                        <input type='text' value="{{old("end_date")}}" name="end_date"
                                               class="form-control"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    @if ($errors->has('start_date'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('start_date') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 form-group">
                                    <label for="description">Round Description</label>
                                    <textarea name="description" id="description" rows="5" maxlength="400"
                                              class="form-control"
                                              placeholder="Round description">{{old('description')}}</textarea>
                                    @if ($errors->has('description'))
                                        <p class="text-danger margin-bottom-none">
                                            <small>{{ $errors->first('description') }}</small>
                                        </p>
                                    @endif
                                </div>
                            </div> <!-- /.row -->

                            <div class="form-group">
                                <input type="submit" class="btn btn-green" value="Create" name="submitbtn"
                                       title="submit">
                                <a href="{{ url('admin/round/create') }}" class="btn btn-danger">Reset</a>
                            </div>

                        </div> <!-- /.box-body -->
                    </div> <!-- /.box -->
                </div> <!--/.col-md-7 -->
                <div class="col-sm-5">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Help</h3>
                        </div>
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> Round Name</strong>
                            <p class="text-muted">
                                Fill the field with a Round name. Example Round-36
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i> Round Start date</strong>
                            <p class="text-muted">
                                This is the start date of the the round, You can also input the time of starting the
                                round
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i> Round End date</strong>
                            <p class="text-muted">
                                This is the End date of the the round, You can also input the time of starting the round
                            </p>
                            <hr>
                            <strong><i class="fa fa-book margin-r-5"></i> Round Description</strong>
                            <p class="text-muted">
                                This is the short descriptions of the round. It is optional to input. You can fill it
                                later.
                            </p>
                            <hr>
                        </div> <!-- /.box-body -->
                    </div> <!-- /.box -->
                </div> <!--/.col-md-5 -->
            </div> <!--/.row -->

        </form>


    </section>

@endsection

<!-- custom style for this page -->
@section('custom-css-file')
    <!-- bootstrap-datetimepicker -->
    <link rel="stylesheet" href="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.css") }}">
    <!-- select 2 -->
    <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@endsection

<!-- custom script for this page  -->
@section('custom-script')
    <!-- datepicker -->
    <script src="{{ asset("assets/plugins/timepicker/bootstrap-datetimepicker.min.js")}}"></script>
    <!-- Select2 -->
    <script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
    <script>
        $(function () {
            $('.longoption').select2();
            $('.shortoption').select2({
                minimumResultsForSearch: -1
            });

            // date time picker
            var dateNow = new Date();
            $('.dateTimePicker').datetimepicker({
                format: "DD-MM-YYYY hh:mm a",
                // defaultDate: moment().subtract(1, 'days'),
                defaultDate: moment(),
                useCurrent: false
            });
        })
    </script>
@endsection