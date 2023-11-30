{{--@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))--}}

<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{url ('img/logo.png')}}"
      type="image/x-icon"
    />
    <title>403 - Forbidden</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/hulk-404.gif') }}" title="error" />
        <p><span></span>Forbidden access</p>
        <a id="hulk-button" href="{{ url('/') }}">Back To Home</a>
    </div>
</body>
</html>
