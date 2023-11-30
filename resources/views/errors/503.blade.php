{{--@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))--}}

<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{url ('storage/logors.png')}}"
      type="image/x-icon"
    />
    <title>503 - Service Unavailable</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404.gif') }}" title="error" />
        <p><span></span>Service Unavailable</p>
        <a id="hulk-button" href="{{ url('/') }}">Back To Home</a>
    </div>
</body>
</html>
