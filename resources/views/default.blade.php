<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta name="description" content="Miminium Admin Template v.1">
	<meta name="author" content="Isna Nur Azis">
	<meta name="keyword" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ (isset($title))?$title:"404 Not Found"}}</title>
 
    <!-- start: Css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/bootstrap-tagsinput.css') }}">

      <!-- plugins -->
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/font-awesome.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/datatables.bootstrap.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/simple-line-icons.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/animate.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/fullcalendar.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/select2.min.css') }}"/>
      <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/plugins/bootstrap-material-datetimepicker.css') }}"/>
	<link href="{{ asset('asset/css/style.css') }}" rel="stylesheet">
	<!-- end: Css -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

 <body id="mimin" class="dashboard">
 <!-- start: Header -->
        <nav class="navbar navbar-default header navbar-fixed-top">
          <div class="col-md-12 nav-wrapper">
            <div class="navbar-header" style="width:100%;">
              <!-- <div class="opener-left-menu is-open">
                <span class="top"></span>
                <span class="middle"></span>
                <span class="bottom"></span>
              </div> -->
                <a href="{{url('/profile')}}" class="navbar-brand"> 
                 Online Portal
                </a>

              <ul class="nav navbar-nav navbar-right user-nav">
                <li class="user-name"><span>{{$auth->username}}</span></li>
                  <li class="dropdown avatar-dropdown">
                  @if($auth->role->permission == 25)
                  <img src="{{ url('/').'/asset/img/male.png' }}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                  @else
                   <img src="{{ $auth->profile->imgloc($auth->profile->id) }}" class="img-circle avatar" alt="user name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                   @endif
                   <ul class="dropdown-menu user-dropdown">
                    @if($auth->role->permission != 25)
                     <li><a href="{{ url('profile') }}"><span class="fa fa-user"></span> My Profile</a></li>
                     @endif
                     <li><a href="{{ url('profile/setting') }}"><span class="fa fa-cogs"></span> Setting</a></li>
                     <li><a href="{{ url('auth/logout') }}"><span class="fa fa-power-off"></span> Logout</a></li>
                     
                    
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      <!-- end: Header -->
      <div class="container-fluid mimin-wrapper">
 @include('nav')
 @yield('content')

<!-- start: Javascript -->
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.ui.min.js') }}"></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
   
    
    <!-- plugins -->
    <script src="{{ asset('asset/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/datatables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/chart.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/icheck.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/mediaelement-and-player.min.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('asset/js/plugins/select2.full.min.js') }}"></script>


    <!-- custom -->
     <script src="{{ asset('asset/js/main.js') }}"></script>
     <script type="text/javascript">
      $(document).ready(function(){
        $('#datatables-example').DataTable();
      });
     </script>
  <!-- end: Javascript -->

  <!-- custom -->
<script src="{{ asset('asset/js/main.js') }}"></script>
<script type="text/javascript">
  // $(document).ready(function(){
 //   $('input').iCheck({
 //    checkboxClass: 'icheckbox_flat-red',
 //    radioClass: 'iradio_flat-red'
 //  });
 //   $('video,audio').mediaelementplayer({
 //            alwaysShowControls: true,
 //            videoVolume: 'vertical',
 //            features: ['playpause','progress','volume','fullscreen']
 //          });
 // });
</script>
<!-- end: Javascript -->


@yield('js')
  </body>
</html>