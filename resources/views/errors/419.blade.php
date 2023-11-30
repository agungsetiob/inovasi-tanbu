{{--@extends('errors::minimal')

@section('title', __('Page Expired'))
@section('code', '419')
@section('message', __('Page Expired'))--}}
<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{url ('storage/logors.png')}}"
      type="image/x-icon"
    />
    <title>419 - Page Expired</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404.gif') }}" title="error" />
        <p><span></span>Page Expired</p>
        <a id="hulk-button" href="{{ url('/') }}">Back To Home</a>
    </div>
</body>
</html>
