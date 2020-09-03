<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Login | Mini CRM</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Mini CRM" name="description" />
  <meta content="@bossnanda" name="author" />

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'MINI-CRM') }}</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{asset('storage/assets/images/logo-crm.svg')}}">

  @include('layouts.auth.header-script')

</head>

<body class="theme-blue">


      @yield('content')
  <!-- end Account pages -->

  <!-- JAVASCRIPT -->
  @include('layouts.auth.footer-script')
</body>

</html>
