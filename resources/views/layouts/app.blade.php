<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
  <script src="https://kit.fontawesome.com/bc8e231302.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  {{-- for chart js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>
  <div id="app" style="">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"
      style="position:fixed; width:100%; z-index:9999">
      <div class="container d-flex flex-row justify-content-start">
        @auth
          @auth
            <div class="js-collapse-div" id="js-collapse-div" onclick="sidebarCollapse()" style="">
              <a href="#" style="text-decoration: none"><i class="fa fa-bars"></i></a>
            </div>

          <a class="navbar-brand" href="{{ url('/home') }}" style="margin-left: 30px">
            <img src="{{ asset('img/logo.png') }}" alt="..." style="width: 80px; height: 40px; margin-left: 0px">
          </a>
          @endauth
        @else
          <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('img/logo.png') }}" alt="..." style="width: 80px; height: 40px; margin-left: 0px">
          </a>
        @endauth

        {{-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button> --}}
        <ul class="navbar-nav ml-auto d-flex flex-row">
          <!-- Authentication Links -->
          @guest
            <li class="nav-item mr-2"><a class="nav-link" href="{{ route('login') }}" style="font-family: verdana">{{ __('Login') }}</a></li>
            @if (Route::has('register'))
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}" style="font-family: verdana">{{ __('Register') }}</a></li>
            @endif
          @else
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <form id="logout-form" method="POST" action="/logout" style="display: none;">
                  @csrf
                </form>
                <a class="dropdown-item" href="/profile">
                  {{ __('Profile') }}
                </a>
                <a class="dropdown-item" href="#"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>
              </div>
            </li>
          @endguest
        </ul>

      </div>
    </nav>
    <div style="padding-top: 80px"></div>

    <main class="py-4">
      @yield('content')
    </main>
  </div>

  <script>
    const expandElements = document.querySelectorAll(".js-expand");
    let isExpandElementsAdded = false;

    function toggleExpandElements() {
      if (!isExpandElementsAdded) {
        expandElements.forEach(el => el.classList.add("show"));
        isExpandElementsAdded = true;
      } else {
        expandElements.forEach(el => el.classList.remove("show"));
        isExpandElementsAdded = false;
      }
    }

    function sidebarCollapse() {
      const sidebar = document.querySelector(".main-sidebar1");
      if (sidebar.style.left === "0px") {
        sidebar.style.transition = "left 0.5s ease";
        sidebar.style.left = "-255px";
        document.querySelector(".content-wrapper1").style.transition = "margin 0.5s ease";
        document.querySelector(".content-wrapper1").style.marginLeft = "0";
      } else {
        sidebar.style.transition = "left 0.5s ease";
        document.querySelector(".content-wrapper1").style.transition = "margin 0.5s ease";
        sidebar.style.left = "0px";
        document.querySelector(".content-wrapper1").style.marginLeft = "255px";
      }
    }

    const mediaQuery = window.matchMedia("(max-width: 991px)");

    function handleMediaQueryChange(e) {
      if (e.matches) {
        document.querySelector(".main-sidebar1").style.transition = "left 0.5s ease";
        document.querySelector(".main-sidebar1").style.left = "-255px";
        document.querySelector(".content-wrapper1").style.transition = "margin 0.5s ease";
        document.querySelector(".content-wrapper1").style.marginLeft = "0";
      } else {
        document.querySelector(".main-sidebar1").style.transition = "left 0.5s ease";
        document.querySelector(".main-sidebar1").style.left = "0px";
        document.querySelector(".content-wrapper1").style.transition = "margin 0.5s ease";
        document.querySelector(".content-wrapper1").style.marginLeft = "255px";
      }
    }
    mediaQuery.addListener(handleMediaQueryChange);
    handleMediaQueryChange(mediaQuery);
  </script>

</body>

</html>
