<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{!empty($title)?$title : 'Admin'}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/datatables/dataTables.bootstrap.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/jstree/themes/default/style.css">
  @if(direction()=='ltr')
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/AdminLTE.min.css">
  @else
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/rtl/AdminLTE.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/rtl/bootstrap-rtl.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/rtl/profile.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/rtl/rtl.css">
  <!--<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/dist/css/rtl/fonts/fonts-fa.css">-->
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet">
  @endif
  <!--noty--->
<script src="{{ url('/') }}/design/adminlte/plugins/noty/noty.min.js"></script>
<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/plugins/noty/noty.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.css" integrity="sha256-p+PhKJEDqN9f5n04H+wNtGonV2pTXGmB4Zr7PZ3lJ/w=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/noty/3.1.4/noty.js" integrity="sha256-xzc5zu2WQtJgvCwRGTXiHny3T+KQZa6tQF24RVDRlL0=" crossorigin="anonymous"></script>
  <!--end noty--->
  <!--ckeditor--->
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
  <!--end ckeditor--->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.ar.min.js" integrity="sha256-vD9WYCbX6KHkTILwXbQcOzekg2m9m08MoQctbiuEZYU=" crossorigin="anonymous"></script>

  <!--datepicker--
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha256-bqVeqGdJ7h/lYPq6xrPv/YGzMEb6dNxlfiTUHSgRCp8=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ url('/') }}/design/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css">
  end datepicker--->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
  html,body{
    font-family: 'Cairo', sans-serif;
  }
  .bu,.btn-space{
    margin: 5px;
  }
  .dt-button{
    border-radius: 20px;
  }
</style>


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
