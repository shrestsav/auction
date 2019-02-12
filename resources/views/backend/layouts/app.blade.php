<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Auction | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
  {{-- Select 2 --}}
  <link rel="stylesheet" href="{{ asset('backend/css/select2.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/css/AdminLTE.min.css') }}">
  {{-- Theme Color CSS --}}
  <link rel="stylesheet" href="{{ asset('backend/css/skin-purple.min.css') }}">
  {{-- CUSTOM CSS BY SHRESTSAV --}}
  <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">

  

  @stack('styles')

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-purple sidebar-mini {{Session::get('theme_sidebar')}}">
  <div class="wrapper">

    <header class="main-header">
      @include('backend.layouts.includes.header')
    </header>


    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      @include('backend.layouts.includes.sidebar');
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          {{$title}}
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">{{$title}}</li>
        </ol>
      </section>
      @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0
      </div>
      <strong>Copyright &copy; 2019-2022</strong> All rights
      reserved.
    </footer>

    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('backend/js/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('backend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('backend/js/select2.full.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);

// SET AJAX CSRF TOKEN
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });


  // if(localStorage.getItem("sidebar_state")==null)
  //   $('body').addClass('skin-purple sidebar-collapse sidebar-mini');
  // else
  //   $('body').addClass(localStorage.getItem("sidebar_state"));

  

  $(function () {
      $('.select2').select2();
  });


  $('.sidebar-toggle').on('click',function(){
    if($('body').hasClass("sidebar-collapse")){
      sidebar_state='';
    }
    else{
      sidebar_state='sidebar-collapse';
    }
    
    $.ajax({
      url: "{{ url('/set_sidebar') }}",
      method: 'post',
      data: {
         id: '{{ Auth::user()->id }}',
         theme_sidebar: sidebar_state
      },
      success: function(response){
         console.log(response);
      }
    });



  });

</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/js/adminlte.min.js') }}"></script>

@stack('scripts')

</body>
</html>
