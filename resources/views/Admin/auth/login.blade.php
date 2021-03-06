@extends('layouts.admin.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">管理者ログイン</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required>
                </div>

                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>

                <!-- 自動ログイン。onとすることで常にチェック状態にする -->
                <input type="hidden" name="remember" id="remember" value="on">

                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">ログイン</button>

              </form>

              <div class="mt-0">
                <a href="{{ route('admin.register') }}" class="card-text">管理者登録</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
