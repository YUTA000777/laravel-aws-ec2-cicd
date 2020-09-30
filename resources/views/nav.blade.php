<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"></i>Mindfulness掲示板</a>

  <ul class="navbar-nav ml-auto">
    <a class="navbar-brand mt-2" href="{{ route('Top') }}"><i class="fas fa-desktop mr-2 mt-1"></i>Topページ</a>
    @guest 
    <li class="nav-item pt-2">
      <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a> 
    </li>
    <li class="nav-item">
      <a class="nav-link pt-3" href="{{ route('login') }}">ログイン</a>
    </li>
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