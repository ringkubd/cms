@extends('admin.layouts.app')

@section('title', 'Show messages')

@section('content-header')

@section('breadcrumb')
<ol class="breadcrumb">
  <li><a href="{{ url('dashboard')}}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
  <li class="active">Contact</li>
</ol>
@endsection

{{-- main content start from here --}}
@section('content')

<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Show messages</h3>
        </div>
        <div class="box-body">
          <table class="table table-striped table-bordered">
            <tr>
              <td style="width: 20%">
                Sender
              </td>
              <td>
                {{$contact->name}}
              </td>
            </tr>
            <tr>
              <td>
                Subject
              </td>
              <td>
                {{$contact->subject}}
              </td>
            </tr>
            <tr>
              <td>
                Email
              </td>
              <td>
                <a href="mailto:{{$contact->email}}">{{$contact->email}}</a>
              </td>
            </tr>
            <tr>
              <td>
                Phone
              </td>
              <td>
                <a href="tel:{{$contact->phone}}">{{$contact->phone}}</a>
              </td>
            </tr>
            <tr>
              <td>
                Request IP
              </td>
              <td>
                {{$contact->ip_address}}
              </td>
            </tr>
          </table>

          <div class="message" style="padding: 15px;margin: 20px 0;border: 1px solid rgba(204, 204, 204, 0.43);">
            {!! $contact->message !!}
          </div>
        </div> <!-- /.box-body -->
        <div class="box-footer">
          <button onclick="window.history.back()" class="btn btn-adn btn-block" title="Go to previous page">
            <i class="fa fa-arrow-left"></i> Back
          </button>
        </div>
      </div> <!-- /.box -->
    </div> <!-- .col-md-6 -->
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-envelope"></i>
          <h3 class="box-title">Quick Reply</h3>
        </div>
        <div class="box-body">
          <form action="{{url("admin/contact/{$contact->id}")}}" method="post" id="email-submit">
            @method('put')
            @csrf
            <input type="hidden" name="reply_id" value="{{$contact->id}}">
            <input type="hidden" name="name" value="{{$contact->name}}">
            <input type="hidden" name="phone" value="{{$contact->phone}}">
            <div class="form-group">
              <input type="email" class="form-control" name="email" value="{{old('email',$contact->email)}}"
                placeholder="Email to:{{$contact->email}}">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" value="{{old('subject','Reply of IsDB-BISEW')}}"
                placeholder="Subject">
            </div>
            <div>
              <textarea class="textarea" name="message" placeholder="Message"
                style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('message')}}</textarea>
            </div>
          </form>
        </div>
        <div class="box-footer clearfix">
          <button type="button" onclick="submit_email()" class="btn btn-success" id="sendEmail">Send
            <i class="fa fa-arrow-circle-right"></i></button>
        </div>
      </div> <!-- .box -->
    </div> <!-- .col-md-6 -->
  </div> <!-- .row -->
</section>
@stop

@section('custom-css-file')
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
@stop


@section('custom-script')
<script src="{{asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>
  function submit_email() {
      $('#email-submit').submit()
    }

    $('.textarea').wysihtml5();
    function delete_with_confirm(id) {
      const answer = confirm("Do you want to delete !");
      if (answer) {
        $("#" + id).submit();
      }
    }

</script>

@stop