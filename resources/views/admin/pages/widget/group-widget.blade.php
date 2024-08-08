@foreach ($widgets as $key => $widget)
  <div class="panel panel-default">
    <div class="panel-heading clearfix" role="tab" id="wHeading{{$key}}">
      <h4 class="panel-title float-left" style="margin: 5px 0;">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#wCollapse{{$key}}"
           aria-expanded="true" aria-controls="wCollapse{{$key}}">
          {{$widget->title}}
        </a>
      </h4>
      <div class="float-right">
        <div class="dropdown">
          <button id="wLabel{{$key}}" class="btn btn-sm btn-info" type="button" data-toggle="dropdown">
            <i class="fa fa-ellipsis-v"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="wLabel{{$key}}">
            <li>
              <a href="{{url("admin/widget/{$widget->id}/edit")}}">Edit</a>
            </li>
            <li>
              <a href="#" data-id="{{$widget->id}}" class="text-maroon remove-widget">Remove</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div id="wCollapse{{$key}}" class="panel-collapse collapse @if($loop->first) in @endif" role="tabpanel"
         aria-labelledby="wHeading{{$key}}">
      <div class="panel-body">
        {!! $widget->description !!}
      </div>
    </div>
  </div>
@endforeach
