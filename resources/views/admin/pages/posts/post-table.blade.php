<table class="table table-striped table-bordered table-hover">
  <tr class="vertical-middle">
    <th width="10">
      <label>
        <input type="checkbox" class="flat-red" id="checkall" value="all">
      </label>
    </th>
    <th>Title</th>
    <th width="180" class="text-center">Categories</th>
    <th width="120" class="text-center">Author</th>
    <th width="150" class="text-center">Date</th>
  </tr>
  @forelse($posts as $post)
    @if($post->categories->isNotEmpty() && $post->user)
      <tr>
        <td>
          <label>
            <input type="checkbox" name="checked_post[]" value="{{$post->id}}" class="flat-red single-check">
          </label>
        </td>
        <td>
          <span class="post-title">{{word_limiter($post->post_title, 12)}}</span>
          <p>
            <a href="{{url("admin/type/{$module->slug}/{$post->id}/edit")}}" class="nav-link" title="Edit">Edit
            </a>|
            <a href="javascript:" class="nav-link text-danger" onclick="delete_with_confirm('{{$post->id}}')"
               title="Delete Item"> Delete </a>|
            <a href="{{url("{$module->slug}/{$post->id}/{$post->post_slug}")}}" class="nav-link" title="View"
               target="_blank">View</a>
          </p>
          <form id="{{$post->id}}" action="{{ url("admin/type/{$module->slug}/{$post->id}") }}" method="POST"
                style="display: none;">
            @method('delete') @csrf
          </form>
        </td>
        <td class="text-center">
          @if($post->categories)
            @foreach($post->categories as $category)
              <a href="{{url("admin/type/{$module->slug}?category={$category->slug}")}}"
                 class="nav-link category">{{$category->name}}</a>,
            @endforeach
          @endif
        </td>
        <td class="text-center">
          <a href="{{url("admin/type/{$module->slug}?author={$post->user->id}")}}">
            {{$post->user->firstName." ".$post->user->LastName}}
          </a>
        </td>
        <td class="text-center">
          <p class="status">{{$post->post_status}}</p>
          @if($post->post_status == "schedule")
            <p class="date">{{ date("d-m-Y h:i a", strtotime($post->schedule_time)) }}</p>
          @elseif($post->post_status == "draft")
            <p class="date">{{ date("d-m-Y h:i a", strtotime($post->created_at)) }}</p>
          @else
            <p class="date">{{ date("d-m-Y h:i a", strtotime($post->created_at)) }}</p>
          @endif
        </td>
      </tr>
    @endif
  @empty
    <tr>
      <td colspan="5">No post data</td>
    </tr>
  @endforelse

</table>

<div class="col-sm-12">
  {!! $posts->appends([
  'category' => request('category'),
  'author' => request('author'),
  'status' => request('status'),
  'start' => request('start'),
  'end' => request('end'),
  'order' => request('order')
  ])->render() !!}
</div>
