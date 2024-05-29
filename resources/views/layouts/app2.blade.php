<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Eco haulague</title>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">

        {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
          <span class="navbar-toggler-icon"></span>
        </button> --}}

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!-- Left Side Of Navbar -->
          <ul class="navbar-nav me-auto">

          </ul>

          <!-- Right Side Of Navbar -->
          <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest
              @if (Route::has('login'))
                <li class="nav-item">
                  <a style="font-family:verdana;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
              @endif

              @if (Route::has('register'))
                <li class="nav-item">
                  <a style="font-family:verdana;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
              @endif
            @else
              <li class="nav-item dropdown" onclick="toggleExpandElements();">
                <a id="navbarDropdown js-expand" class="nav-link dropdown-toggle" href="#" role="button"
                  data-bs-toggle="dropdown" aria-haspopup="true" style="position:relative; padding-left:50px;"
                  aria-expanded="false" v-pre>
                  <img src="/img/avatar5.png"
                    style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                  {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-right js-expand" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('/profile') }}">
                    {{ __('My Profile') }}
                  </a>

                  {{-- <a class="dropdown-item" href="{{ route('/logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a> --}}
                  <form action="/logout" method="POST">
                    @csrf
                    <a class="dropdown-item" href="#"
                      onclick="this.closest('form').submit();">Logout</a>
                  </form>

                </div>
              </li>
            @endguest
          </ul>
        </div>
      </div>
    </nav>

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
  </script>
</body>

</html>
