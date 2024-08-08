@inject('contact','App\Models\Contact')
@inject('carbon','Carbon\Carbon')
<header class="main-header">
  <a href="{{ url("/") }}" class="logo" target="_blank">
    <span class="logo-mini"><b>Is</b>DB</span>
    <span class="logo-lg">IsDB-BISEW</span>
  </a>
  <nav class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown messages-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            @php $CountUnread = $contact->count_unread_contact(); @endphp
            <span class="label label-success">{{$CountUnread}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have {{$CountUnread}} Contact messages</li>
            <li>
              <ul class="menu">
                @php
                $CountUnread = $contact->unread_contact_message();
                @endphp
                @foreach($CountUnread as $contact)
                <li>
                  <a href="{{url("admin/contact/{$contact->id}")}}">
                    <h4 style="margin: 0">
                      {{$contact->name}}
                      <small><i class="fa fa-clock-o"></i>
                        {{ $carbon->parse($contact->created_at)->diffForHumans()}}</small>
                    </h4>
                    <p style="margin: 0">{!! word_limiter($contact->message, 8) !!}}</p>
                  </a>
                </li>
                @endforeach
              </ul>
            </li>
            <li class="footer">
              <a href="{{url('admin/contact')}}">See All Contact Messages</a>
            </li>
          </ul>
        </li> <!-- .messages-menu -->

        <!-- Notifications Menu -->
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        <!-- Tasks Menu -->
        <li class="dropdown tasks-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-flag-o"></i>
            <span class="label label-danger">9</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 9 tasks</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <h3>
                      Design some buttons
                      <small class="pull-right">20%</small>
                    </h3>
                    <div class="progress xs">
                      <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                        aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                        <span class="sr-only">20% Complete</span>
                      </div>
                    </div>
                  </a>
                </li>
                <!-- end task item -->
              </ul>
            </li>
            <li class="footer">
              <a href="#">View all tasks</a>
            </li>
          </ul>
        </li>
        <!-- User Account Menu -->
        @auth
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset(Auth::user()->picture) }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->firstName}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              <img src="{{ asset(Auth::user()->picture) }}" class="img-circle" alt="User Image">
              <p>
                {{ Auth::user()->firstName }} - Web Developer
                <small>Member since Nov. 2012</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Followers</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Sales</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Friends</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a class="btn btn-default btn-flat" href="{{ url('logout') }}"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
        @endauth
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>