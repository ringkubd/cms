<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head id="topHead">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">


  <title>@yield('title') - {{ config('app.name') }}</title>
  <meta name="title" content="@yield('title')">
  <meta name="description" content="@yield('m_description')">
  <meta name="author" content="IsDB-BISEW">
  <meta name="robots" content="index, follow">
  <link rel="manifest" href="{{ asset('/manifest.json') }}">


  <meta property="og:type" content="website">
  <meta property="og:url" content="{{url()->full()}}">
  <meta property="og:title" content="@yield('m_title')">
  <meta property="og:description" content="@yield('m_description')">
  <meta property="og:image" content="@yield('m_image')">

  <meta property="twitter:card" content="isdbbisew">
  <meta property="twitter:url" content="{{url()->full()}}">
  <meta property="twitter:title" content="@yield('title')">
  <meta property="twitter:description" content="@yield('m_description')">
  <meta property="twitter:image" content="@yield('m_image')">

  <meta property="al:android:url" content="https://play.google.com/store/apps/details?id=com.ringkubd.isdbbisewapp" />
  <meta property="al:android:app_name" content="https://play.google.com/store/apps/details?id=com.ringkubd.isdbbisewapp" />
  <meta property="al:android:package" content="com.ringkubd.isdbbisewapp" />

  <link rel="shortcut icon" href="{{ asset('img/logo.png')}}" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous"/>
  @if(is_trending_now())
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/flexslider.min.css"
          integrity="sha256-ix4NEiyExf0o9g2FKaOSmi++y3NuwbRLiL3Ahw+IX8s=" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset("themes-assets/default/js/flexslider/flexslider-customization.min.css") }}">
  @endif
  <link rel="stylesheet" href="{{ mix("themes-assets/default/css/app.css") }}">
  <link rel="stylesheet" href="{{asset('corner-popup/src/css/corner-popup.css')}}">
  @stack('styles')

  <style>
    #corner-popup .corner-img {
      display: block;
      height: 100%;
      width: 190px!important;
      margin: 0 auto;
      border-radius: 0%!important;
    }
    #corner-popup{
      padding: 0!important;
    }
    #corner-popup .corner-head {
      font-weight: 500;
      font-size: 15px;
      line-height: 32px;
      #text-transform: uppercase;
      text-align: center;
      word-break: break-word;
      color: #543189;
      margin-bottom: 12px;
    }
  </style>

</head>

<body>

@inject('home','App\Home')

@php
  $path = ["about","contact",];
@endphp
@if(!in_array(request()->path(), $path))
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="lds-ellipsis">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div> <!-- Preloader -->
@endif

<!-- main navbar section -->
@include("themes.default.inc.header")

@if(count(request()->segments()) < 2)
  @php $module=request()->segment(1);
    $modals = $home->get_popup_modal_info($module)->shuffle();
  @endphp
  @if($modals->isNotEmpty())
    <div class="modal fade" id="popupMessage" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{$modals->first()->title}}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="carouselModal" class="carousel slide" data-ride="carousel" data-interval="20000">
              <ol class="carousel-indicators">
                @foreach($modals as $modal)
                  <li data-target="#carouselModal" data-slide-to="{{$loop->index}}"
                      class="@if($loop->first) active @endif"></li>
                @endforeach
              </ol>
              <div class="carousel-inner">
                @foreach($modals as $modal)
                  <div class="carousel-item @if($loop->first) active @endif">
                    <span class="d-none modalTitle">{{$modal->title}}</span>
                    @if($modal->upload_type !== "off" && !empty($modal->picture))
                      <img src="{{asset($modal->picture)}}" alt="{{$modal->title}}" class="d-block w-100">
                    @endif
                    <div class="carousel-caption d-md-block">
                      {!! $modal->description !!}
                    </div>
                  </div>
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselModal" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselModal" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div> <!-- .carousel -->
          </div> <!-- .modal-body -->
        </div> <!-- .modal-content -->
      </div>
    </div>
  @endif
@endif

@if(is_trending_now())
  @include('themes.default.inc.update-section')
@endif


{{--main content section--}}
@yield('content')

{{--get theme footer--}}
@include("themes.default.inc.footer")

<a href="#topHead" class="page-scroll" id='to-top'>
  <i class="fa fa-angle-up"></i>
</a>
<div id="corner-popup">
  Hi, This is corner-popup.
</div>

<script src="{{mix("themes-assets/default/js/app.js")}}"></script>
<script src="{{asset('corner-popup/src/js/corner-popup.js')}}"></script>

@if(is_trending_now())
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.7.2/jquery.flexslider.min.js"
          integrity="sha256-wql/MDbyML50PJjxoPTgCa8ByZzyPX6HftEDWu6jovY=" crossorigin="anonymous"></script>
  <script>
    $(function () {
      $('#text-news').flexslider({
        animation: "slide",
        direction: "vertical",
        pauseOnHover: !0,
        controlNav: !1,
        animationLoop: !0,
        slideshowSpeed: 2500,
        slideshow: !0,
      });
      $('#video-slides').flexslider({
        animation: "slide",
        animationLoop: true,
        itemWidth: 300,
        controlNav: false,
        itemMargin: 30,
        minItems: 1, // use function to pull in initial value
        maxItems: 3 // use function to pull in initial value
      });
      $(document).find('.flex-direction-nav a').text('');
    })
  </script>
@endif

<script>
  $(function () {
    let modal = $('#popupMessage');
    modal.modal('show');
    let delayTime = $(".carousel-indicators").find("li").length * 2500 + 20000; // mile seconds
    $(this).delay(delayTime).queue(function () {
      modal.modal('hide');
    });
    // modal carousel slider configuration
    let Indicators = $("#carouselModal");
    Indicators.on('slid.bs.carousel', function () {
      let title = $(this).find('.carousel-item.active > .modalTitle').text();
      $(".modal-title").text(title);
    });

    // $("#corner-popup").cornerpopup({
    //   variant: 1,
    //   text1: "Tender for 2nd Land Project.",
    //   link1: "https://isdb-bisew.org/tender, _self",
    //   link2: "#, _self",
    //   popupImg: "/tender_attach/poster.png",
    //   cookieImg: "/tender_attach/Tender_12.08.21.png",
    //   messageImg: "/tender_attach/Tender_12.08.21.png",
    //   header: "Tender Notice for IDB Bhaban-2",
    //   button1: "Details"
    // })
  });
</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=G-KTZRWBT7HH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag() {
    dataLayer.push(arguments);
  }
  gtag('js', new Date());
  gtag('config', 'G-KTZRWBT7HH');
</script>

<script type="application/ld+json">
      {
      "@context": "http://schema.org/",
      "@type": "Organization",
      "name": "IsDB-BISEW",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "E/8-A, Rokeya Sharani, Sher-e-Bangla Nagar",
        "addressLocality": "Dhaka",
        "addressRegion": "Bangladesh",
        "postalCode": "1207"
      },
      "telephone": "+880 2 9183006"
    }
</script>
<script>
  let deferredPrompt;
  let btnAdd;
  window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    // Update UI notify the user they can add to home screen
    // btnAdd.style.display = 'block';
  });

  // btnAdd.addEventListener('click', (e) => {
  //   // hide our user interface that shows our A2HS button
  //   btnAdd.style.display = 'none';
  //   // Show the prompt
  //   deferredPrompt.prompt();
  //   // Wait for the user to respond to the prompt
  //   deferredPrompt.userChoice
  //     .then((choiceResult) => {
  //       if (choiceResult.outcome === 'accepted') {
  //         console.log('User accepted the A2HS prompt');
  //       } else {
  //         console.log('User dismissed the A2HS prompt');
  //       }
  //       deferredPrompt = null;
  //     });
  // });
</script>
@stack('scripts')
</body>

</html>
