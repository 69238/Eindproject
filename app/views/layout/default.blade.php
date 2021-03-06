<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tv-Me</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <!--@yield('page')!-->
  <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Tv-Me</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://69238.lux.ict-lab.nl/">Home</a></li>
            <li><a href="http://69238.lux.ict-lab.nl/producten">Producten</a></li>
            @if(Auth::check())
              <li><a href="http://69238.lux.ict-lab.nl/users/overzicht">Profile</a></li>
              <li><a href="http://69238.lux.ict-lab.nl/cart">Cart</a></li>
              <li><a href="http://69238.lux.ict-lab.nl/sessions/logout">Log out</a></li>
            @else
              <li><a href="http://69238.lux.ict-lab.nl/sessions/login">Login</a></li>
              <li><a href="http://69238.lux.ict-lab.nl/users/create">Register</a></li>
            @endif

            @if(Auth::check())
              @if(Auth::user()->isAdmin())
                <li><a href="http://69238.lux.ict-lab.nl/cms">CMS</a></li>
              @endif
            @endif
            <!--<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>!-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <div class="container theme-showcase" role="main">
      <!-- Main jumbotron for a primary marketing message or call to action -->
     <!-- <div class="jumbotron">
        @yield('contenttop')
      </div>!-->
      @yield('content')
    </div>
    @yield('footer')
    <footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    </footer>
  </body>
</html>