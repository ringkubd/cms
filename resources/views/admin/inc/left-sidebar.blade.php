@inject("admin", "App\Admin")

<aside class="main-sidebar">
  <section class="sidebar">
    <!-- Access control Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      @php
      $menus = $admin->find_sidebar_menu(0);
      @endphp
      @empty(!$menus)
      @foreach( $menus as $menu)
      @php
      $menu = isset($menu) ? $menu : "";
      $menuOne = $admin->find_sidebar_menu($menu->id);
      $treeview = $menuOne->first() ? "treeview" : null;
      @endphp
      <li class="{{$treeview}} @if(request()->is($menu->route_uri)) active @endif" title="{{ $menu->name }}">
        <a href="{!! url($menu->route_uri) !!}">
          <i class="fa {{ $menu->icon }}"></i>
          <span>{{ $menu->name }}</span>
          @if($treeview)
          <div class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </div>
          @endif
        </a>
        @if($treeview)
        <ul class="treeview-menu">
          @foreach ( $menuOne as $submenu)
          @php
          $submenu = isset($submenu) ? $submenu : "";
          $menuTwo = $admin->find_sidebar_menu($submenu->id);
          $secondTreeview = $menuTwo->first() ? "treeview" : null;
          @endphp
          <li class="{{$secondTreeview}} @if(request()->is($submenu->route_uri)) active @endif"
            title="{{ $submenu->name }}">
            <a href="{!! url($submenu->route_uri ) !!}">
              <i class="fa {{ $submenu->icon }}"></i>
              <span>{{ $submenu->name }}</span>
              @if($secondTreeview)
              <div class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </div>
              @endif
            </a>
            @if($secondTreeview)
            <ul class="treeview-menu">
              @foreach ( $menuTwo as $submenu1)
              @php
              $submenu1 = isset($submenu1) ? $submenu1 : "";
              $menuThree = $admin->find_sidebar_menu($submenu1->id);
              $ThirdTreeview = $menuThree->first() ? "treeview" : null;
              @endphp
              <li class="{{$ThirdTreeview}} @if(request()->is($submenu1->route_uri)) active @endif"
                title="{{ $submenu1->name }}">
                <a href="{!! url($submenu1->route_uri) !!}">
                  <i class="fa {{ $submenu1->icon }}"></i>{{$submenu1->name}}
                  @if($ThirdTreeview)
                  <div class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </div>
                  @endif
                </a>
                @if($ThirdTreeview)
                <ul class="treeview-menu">
                  @foreach ( $menuThree as $submenu2)
                  @php
                  $submenu2 = isset($submenu2) ? $submenu2 : "";
                  $menuFour = $admin->find_sidebar_menu($submenu2->id);
                  $fourTreeview = $menuFour->first() ? "treeview" : null;
                  @endphp
                  <li class="{{$fourTreeview}}@if(request()->is($submenu2->route_uri)) active @endif"
                    title="{{ $submenu2->name }}">
                    <a href="{!! url($submenu2->route_uri) !!}">
                      <i class="fa {{ $submenu2->icon }}"></i>{{$submenu2->name}}
                      @if($fourTreeview)
                      <div class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </div>
                      @endif
                    </a>
                  </li>
                  @endforeach
                </ul>
                @endif
              </li>
              @endforeach
            </ul>
            @endif
          </li>
          @endforeach
        </ul>
        @endif
      </li>
      @endforeach
      @endempty
    </ul> <!-- /.sidebar-menu -->
  </section> <!-- /.sidebar -->
</aside> <!-- /.aside -->


<script>
  $('a[href="'+window.location.href+'"]').parents('li').addClass('active');
</script>