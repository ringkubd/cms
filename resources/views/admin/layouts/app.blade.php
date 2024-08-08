<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="noindex, nofollow">
  <title>@yield('title') - {{ config('app.name') }}</title>


  <link rel="shortcut icon" href="{{ asset('img/logo.png')}}" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset("assets/bower_components/bootstrap/dist/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/bower_components/font-awesome/css/font-awesome.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/bower_components/Ionicons/css/ionicons.min.css") }}">
  <link rel="stylesheet" href="{{ asset("assets/bower_components/select2/dist/css/select2.min.css") }}">

  @yield('custom-css-file')

  <link rel="stylesheet" href="{{ asset('assets/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/skins/skin-blue.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fonts/google-fonts.css') }}">

  @yield('custom-style')

  <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    @include('admin.inc.navbar')

    @include('admin.inc.left-sidebar')

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <button onclick="window.history.back()" class="btn btn-sm btn-linkedin" title="Go to previous page">
            <i class="fa fa-arrow-left"></i>
          </button>
          <button onclick="window.history.forward()" class="btn btn-sm btn-linkedin" title="Go to next page">
            <i class="fa fa-arrow-right"></i>
          </button>
          @yield('page-title')
        </h1>

        @yield('breadcrumb')
      </section>
      @yield('content-header')

      @yield('content')

    </div> <!-- /.content-wrapper -->

    @include('admin.inc.right-sidebar')

    @include('admin.inc.footer')

  </div> <!-- .wrapper -->

  @include('sweetalert::alert')

  <script src="{{ asset('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
  <script src="{{ asset('assets/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
  @stack('scripts')

  @yield('custom-script')

  <script>
    $(document).on('click', '.btn-close', function () {
    $('.custom-alert').hide();
  });
  setTimeout(function () {
    $('.custom-alert .alert').hide();
    $('.custom-alert.alert').hide();
  }, 5000);

  $(function () {
    $('.longOption').select2();
    $('.shortOption').select2({
      minimumResultsForSearch: -1
    });
  });

  function icheck_iuncheck(checkall, checkboxes) {
    const All = $(checkall);
    const single = $(checkboxes);
    All.on('ifChecked ifUnchecked', function (event) {
      if (event.type === 'ifChecked') {
        single.iCheck('check');
      } else {
        single.iCheck('uncheck');
      }
    });
    single.on('ifChanged', function () {
      if (single.filter(':checked').length === single.length) {
        All.prop('checked', 'checked');
      } else {
        All.prop('checked', false);
      }
      All.iCheck('update');
    });
  }

  function preview_select_picture(input, preview) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
        $(preview).attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    }
  }

  function del_confirm(id){
    const confirm = window.confirm('Are you sure?');
    if (confirm){
      $(`#${id}`).submit()
    }
  }
  </script>

</body>

</html>
