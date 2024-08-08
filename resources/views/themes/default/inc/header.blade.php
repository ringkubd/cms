@inject('home', 'App\Home')
<header class="header-area d-print-none">
  <div class="newsbox-main-menu fixed-top">
    <div class="classy-nav-container breakpoint-off">
      <div class="container">
        <nav class="classy-navbar justify-content-between" id="newsboxNav">
          <a href="{{url("/")}}" class="nav-brand clearfix" title="IsDB-BISEW">
            <img src="{{asset("img/isdb-bisew.png")}}" class="float-left" alt="IsDB-BISEW">
            <div class="float-left logoTextArea">
              <h1 class="logotext">IsDB-BISEW</h1>
              <p class="tagline d-none d-sm-block">Islamic Development Bank<br>Bangladesh Islamic Solidarity
                Educational Wakf </p>
            </div>
          </a>
          <!-- Navbar Toggle -->
          <div class="classy-navbar-toggler">
            <span class="navbarToggler"><span></span><span></span><span></span></span>
          </div>
          <!-- Menu -->
          <div class="classy-menu">
            <!-- Close Button -->
            <div class="classycloseIcon">
              <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
            </div>
            <!-- Nav Start -->
            <div class="classynav">
              <ul>
                @php
                  $menus = $home->get_group_menu_by_parent('header-menu', 0);
                @endphp
                @forelse($menus as $item)
                  @php
                    $item = isset($item) ? $item : "";
                    $url = $item->menu_type == "internal" ? url($item->url) : $item->url;
                    $name = $item->name;
                    $data = json_decode($item->options);
                    $target = $data->menu_window > 0 ? 'target=_blank' : null;
                  @endphp
                  <li title="{{$data->menu_title}}">
                    <a href="{{url($url)}}" class="{{$data->menu_class}}" {{$target}}>{{$name}}</a>
                    @if($data->menu_class == "mega-menu")
                      @php $menus1 = $home->get_group_menu_by_parent('header-menu', $item->id);@endphp
                      @if($menus1->isNotEmpty())
                        <div class="megamenu">
                          @foreach($menus1 as $item1)
                            @php
                              $item1 = isset($item1) ? $item1 : "";
                              $url = $item1->menu_type == "internal" ? url($item1->url) : $item1->url;
                              $name1 = $item1->name;
                              $data = json_decode($item1->options);
                              $target1 = $data->menu_window > 0 ? 'target=_blank' : "";
                            @endphp
                            <ul class="single-mega cn-col-5">
                              <li class="title" title="{{$data->menu_title}}">
                                <a href="{{url($url)}}" class="{{$data->menu_class}}" {{$target1}}>{{$name1}}</a>
                              </li>
                              @php $menus2 = \App\Home::get_group_menu_by_parent('header-menu', $item1->id); @endphp
                              @if($menus2->isNotEmpty())
                                @foreach($menus2 as $item2)
                                  @php
                                    $item2 = isset($item2) ? $item2 : "";
                                    $url = $item2->menu_type == "internal" ? url($item2->url) : $item2->url;
                                    $name2 = $item2->name;
                                    $data = json_decode($item2->options);
                                    $target2 = $data->menu_window > 0 ? 'target=_blank' : "";
                                  @endphp
                                  <li title="{{$data->menu_title}}">
                                    <a href="{{url($url)}}" class="{{$data->menu_class}}" {{$target2}}>{{$name2}}</a>
                                  </li>
                                @endforeach
                              @endif
                            </ul>
                          @endforeach
                        </div>
                      @endif
                    @else
                      @php $menus1 = \App\Home::get_group_menu_by_parent('header-menu', $item->id); @endphp
                      @if($menus1->isNotEmpty())
                        <ul class="dropdown">
                          @foreach($menus1 as $item)
                            @php
                              $item = isset($item) ? $item : "";
                              $url = $item->menu_type == "internal" ? url($item->url) : $item->url;
                              $name1 = $item->name;
                              $data = json_decode($item->options);
                              $target3 = $data->menu_window > 0 ? 'target="_blank" ' : "";
                            @endphp
                            <li title="{{$data->menu_title}}">
                              <a href="{{url($url)}}" class="{{$data->menu_class}}" {{$target3}}>{{$name1}}</a>
                            </li>
                          @endforeach
                        </ul>
                      @endif
                    @endif
                  </li>
                @empty
                  <li>
                    <a href="#" class="nav-link">Not Set Yet</a>
                  </li>
                @endforelse
                <li>
                  <a href="{{url('contact')}}" class="nav-link" style="text-transform: none;">Contact us</a>
                </li>
              </ul> <!-- Header Add Area -->
            </div> <!-- Nav End -->
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>
<!-- ##### Header Area End ##### -->
