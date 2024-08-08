<table class="table table-striped table-bordered">
  <thead>
  <tr>
    <th class="text-center">ID</th>
    <th>Name</th>
    <th>URL</th>
    <th class="text-center">Method</th>
    <th class="text-center">Parent</th>
    <th class="text-center">visiblity</th>
    <th class="text-center">Status</th>
    <th class="text-center">#</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($menus as $menu)
    <tr>
      <td class="text-center">{{$menu->id}}</td>
      <td>
        {{$menu->name}}

        <a href="/admin/admin-menu/{{$menu->id}}/edit" class="edit-menu text-blue" style="margin-left: 15px"
           title="edit"><i class="fa fa-pencil"></i></a>
      </td>
      <td>{{$menu->route_uri}}</td>
      <td class="text-center">{{$menu->method}}</td>
      <td class="text-center">{{$menu->ParentMenu->name ?? 'No Parent'}}</td>
      <td class="text-center">
        @if($menu->visibility)
          <span class="text-success">Yes</span>
        @else
          <span class="text-danger">No</span>
        @endif
      </td>
      <td class="text-center">
        @if($menu->active)
          <span class="text-success">Active</span>
        @else
          <span class="text-danger">Inactive</span>
        @endif
      </td>
      <td class="text-center">
        <a href="/admin/admin-menu/{{$menu->id}}/clone" class="btn btn-sm clone-menu text-blue" title="Clone">
          <i class="fa fa-copy"></i>
        </a>
        <a href="javascript:void(0)" class="btn btn-sm text-red" onclick="del_confirm('{{$menu->id}}')"
           title="Delete"><i class="fa fa-trash-o"></i></a>
        <form id="{{$menu->id}}" action="{{ url("admin/admin-menu/{$menu->id}") }}" method="POST" class="hide">
          @method('delete') @csrf
        </form>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>

{!! $menus->render() !!}
