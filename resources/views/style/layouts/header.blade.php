<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora Demo</title>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('/') }}/design/style/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('/') }}/design/style/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ url('/') }}/design/style/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ url('/') }}/design/style/style.css">
    <link rel="stylesheet" href="{{ url('/') }}/design/style/css/responsive.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

@if(direction()=='rtl')
    <!-- compiled and minified CSS -->
<link 
  rel="stylesheet"
  href="https://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap.min.css"
  integrity="sha384-cSfiDrYfMj9eYCidq//oGXEkMc0vuTxHXizrMOFAaPsLt1zoCUVnSsURN+nef1lj"
  crossorigin="anonymous">
<!-- compiled and minified theme CSS -->
<link
  rel="stylesheet"
  href="https://cdn.rtlcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
  integrity="sha384-YNPmfeOM29goUYCxqyaDVPToebWWQrHk0e3QYEs7Ovg6r5hSRKr73uQ69DkzT1LH"
  crossorigin="anonymous">

<!-- compiled and minified JavaScript -->
<script
  src="https://cdn.rtlcss.com/bootstrap/3.3.7/js/bootstrap.min.js"
  integrity="sha384-B4D+9otHJ5PJZQbqWyDHJc6z6st5fX3r680CYa0Em9AUG6jqu5t473Y+1CTZQWZv"
  crossorigin="anonymous"></script>
  @endif


<link rel="icon"  href="{{Storage::url(setting()->icon)}}">
  </head>
  <body>
   