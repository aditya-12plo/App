<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
       <title>DRIVER</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

 


  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/dist/css/skins/_all-skins.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/plugins/iCheck/flat/blue.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/plugins/datepicker/datepicker3.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/plugins/daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('public/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
</head>
<body class="hold-transition skin-blue sidebar-mini">





<div class="wrapper" id="app">

  <header class="main-header">
    <!-- Logo -->
      <router-link to="/">
    <a class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>LINC</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>GROUP</b></span>
    </a>
     </router-link>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
       
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left info">
          <p align="center" color="white">{{Auth::guard('driver')->user()->username}}</p>
        </div>
      </div>
    
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header" align="center">MENU NAVIGATION</li>

        <li><a href="/driver#/"><i class="fa fa-circle-o text-red"></i><span>Dashboard </span></a></li>
        <li><a href="/driver#/order-list"><i class="fa fa-circle-o text-red"></i><span>Order List </span></a></li>
		<li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>User</span> <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a>
		<ul class="treeview-menu">
            <li><a href="/driver#/driver-profile"><i class="fa fa-circle-o"></i><span>Profile</span></a></li>
            <li><a href="{{ route('driver.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-circle-o"></i><span> Log Out</span></a></li>
          </ul>
		</li>

          	

		  <form id="logout-form" action="{{ route('driver.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 


  @yield('content-driver')

  
  





   
   
  </div>
  <!-- /.content-wrapper -->
   <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2017  All rights reserved.
  </footer>

 


</div>
<!-- ./wrapper -->

<script>
    window.Laravel =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
</script>

    <!-- Scripts -->
<script src="{{ asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('public/AdminLTE/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/knob/jquery.knob.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{ asset('public/AdminLTE/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('public/AdminLTE/plugins/fastclick/fastclick.js') }}"></script>
<script src="{{ asset('public/AdminLTE/dist/js/app.min.js') }}"></script>

</body>
</html>
