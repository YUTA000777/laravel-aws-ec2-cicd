<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> 管理者ページ </title>

     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">
</head>
<body>
        <nav class="navbar navbar-expand navbar-dark blue-gradient">

            <a class="navbar-brand" ></i>管理者画面</a>

            <ul class="navbar-nav ml-auto">

            @unless (Auth::guard('admin')->check())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('articles.index') }}">HOME</a> 
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.register') }}">管理者登録</a> 
            </li>
            
            <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.login') }}">ログイン</a>
            </li>
            @else 
            <!--未ログインユーザーには非表示 -->
            <form  method="POST" action="{{ route('admin.logout') }}"> 
                @csrf 
                <button  class="dropdown-item" type="submit">
                    ログアウト
                </button>
            </form>
            @endunless

            </ul>

        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>

<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
</body>
</html>