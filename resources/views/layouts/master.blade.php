
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{trans('user.site_title')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Your page description here" />
    <meta name="author" content="" />

    <!-- css -->
    <link href="{{url('/')}}/https://fonts.googleapis.com/css?family=Handlee|Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="{{url('/')}}/css/bootstrap.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/bootstrap-responsive.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/flexslider.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/prettyPhoto.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/camera.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/jquery.bxslider.css" rel="stylesheet" />
    <link href="{{url('/')}}/css/style.css" rel="stylesheet" />

    <!-- Theme skin -->
    <link href="{{url('/')}}/color/default.css" rel="stylesheet" />

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{url('/')}}/ico/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{url('/')}}/ico/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{url('/')}}/ico/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="{{url('/')}}/ico/apple-touch-icon-57-precomposed.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    <link rel="shortcut icon" href="{{url('/')}}/ico/favicon.png" />

    <!-- =======================================================
      Theme Name: Eterna
      Theme URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
      Author: BootstrapMade.com
      Author URL: https://bootstrapmade.com
    ======================================================= -->
</head>

<body>

<div id="wrapper">

    <!-- start header -->
    <header>
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="span6">
                        <p class="topcontact"><i class="icon-phone"></i> +20 010 13924210 & +20 010 27 186578</p>
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest

                                    <a class="nav-link"  style=" color: #f5f5f5;" href="{{ route('login') }}">{{ __('Login') }}</a>

                                @if (Route::has('register'))

                                        <a class="nav-link "  style=" color: #f5f5f5;" href="{{ route('register') }}">{{ __('Register') }}</a>

                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="" href="#" style=" color: #f5f5f5;" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item"style=" color: #f5f5f5;" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                    </div>   </ul>

                    <div class="span6">

                        <ul class="social-network">
                            <li><a href="#" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Linkedin"><i class="icon-linkedin icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Pinterest"><i class="icon-pinterest  icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Google +"><i class="icon-google-plus icon-white"></i></a></li>
                            <li><a href="#" data-placement="bottom" title="Dribbble"><i class="icon-dribbble icon-white"></i></a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">


            <div class="row nomargin">
                <div class="span4">
                    <div class="logo">
                        <a href="{{url('/home')}}">{{trans('user.logo')}}</a>
                    </div>
                </div>
                <div class="span8">
                    <div class="navbar navbar-static-top">
                        <div class="navigation">
                            <nav>
                                <ul class="nav topnav">
                                    <li class="active">
                                        <a href="{{url('/home')}}"><i class="icon-home"></i> {{trans('user.home')}} </a>

                                    </li>

                                    <li class="dropdown">
                                        <a href="#">{{trans('user.pages')}} <i class="icon-angle-down"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{url('/')}}">About us</a></li>
                                            <li><a href="{{url('/home')}}">{{trans('user.home')}}</a></li>

                                        </ul>
                                    </li>

                                    <li class="lang dropdown">
                                        <a href="#">{{trans('user.languages')}}<i class="icon-globe"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ url('lang/ar') }}"><i class="icon-flag"></i> عربى</a></li>
                                            <li><a href="{{ url('lang/en') }}"><i class="icon-flag"></i> English</a></li>
                                        </ul>
                                    </li>

                                    </li>
                                </ul>

                            </nav>
                        </div>
                        <!-- end navigation -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- end header -->

</div>

    <main class="py-4">
        @yield('content')

        @include('layouts.footer')
        @yield('javascript')
    </main>


</body>
</html>
