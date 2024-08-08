@extends('admin.layouts.app')

@section('title', "{$note->note_title}")

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">{{$note->note_title}}</li>
  </ol>
@stop

@section('content')
  <section class="content">
    <div class="row">
      <div class="col-md-9">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#note" data-toggle="tab">Note</a></li>
            <li><a href="{{url('admin/note/create')}}">New Note</a></li>
          </ul>
          <div class="tab-content">
            <div class="active tab-pane" id="note">
              <div class="post" style="padding: 0 10px 10px">
                <h1>{{$note->note_title}}</h1>
                {!! $note->note_content !!}
                @if($note->user_id == auth()->id())
                  <ul class="list-inline">
                    <li>
                      <a href="{{url("admin/note/{$note->id}/edit")}}" class="link-black text-sm">
                        <i class="fa fa-pencil margin-r-5"></i> Edit
                      </a>
                    </li>
                    <li>
                      <a href="#" class="link-black text-maroon text-sm" onclick="delete_with_confirm('{{$note->id}}')">
                        <i class="fa fa-trash-o margin-r-5"></i> Delete
                      </a>
                      <form id="{{$note->id}}" action="{{ url("admin/note/{$note->id}") }}" method="POST" class="hide">
                        @method('delete') @csrf
                      </form>
                    </li>
                    {{--                  <li class="pull-right">--}}
                    {{--                    <a href="#" class="link-black text-sm"><i class="fa fa-comments-o margin-r-5"></i> Comments--}}
                    {{--                      (5)</a>--}}
                    {{--                  </li>--}}
                  </ul>
                @endif
              </div> <!-- /.post -->
            </div> <!-- /.note-pane -->
          </div> <!-- /.tab-content -->
        </div> <!-- /.nav-tabs-custom -->
      </div> <!--  .col -->
      <div class="col-md-3">
        <div class="box box-primary">
          <div class="box-body box-profile">
            <img class="profile-user-img img-responsive"
                 src="{{asset($note->user->picture)}}" alt="User profile picture">
            <h3 class="profile-username text-center">{{ "{$note->user->firstName} {$note->user->LastName}"}}</h3>
            <ul class="list-group list-group-unbordered">
              <li class="list-group-item">
                <b>Note Date</b> <a class="pull-right">{{web_date($note->created_at)}}</a>
              </li>
            </ul>
          </div> <!-- /.box-body -->
        </div> <!-- /.box -->
      </div> <!-- /.col -->
    </div> <!-- /.row -->
  </section>
@stop


@section('custom-script')
  <script>
    function delete_with_confirm(id) {
      const answer = confirm("Do you want to delete !");
      if (answer === true) {
        $("#" + id).submit();
      }
    }
  </script>
@stop

