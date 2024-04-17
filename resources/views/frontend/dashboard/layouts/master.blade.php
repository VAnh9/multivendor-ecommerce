<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport"
  content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <title> @yield('title') </title>
  <link rel="icon" type="image/png" href="{{{ asset( $logoSettings->favicon )}}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/slick.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css')}}">

  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">
  <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">

  <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}">
  <!-- <link rel="stylesheet" href="css/rtl.css"> -->
</head>

<body>


  <!--=============================
    DASHBOARD MENU START
  ==============================-->
  <div class="wsus__dashboard_menu">
    <div class="wsusd__dashboard_user">
      <img src="{{ asset(Auth::user()->image) }}" alt="img" class="img-fluid">
      <p>{{ Auth::user()->name }}</p>
    </div>
  </div>
  <!--=============================
    DASHBOARD MENU END
  ==============================-->


  <!--=============================
    DASHBOARD START
  ==============================-->
    @yield('content')
  <!--=============================
    DASHBOARD START
  ==============================-->


  <!--============================
      SCROLL BUTTON START
    ==============================-->
  <div class="wsus__scroll_btn">
    <i class="fas fa-chevron-up"></i>
  </div>
  <!--============================
    SCROLL BUTTON  END
  ==============================-->


  <!--jquery library js-->
  <script src="{{ asset('frontend/js/jquery-3.6.0.min.js')}}"></script>
  <!--bootstrap js-->
  <script src="{{ asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
  <!--font-awesome js-->
  <script src="{{ asset('frontend/js/Font-Awesome.js')}}"></script>
  <!--select2 js-->
  <script src="{{ asset('frontend/js/select2.min.js')}}"></script>
  <!--slick slider js-->
  <script src="{{ asset('frontend/js/slick.min.js')}}"></script>
  <!--simplyCountdown js-->
  <script src="{{ asset('frontend/js/simplyCountdown.js')}}"></script>
  <!--product zoomer js-->
  <script src="{{ asset('frontend/js/jquery.exzoom.js')}}"></script>
  <!--nice-number js-->
  <script src="{{ asset('frontend/js/jquery.nice-number.min.js')}}"></script>
  <!--counter js-->
  <script src="{{ asset('frontend/js/jquery.waypoints.min.js')}}"></script>
  <script src="{{ asset('frontend/js/jquery.countup.min.js')}}"></script>
  <!--add row js-->
  <script src="{{ asset('frontend/js/add_row_custon.js')}}"></script>
  <!--multiple-image-video js-->
  <script src="{{ asset('frontend/js/multiple-image-video.js')}}"></script>
  <!--sticky sidebar js-->
  <script src="{{ asset('frontend/js/sticky_sidebar.js')}}"></script>
  <!--price ranger js-->
  <script src="{{ asset('frontend/js/ranger_jquery-ui.min.js')}}"></script>
  <script src="{{ asset('frontend/js/ranger_slider.js')}}"></script>
  <!--isotope js-->
  <script src="{{ asset('frontend/js/isotope.pkgd.min.js')}}"></script>
  <!--venobox js-->
  <script src="{{ asset('frontend/js/venobox.min.js')}}"></script>
  <!--classycountdown js-->
  <script src="{{ asset('frontend/js/jquery.classycountdown.js')}}"></script>

  <!--sweet alert js-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
  <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
  <!--main/custom js-->
  <script src="{{ asset('frontend/js/main.js')}}"></script>
  @stack('scripts')
</body>
<style>
  .field-required {
      color: red;
  }

  div.dt-container .dt-paging .dt-paging-button:hover,
  div.dt-container .dt-paging .dt-paging-button:active {
      background: linear-gradient(to bottom, #ffffff 0%, #ffffff 100%);
      border-color: transparent;
      box-shadow: none;
  }

  div.dt-container .dt-paging .dt-paging-button.disabled,
  div.dt-container .dt-paging .dt-paging-button.disabled:hover,
  div.dt-container .dt-paging .dt-paging-button.disabled:active {
      cursor: pointer;
  }

  table.dataTable thead>tr>th.dt-orderable-asc,
  table.dataTable thead>tr>th.dt-orderable-desc,
  table.dataTable thead>tr>td.dt-orderable-asc,
  table.dataTable thead>tr>td.dt-orderable-desc {
      text-align: left !important;
  }
</style>
</html>
