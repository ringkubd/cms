@extends('admin.layouts.app')

@section('title', 'Contact messages')

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
      <div class="col-md-12">
        <!-- Form Element sizes -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Contact messages</h3>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-striped table-bordered">
              <tr>
                <th>Name</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
              </tr>
              @forelse ($contacts as $contact)
                <tr>
                  <td>{{$contact->name}}</td>
                  <td>{{$contact->subject}}</td>
                  <td>
                    {!! word_limiter($contact->message, 15) !!}
                    <br>
                    <a href="{{url("admin/contact/{$contact->id}")}}" class="text-aqua" title="Read message">Read
                      message</a> |
                    @if($contact->viewed)
                      <span class="text-olive">seen</span>
                    @else
                      <a href="{{ url("admin/contact/{$contact->id}/edit")}}" class="text-orange" title="Mark as seen">
                        Mark as seen
                      </a>
                    @endif
                    <form id="delete_button{{$contact->id}}" action="{{route('contact.destroy', $contact->id)}}" method="POST">
                      @method('DELETE')
                      @csrf
                      <a href="#" class="text-danger" onclick="delete_contact_with_confirm({{$contact->id}})" title="Delete">Delete</a>
                    </form>
                  </td>
                  <td><a href="mailto:{{$contact->email}}">{{$contact->email}}</a></td>
                  <td><a href="tel:{{$contact->phone}}">{{$contact->phone}}</a></td>
                  <td>{{\Illuminate\Support\Carbon::parse($contact->created_at)->format('M d, Y h:i:s a')}}</td>
                </tr>
              @empty
                <tr class="bg-danger">
                  <td colspan="8">No data</td>
                </tr>
              @endforelse

            </table>
          </div> <!-- .box-body -->
          <div class="box-footer clearfix">
            <div class="pull-right">
              {{ $contacts->links() }}
            </div>
          </div> <!-- .box box-footer -->
        </div> <!-- .box -->
      </div> <!-- .col-md-7 -->
    </div> <!-- .row -->
  </section>
@stop


@section('custom-script')

  <script>
    function delete_with_confirm(id) {
      var answar = confirm("Do you want to delete !");
      if (answar == true) {
        $("#" + id).submit();
      }
    }

    function delete_contact_with_confirm(id) {
      var answar = confirm("Do you want to delete !");
      if (answar == true) {
        $("#delete_button" + id).submit();
      }
    }

  </script>

@stop
