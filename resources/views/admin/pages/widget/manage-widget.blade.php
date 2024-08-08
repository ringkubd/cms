@extends('admin.layouts.app')

@section('title', 'Create new widget group')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li>widget</li>
  <li class="active">Create widget</li>
</ol>
@endsection

@section('content')
<section class="content">
  <div class="row">
    <div class="col-md-4">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Create new widget</h3>
          <a href="{{url('admin/widget')}}" class="btn btn-link">show all</a>
          @if(in_array('edit', request()->segments()))
          <a href="{{url('admin/widget')}}" class="btn btn-link">Create new</a>
          @endif
        </div>
        <div class="box-body">
          @if(in_array('edit', request()->segments()))
          @include('admin.pages.widget.form.edit')
          @else
          @include('admin.pages.widget.form.create')
          @endif
        </div> <!-- .box-body -->
      </div> <!-- .box -->
    </div> <!-- .col-md-4 -->

    <div class="col-sm-4">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Widget list</h3>
        </div>
        <div class="box-body widget-control">
          <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            @foreach ($widgets as $key => $widget)
            <div class="panel panel-default">
              <div class="panel-heading clearfix" role="tab" id="heading{{$key}}">
                <h4 class="panel-title float-left" style="margin: 5px 0;">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}"
                    aria-expanded="true" aria-controls="collapse{{$key}}">
                    {{$widget->title}}
                  </a>
                </h4>
                <div class="float-right">
                  <div class="dropdown">
                    <button id="dLabel{{$key}}" class="btn btn-sm btn-info" type="button" data-toggle="dropdown">
                      <i class="fa fa-ellipsis-v"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dLabel{{$key}}">
                      <li>
                        <a href="#" class="addWidget" data-widget-id="{{$widget->id}}">Add to widget</a>
                      </li>
                      <li>
                        <a href="{{url("admin/widget/{$widget->id}/edit")}}">Edit widget</a>
                      </li>
                      <li>
                        <a href="#" class="text-maroon" onclick="del_confirm('form-{{$widget->id}}')"> Delete widget
                        </a>
                        <form id="form-{{$widget->id}}" class="hide" action="{{ url("admin/widget/{$widget->id}") }}"
                          method="POST">
                          @method('delete')
                          @csrf
                        </form>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div id="collapse{{$key}}" class="panel-collapse collapse @if($loop->first) in @endif" role="tabpanel"
                aria-labelledby="heading{{$key}}">
                <div class="panel-body">
                  {!! $widget->description !!}
                </div>
              </div>
            </div>
            @endforeach
          </div> <!-- .panel-group -->
        </div> <!-- .box-body -->
        <div class="modal fade" id="add-to-widget" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add To Widget</h4>
              </div>
              <div class="modal-body">
                <form action="{{url('admin/widget-set')}}" method="POST">
                  @csrf
                  <div class="form-group">
                    <label for="widget">Widget</label>
                    <select name="widget" class="form-control shortOption" id="widget">
                      @foreach ($widgets as $widget)
                      <option value="{{$widget->id}}">{{$widget->title}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="widGroup">Widget Group</label>
                    <select name="widGroup" class="form-control shortOption" id="widGroup">
                      @foreach ($groups as $group)
                      <option value="{{$group->id}}">{{$group->name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-success">
                  </div>
                </form>
              </div>
            </div> <!-- /.modal-content -->
          </div> <!-- /.modal-dialog -->
        </div>
      </div> <!-- .box -->
    </div> <!-- .col-md-4 -->

    <div class="col-sm-4">
      <div class="box box-info">
        <div class="box-header with-border">
          <div class="form-group margin-bottom-none">
            <label for="group" class="sr-only">Select Group</label>
            <select name="group" class="form-control shortOption" id="group">
              <option value="">Select a widget group</option>
              @foreach ($groups as $group)
              <option value="{{$group->id}}">{{$group->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="box-body">
          <div class="panel-group group-widget-show" id="accordion" role="tablist" aria-multiselectable="true">
          </div>
        </div> <!-- .box-body -->
      </div> <!-- .box -->
    </div> <!-- .col-md-4 -->
  </div> <!-- .row -->
</section>
@stop

@section('custom-css-file')
<link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">
@stop

@section('custom-script')
<script src="{{ asset("assets/js/editor/editor-4.min.js")}}"></script>
<script src="{{ asset("assets/js/editor/editor-helper.js")}}"></script>
<script src="{{ asset("assets/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script>
  $(document).ready(function () {
      small_editor("#description", 200);
      $('.addWidget').click(function (event) {
        event.preventDefault();
        const widID = $(this).attr('data-widget-id');
        const widget = $('#add-to-widget');
        $('#widget option[value=' + widID + ']').attr('selected', 'selected').change();
        widget.modal('show');
      })
    });

    $(document).on('click', '.remove-widget', function (event) {
      event.preventDefault();
      const widID = $(this).attr('data-id');
      const group = $('#group').val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: '/admin/widget/remove',
        data: {
          'widID': widID,
          'group': group,
        },
        success: function (data) {
          $(this).closest('.float-right').remove();
        },
        error: function (data) {
          alert('something error on the server');
        },
      });

    });

    $(document).on('change', '#group', function () {
      const group_id = $(this).val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type: 'POST',
        url: '/admin/widget-get',
        data: {
          'group_id': group_id,
        },
        success: function (data) {
          $('.group-widget-show').empty().html(data);
        },
        error: function (data) {
          alert('something error on the server');
        },
      });
    });
</script>
@stop
