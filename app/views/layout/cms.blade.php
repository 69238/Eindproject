<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tv-Me</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="http://69238.lux.ict-lab.nl/">
                        Tv-Me Cms
                    </a>
                </li>
                <li class="drop">
                        <a href="#">Producten<span class="caret"></span></a>
                    <ul>
                        <li>
                            <a href="http://69238.lux.ict-lab.nl/cms/product">Overzicht</a>
                        </li>
                        <li>
                            <a href="http://69238.lux.ict-lab.nl/producten/create">Create</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/main.js') }}"></script>
    </footer>
</body>

</html>
