{{--@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))--}}

<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{url ('img/logo.png')}}"
      type="image/x-icon"
    />
    <title>401 - Unauthorized</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404.gif') }}" title="error" />
        <p><span></span>Unauthorized action</p>
        <a id="hulk-button" href="{{ url('/') }}">Back To Home</a>
    </div>
</body>
</html>
