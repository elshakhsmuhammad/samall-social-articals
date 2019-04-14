@extends('layouts.master')
@section('content')










    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
            <div class="top-right links">
                @auth
                    <li class="active">
                        <a href="{{url('/home')}}"><i class="icon-home"></i> {{trans('user.home')}} </a>

                    </li>
                    <!-- section featured -->
                    <section id="featured">

                        <!-- slideshow start here -->

                        <div class="camera_wrap" id="camera-slide">

                            <!-- slide 1 here -->
                            <div data-src="img/slides/camera/slide1/img1.jpg">
                                <div class="camera_caption fadeFromLeft">
                                    <div class="container">
                                        <div class="row">
                                            <div class="span6">
                                                <h2 class="animated fadeInDown"><strong>Great template for <span class="colored">multi usage</span></strong></h2>
                                                <p class="animated fadeInUp"> Vim porro dicam reprehendunt te, populo quodsi dissentiet cum ad. Ne natum deseruisse vis. Iisque deseruisse sententiae mel ne, dolores appetere vim ut. Sea no tamquam reprimique.</p>
                                                <a href="#" class="btn btn-success btn-large animated fadeInUp">
                                                    <i class="icon-link"></i> Read more
                                                </a>
                                                <a href="#" class="btn btn-theme btn-large animated fadeInUp">
                                                    <i class="icon-download"></i> Download
                                                </a>
                                            </div>
                                            <div class="span6">
                                                <img src="img/slides/camera/slide1/screen.png" alt="" class="animated bounceInDown delay1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- slide 2 here -->
                            <div data-src="img/slides/camera/slide2/img1.jpg">
                                <div class="camera_caption fadeFromLeft">
                                    <div class="container">
                                        <div class="row">
                                            <div class="span6">
                                                <img src="img/slides/camera/slide2/iMac.png" alt="" />
                                            </div>
                                            <div class="span6">
                                                <h2 class="animated fadeInDown"><strong>Put your <span class="colored">Opt in form</span></strong></h2>
                                                <p class="animated fadeInUp"> Vim porro dicam reprehendunt te, populo quodsi dissentiet cum ad. Ne natum deseruisse vis. Iisque deseruisse sententiae mel ne, dolores appetere vim ut. Sea no tamquam reprimique.</p>
                                                <form>
                                                    <div class="input-append">
                                                        <input class="span3 input-large" type="text">
                                                        <button class="btn btn-theme btn-large" type="submit">Subscribe</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- slide 3 here -->
                            <div data-src="img/slides/camera/slide2/img1.jpg">
                                <div class="camera_caption fadeFromLeft">
                                    <div class="container">
                                        <div class="row">
                                            <div class="span12 aligncenter">
                                                <h2 class="animated fadeInDown"><strong><span class="colored">Responsive</span> and <span class="colored">cross broswer</span> compatibility</strong></h2>
                                                <p class="animated fadeInUp">Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                                                <img src="img/slides/camera/slide3/browsers.png" alt="" class="animated bounceInDown delay1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- slideshow end here -->

                    @else
                                <div class="row col-lg-9">

                                    <div class="offset-lg-1 span9">

                                        <h4>{{trans('user.jone_us')}}</h4>
                                        <div class="tabs">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#one" data-toggle="tab"><i class="icon-users"></i> {{trans('user.login')}}</a></li>
                                                <li><a href="#two" data-toggle="tab"><i class="icon-users border-danger"></i>{{trans('user.register')}}</a></li>

                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="one">
                                                    <!---login form-->
                                                    <form method="POST" action="{{ route('login') }}">
                                                        <div class="row controls">
                                                           {{csrf_field()}}
                                                            <div class="span3 control-group">
                                                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                     @if ($errors->has('email'))
                          <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="span3 control-group">
                                                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                                <div class="col-md-6">
                                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        <div class="span3 control-group">
                                                            <div class="col-md-6 offset-md-4">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                                    <label class="form-check-label" for="remember">
                                                                        {{ __('Remember Me') }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                            <div class="span3">
                                                                <div class="col-md-8 offset-md-4">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Login') }}
                                                                    </button>

                                                                    @if (Route::has('password.request'))
                                                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                            {{ __('Forgot YourPassword?') }}
                                                                      </a>
                                                                    @endif
                                                              </div>
                                                            </div>
                                                      </div>
                                                    </form>
                                              </div>

                                            <div class="tab-pane" id="two">
                                                <p>
                                                    Tale dolor mea ex, te enim assum suscipit cum, vix aliquid omittantur in. Duo eu cibo dolorum menandri, nam sumo dicit admodum ei. Ne mazim commune honestatis cum, mentitum phaedrum sit et.
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                @endauth
            </div>
        @endif


    </div>







    @endsection