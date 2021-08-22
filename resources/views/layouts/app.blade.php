<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

   

    <title>@yield('title')</title>

    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
    
        var pusher = new Pusher('a822a5373fe618070fd3', {
          cluster: 'eu'
        });
    
        var channel = pusher.subscribe('chat');
        channel.bind('message-sent', function(data) {
          alert(JSON.stringify(data));
        });
      </script> --}}

    <!-- Scripts -->
    {{-- <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' =>  auth()->user()
        ]) !!};
        var fetchChatURL = null;
    </script> --}}
    
        {{-- <script src="{{ asset('js/bootstrap.js') }}" defer></script> --}}
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   {{-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        </script> --}}

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link  href="/css/main.css" rel="stylesheet" type="text/css" >
   {{-- <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --> --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/feed') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    Tom Net
                </a>
               <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
                @yield('title')
                <div class="navbar-div" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                  

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <ul class='navbar-nav'>
                               <!-- <li>
                                <a  href="#" role="button" >
                                    {{ Auth::user()->name }}
                                </a>
                                </li>-->

                               <li> <a class='nav-link' href="{{ url('/profile') }}">Profile</a></li>
                               <li> <a class='nav-link' href="{{ url('/feed') }}">Feed</a> </li>
                               <li> <a class='nav-link' href="{{ url('/chats') }}">Chats</a> </li>

                                <li>
                                    <a class='nav-link'  href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{-- {{ __('Logout') }} --}}Logout
                                    </a>
                                    

                                    <form  id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li> 
                            </ul>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="@yield('title') py-4">
            @yield('content')
        </main>

        <footer>


        </footer>
    </div>
</body>


<script src="{{ asset('js/app.js') }}" ></script>
<script> 



// window.Echo.channel('test')
// .listen('.TestEvent', (e) => {
//     console.log(e)
//     console.log('hi')
// })

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script type='module' src='js/main.js'></script>
  
</html>
