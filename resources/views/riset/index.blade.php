@extends('layouts.riset-menus')
@section('content')
<!-- Begin Page Content -->
@fragment('dashboard')
            <div class="container-fluid slide-it" id="app" hx-history="false">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-dark">Dashboard Riset</h1>
                </div>
                <!-- Content Row -->
                <ul class="list-group mb-4">
                    <li class="list-group-item">
                        <h4 class="mb-2"><a class="text-warning" href="#">Python is a versatile, high-level programming</a></h4>
                        <p>Python is a versatile, high-level programming language known for its readability and ease of use. It is widely used in web development, data science, artificial intelligence, and more.</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="mb-2"><a href="#">JavaScript is a dynamic scripting language commonly</a></h4>
                        <p>JavaScript is a dynamic scripting language commonly used for building interactive web pages. It runs in the browser and allows for client-side scripting, making web applications dynamic and responsive.</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="mb-2"><a href="#">Java is a versatile, object-oriented programming</a></h4>
                        <p>Java is a versatile, object-oriented programming language known for its portability and platform independence. It is widely used for developing enterprise-level applications and Android mobile apps.</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="mb-2"><a href="#">C# (pronounced C sharp) is a modern</a></h4>
                        <p>C# (pronounced C sharp) is a modern, object-oriented programming language developed by Microsoft. It is commonly used for building Windows applications, web applications using ASP.NET, and game development with Unity.</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="mb-2"><a href="#">Ruby is a dynamic, object-oriented programming</a></h4>
                        <p>Ruby is a dynamic, object-oriented programming language designed for simplicity and productivity. It is commonly used for web development with the Ruby on Rails framework, known for its elegant syntax and conventions.</p>
                    </li>
                    <li class="list-group-item">
                        <h4 class="mb-2"><a href="#">Ruby is a dynamic, object-oriented programming</a></h4>
                        <p>Ruby is a dynamic, object-oriented programming language designed for simplicity and productivity. It is commonly used for web development with the Ruby on Rails framework, known for its elegant syntax and conventions.</p>
                    </li>
                </ul>
            </div>
@endfragment
@endsection