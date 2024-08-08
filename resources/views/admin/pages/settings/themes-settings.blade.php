@extends('admin.layouts.app')

@inject("home", "App\Home")

@section('title', 'Choose your themes')

@section('breadcrumb')
  <ol class="breadcrumb">
    <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    <li class="active">Themes Settings</li>
  </ol>
@endsection

{{-- main content section strat  --}}
@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <section class="content">
    <form action="{{ url('admin/settings/theme-settings-save') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <!-- Form Element sizes -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Choose your theme</h3>
            </div>
            <div class="box-body">
              @php
                $selected = $home->get_settings("default_theme");
              @endphp
              <div class="col-sm-4">
                <div class="thumbnail">
                  @php
                    $path = public_path("themes-assets/{$selected}/screenshot.png");
                    if(file_exists($path)){
                    $pic_path = asset("themes-assets/{$selected}/screenshot.png");
                    }else{
                    $pic_path = asset("img/no-image.gif");
                    }
                  @endphp
                  <img src="{{$pic_path}}" alt="{{$selected}}">
                  <div class="caption">
                    <form action="{{url("admin/settings/theme-settings-save")}}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-sm-6">
                          <h5>{{$selected}}</h5>
                        </div>
                        <div class="col-sm-6">
                          <p class="margin-bottom-none text-right">
                            <input type="button" onclick="alert('Already Active')"
                                   class="btn btn-pinterest" value="Activated">
                          </p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>


              @php
                $directories = \Illuminate\Support\Facades\Storage::disk('themes')->directories();
              @endphp
              @foreach ($directories as $theme)
                @php
                  $theme = isset($theme) ? $theme : "";
                  $welcome = \Illuminate\Support\Facades\Storage::disk("themes")->exists($theme."/welcome.blade.php");
                  $master = \Illuminate\Support\Facades\Storage::disk("themes")->exists($theme."/layouts/master.blade.php");
                @endphp
                @if ($welcome && $master && $selected !== $theme)
                  <div class="col-sm-4">
                    <div class="thumbnail">
                      @php
                        $path = public_path("themes-assets/{$theme}/screenshot.png");
                        if(file_exists($path)){
                        $pic_path = asset("themes-assets/{$theme}/screenshot.png");
                        }else{
                        $pic_path = asset("img/no-image.gif");
                        }
                      @endphp
                      <img src="{{$pic_path}}" alt="{{$theme}}">
                      <div class="caption">
                        <form action="{{url("admin/settings/theme-settings-save")}}" method="post">
                          @csrf
                          <div class="row">
                            <div class="col-sm-6">
                              <h5>{{$theme}}</h5>
                            </div>
                            <div class="col-sm-6">
                              <p class="margin-bottom-none text-right">
                                <input type="hidden" name="theme" value="{{$theme}}">
                                <input type="submit" class="btn btn-linkedin" role="button"
                                       value="Active">
                              </p>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div> <!-- /.box-body -->
          </div> <!-- /.box -->
        </div> <!--/.col-md-12 -->

      </div> <!--/.row -->

    </form>


  </section>

@endsection


@section('custom-script')

  <script>
    // code go here

  </script>

@endsection
