<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"></i>Mindfulness掲示板</a>

  <ul class="navbar-nav ml-auto">
    @guest 
    <!-- ユーザー簡単ログイン機能 -->
    <form method="post" action="{{ route('login.guest') }}">
    @csrf
      <input type="hidden"  name="email" value="guest123@guest.jp">
      <input type="hidden"  name="password" value="okokokijijij">
      <button type="submit" class="btn btn-primary">ユーザー簡単ログイン</button>
    </form>
    <!-- 管理者簡単ログイン機能 -->
    <form method="post" action="{{ route('admin.guest') }}">
    @csrf
      <input type="hidden" name="email" value="adminguest@guest">
      <input type="hidden"  name="password" value="okokokijijij">
      <button type="submit" class="btn btn-primary">管理者簡単ログイン</button>
    </form>
     <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user-circle fa-3x"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="Top">Topページ</a> <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="{{ route('register') }}">ユーザー登録</a> 
          
        </button>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('login') }}">ログイン</a> 
      
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
      @csrf
    </form>
    <!-- Dropdown -->
    <!-- <li class="nav-item pt-2">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a> 
    </li>
    <li class="nav-item">
      <a class="nav-link pt-3" href="{{ route('login') }}">ログイン</a>
    </li> -->
    @endguest 
    
    <!--未ログインユーザーには非表示 -->
    @auth 
    <li class="nav-item mt-2">
      <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a>
    </li>
    @endauth 
    
    @auth 
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dropdown-item pt-2 mt-2" type="submit">
            ログアウト
          </button>
        </form>
    <!-- Dropdown -->
    @endauth 

  </ul>

</nav>