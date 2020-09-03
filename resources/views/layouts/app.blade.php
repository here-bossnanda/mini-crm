<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <title>
    @section('title')
    MINI CRM - ADMIN
    @show
  </title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta content="Mini CRM" name="description" />
  <meta content="@bossnanda" name="author" />

  <!-- App favicon -->
  <link rel="icon" href="{{URL::asset('storage/assets/images/logo-crm.svg')}}" type="image/x-icon">
  
  @include('layouts.parts.head-script')

@yield('style')
</head>
<body data-topbar="colored">
  <!-- Begin page -->
  <div id="layout-wrapper">
    @include('layouts.parts.header')
    @include('layouts.parts.sidebar')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

      <div class="page-content">
        @yield('content')

        @include('layouts.parts.footer')

      </div>
      <!-- end page-content-wrapper -->
    </div>
    <!-- End Page-content -->
  </div>
  <!-- end main content-->
</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
@include('layouts.parts.footer-script')
  
</body>
</html>
