<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Album example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/album.css" rel="stylesheet">

</head>

<body>

<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a href="{{ route('/') }}" class="navbar-brand d-flex align-items-center">
            <strong>У Ашота</strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-item text-left" href="{{ route('menu') }}">Menu <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav">
                {{--<li class="nav-item">
                    <a class="nav-item text-right" href="{{ route('menu') }}">Some text <span class="sr-only">(current)</span></a>
                </li>--}}
                <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li class="{{ Request::is('login')?'active':'' }}"><a href="{{ route('login') }}">Login</a></li>
                        {{--<li class="{{ Request::is('register')?'active':'' }}"><a href="{{ route('register') }}">Register</a></li>--}}
                    @else
                        <li class="dropdown my-username">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
            </ul>
        </div>
    </nav>
</header>

<section class="jumbotron text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="jumbotron-heading banner-name">Restaurant "У Ашота"</h2>
                <p class="lead text-muted">Get fat in our little Restaurant</p>
                <hr>
            </div>
        </div>
    </div>
</section>


@yield('content')

<footer class="text-muted">
    <div class="container">
        <p class="float-right">
            <a href="#">Back to top</a>
        </p>
    </div>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/js/jquery-slim.min.js"><\/script>')</script>
<script src="/js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/holder.min.js"></script>
</body>
</html>
