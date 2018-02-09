<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
	<!-- Scripts -->
	<script src="{{ asset('assets/js/modernizr.min.js') }}"></script>
	<script>
            var resizefunc = [];
    </script>
	<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/js/detect.js') }}"></script>
	<script src="{{ asset('assets/js/fastclick.js') }}"></script>

	<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
	<script src="{{ asset('assets/js/waves.js') }}"></script>
	<script src="{{ asset('assets/js/wow.min.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>

	<script src="{{ asset('assets/plugins/peity/jquery.peity.min.js') }}"></script>

	<!-- jQuery  -->
	<script src="{{ asset('assets/plugins/waypoints/lib/jquery.waypoints.js') }}"></script>
	<script src="{{ asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>



	<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/raphael/raphael-min.js') }}"></script>

	<script src="{{ asset('assets/plugins/jquery-knob/jquery.knob.js') }}"></script>

	<script src="{{ asset('assets/pages/jquery.dashboard.js') }}"></script>

	

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.counter').counterUp({
				delay: 100,
				time: 1200
			});

			$(".knob").knob();

		});
	</script>
	@yield('extra')
</head>
<body class="fixed-left">
    <div id="wrapper">
	
	<div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.html" class="logo">{{ config('app.name', 'Laravel') }}</a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li><a href="javascript:void(0);" class="waves-effect waves-light">Files</a></li>
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </li>
                            </ul>



                            <ul class="nav navbar-nav navbar-right pull-right">
							@guest
								<li><a href="{{ route('login') }}">Login</a></li>
								<li><a href="{{ route('register') }}">Register</a></li>
							@else
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                                        <i class="icon-bell"></i> <span class="badge badge-xs badge-danger">3</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-lg">
                                        <li class="notifi-title"><span class="label label-default pull-right">New 3</span>Notification</li>
                                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 230px;"><li class="list-group slimscroll-noti notification-list" style="overflow: hidden; width: auto; height: 230px;">
                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-bell-o noti-custom"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">Updates</h5>
                                                    <p class="m-0">
                                                        <small>There are <span class="text-primary font-600">2</span> new updates available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-user-plus noti-pink"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New user registered</h5>
                                                    <p class="m-0">
                                                        <small>You have 10 unread messages</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                            <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-diamond noti-primary"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">A new order has been placed A new order has been placed</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>

                                           <!-- list item-->
                                           <a href="javascript:void(0);" class="list-group-item">
                                              <div class="media">
                                                 <div class="pull-left p-r-10">
                                                    <em class="fa fa-cog noti-warning"></em>
                                                 </div>
                                                 <div class="media-body">
                                                    <h5 class="media-heading">New settings</h5>
                                                    <p class="m-0">
                                                        <small>There are new settings available</small>
                                                    </p>
                                                 </div>
                                              </div>
                                           </a>
                                        </li><div class="slimScrollBar" style="background: rgb(152, 166, 173); width: 5px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                                        <li>
                                            <a href="javascript:void(0);" class="list-group-item text-right">
                                                <small class="font-600">See all notifications</small>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                        <li class="divider"></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
										</li>
                                    </ul>
                                </li>
								
							@endguest
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
	
	
	
	
	
	
	
	
	
		<div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
							<li class="has_sub">
                                <a href="{{URL::route('themes.index')}}" class="waves-effect"><i class="ti-files"></i><span> Themes </span> <span class="menu-arrow"></span></a>
                            </li>
							<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i><span> Options </span> <span class="menu-arrow"></span></a>
								<ul class="list-unstyled">
                                    <li><a href="{{ route('settings.header') }}">Header</a></li>
									<li><a href="{{ route('menu.index') }}">Menu</a></li>
                                    <li><a href="{{ route('settings.fonts') }}">Fonts</a></li>
                                    <li><a href="{{ route('settings.colors') }}">Colors</a></li>
                                    <li><a href="{{ route('settings.footer') }}">Footer</a></li>
                                </ul>
                            </li>
                            <li class="has_sub">
                                <a href="{{URL::route('pages.index')}}" class="waves-effect"><i class="ti-files"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                            </li>
							<li class="has_sub">
                                <a href="" class="waves-effect"><i class="ti-files"></i><span> Settings </span> <span class="menu-arrow"></span></a>
                            </li>
                        </ul>
				</div>
			</div>
		</div>	
	
	
	
	
	
		<div class="content-page">
			<div class="content">
				@yield('content')
			</div>
		</div>
    </div>
	@yield('footerextra')
	<script src="{{ asset('assets/js/jquery.core.js') }}"></script>
	<script src="{{ asset('assets/js/jquery.app.js') }}"></script>
</body>
</html>
