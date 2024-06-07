<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<!-- Head -->

<head>
  <!-- Page Meta Tags-->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Website is made for final year project of Normand Lubaton" />
  <meta name="author" content="Normand Lubaton" />
  <meta name="keywords" content="IMS" />

  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">
  <link rel="mask-icon" href="{{ asset('assets/images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!-- Google Font-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="/resource/css/theme.bundle.css">
  <link rel="stylesheet" href="/resource/css/theme.bundle.css">
  <script src="/resource/js/app.js"></script>

  <!-- Fix for custom scrollbar if JS is disabled-->
  <noscript>
    <style>
      /**
          * Reinstate scrolling for non-JS clients
          */
      .simplebar-content-wrapper {
        overflow: auto;
      }
    </style>
  </noscript>

  <!-- Page Title -->
  <title>{{ config('app.name', 'Laravel') }}</title>

</head>

<body class="">

  @include('layouts.partials.navbar')

  <!-- Page Content -->
  <main id="main">

    @include('layouts.partials.breadcrumb')

    {{ $slot }}

  </main>
  <!-- /Page Content -->
  @include('layouts.partials.compCart')
  @include('layouts.partials.asides')

  <script src="/resource/js/theme.bundle.js"></script>
  <script src="/resource/js/vendor.bundle.js"></script>
  <script src="/resource/js/comparison.js"></script>

</body>

</html>