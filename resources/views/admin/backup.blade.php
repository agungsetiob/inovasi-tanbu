<!DOCTYPE HTML>
<html>
<head>
    <link
      rel="shortcut icon"
      href="{{url ('storage/logors.png')}}"
      type="image/x-icon"
    />
    <title>{{ config('app.title', 'dr. H. Andi Abdurrahman Noor') }}</title>
    <link href="{{ asset('css/error.css') }}" rel="stylesheet" type="text/css"  media="all" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Bangers">
</head>
<body class="error-page">
    <div class="content">
        <img src="{{ url('storage/success.png') }}"/>
        <p><span></span>{{ $success }}</p>
        <a href="{{ url('backup/') }}">Back</a>
    </div>
</body>
</html>