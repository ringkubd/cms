<table class="table table-striped table-bordered table-hover">
  <tr class="vertical-middle">
    <th width="10">
      <label>
        <input type="checkbox" class="flat-red" id="checkall" value="all">
      </label>
    </th>
    <th>Title</th>
    <th width="180" class="text-center">Label</th>
    <th width="120" class="text-center">Author</th>
    <th width="150" class="text-center">Date</th>
  </tr>
  @forelse($notes as $note)
    <tr>
      <td>
        <label>
          <input type="checkbox" name="checked_post[]" value="{{$note->id}}" class="flat-red single-check">
        </label>
      </td>
      <td>
        <span class="post-title">{{word_limiter($note->note_title, 12)}}</span>
        <p>
          <a href="{{url("admin/note/{$note->id}")}}" class="nav-link" title="View">View</a>
          @if(auth()->id() == $note->user_id)
            | <a href="{{url("admin/note/{$note->id}/quick-edit")}}" class="nav-link quick-edit" data-id="{{$note->id}}"
               data-title="{{$note->note_title}}" data-status="{{$note->note_status}}"
               data-create="{{date('d-m-Y', strtotime($note->created_at))}}" title="Quick Edit">Quick
              Edit
            </a>|
            <a href="{{url("admin/note/{$note->id}/edit")}}" class="nav-link" title="Edit">Edit
            </a>|
            <a href="javascript:" class="nav-link text-danger" onclick="delete_with_confirm('{{$note->id}}')"
               title="Delete Item"> Delete </a>
          @endif
        </p>
        <form id="{{$note->id}}" action="{{ url("admin/note/{$note->id}") }}" method="POST" class="hide">
          @method('delete') @csrf
        </form>
      </td>
      <td class="text-center">
        Not set
      </td>
      <td class="text-center">
        <a href="{{url("admin/notes?author={$note->user_id}")}}">
          {{$note->user->firstName." ".$note->user->LastName}}
        </a>
      </td>
      <td class="text-center">
        <p class="status">{{$note->note_status}}</p>
        @if($note->notet_status == "schedule")
          <p class="date">{{ date("d-m-Y h:i a", strtotime($note->schedule_time)) }}</p>
        @elseif($note->note_status == "draft")
          <p class="date">{{ date("d-m-Y h:i a", strtotime($note->created_at)) }}</p>
        @else
          <p class="date">{{ date("d-m-Y h:i a", strtotime($note->created_at)) }}</p>
        @endif
      </td>
    </tr>
  @empty
    <tr>
      <td colspan="5">No post data</td>
    </tr>
  @endforelse
</table>


