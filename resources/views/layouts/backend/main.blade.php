<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'MyBlog')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/backend/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/backend/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/backend/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/backend/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="/backend/plugins/simplemde/simplemde.min.css">
  <link rel="stylesheet" href="/backend/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="/backend/css/jasny-bootstrap.min.css">
  <link rel="stylesheet" href="/backend/css/custom.css">

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
  @include('layouts.backend.navbar')
  @include('layouts.backend.sidebar')
  @yield('content')
  @include('layouts.backend.footer')
    

  </div>
  <!-- ./wrapper -->
  @include('layouts.backend.scripts')
  
</body>

</html>