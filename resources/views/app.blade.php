<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="description" content="Miminium Admin Template v.1">
  <meta name="author" content="Isna Nur Azis">
  <meta name="keyword" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/bootstrap.min.css')}}">

  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/plugins/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/plugins/simple-line-icons.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/plugins/animate.min.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('asset/css/plugins/icheck/skins/flat/aero.css')}}"/>
  <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
  <!-- end: Css -->

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>

    <body id="mimin" class="dashboard form-signin-wrapper">
    @yield('content')
    <!-- end: Content -->
      <!-- start: Javascript -->
      <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
      <script src="{{ asset('asset/js/jquery.ui.min.js') }}"></script>
      <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>

      <script src="{{ asset('asset/js/plugins/moment.min.js') }}"></script>
      <script src="{{ asset('asset/js/plugins/icheck.min.js') }}"></script>

      <!-- custom -->
      <script src="{{ asset('asset/js/main.js') }}"></script>
      <script type="text/javascript">
       $(document).ready(function(){
         $('input').iCheck({
          checkboxClass: 'icheckbox_flat-aero',
          radioClass: 'iradio_flat-aero'
        });
       });
     </script>
     <!-- end: Javascript -->
   </body>
   </html>