<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sellon</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=" {{ url('/') }} ">Sellon</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href=" {{ url('/') }}">Home</a></li>
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            @if(isset($user))
            <li class="dropdown">
              <a href="#", class="dropdown-toggle" data-toggle="dropdown">{{ $user->getUsername(); }}<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('profile'); }}">Profile</a></li>
                <li><a href="{{ url('logout'); }}">Log out</a></li>
              </ul>
            </li>
            </a>
            @else
            <li><a href="{{ url('login')}}">Log in</a></li>
            @endif
          </ul>
        </div>
      </div>
    </div> <!-- /navbar -->

    <div class="container">
      @yield('body')
    </div> <!-- /container -->

    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>
