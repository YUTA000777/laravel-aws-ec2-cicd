@extends('layouts.admin.app')

@section('title', '管理者登録')

@section('content')
  <div class="container">
    <div class="row">
      <div class="mx-auto col col-12 col-sm-11 col-md-9 col-lg-7 col-xl-6">
        <div class="card mt-3">
          <div class="card-body text-center">
            <h2 class="h3 card-title text-center mt-2">管理者登録</h2>

            @include('error_card_list')

            <div class="card-text">
              <form method="POST" action="{{ route('admin.register') }}">
                @csrf
                <div class="md-form">
                  <label for="name">ユーザー名</label>
                  <input class="form-control" type="text" id="name" name="name" required value="{{ old('name') }}">
                  <small>英数字3〜16文字(登録後の変更はできません)</small>
                </div>
                <div class="md-form">
                  <label for="email">メールアドレス</label>
                  <input class="form-control" type="text" id="email" name="email" required value="{{ old('email') }}" >
                </div>
                <div class="md-form">
                  <label for="password">パスワード</label>
                  <input class="form-control" type="password" id="password" name="password" required>
                </div>
                <div class="md-form">
                  <label for="password_confirmation">パスワード(確認)</label>
                  <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button class="btn btn-block blue-gradient mt-2 mb-2" type="submit">管理者登録</button>
              </form>

              <div class="mt-0">
                <a href="{{ route('admin.login') }}" class="card-text">ログインはこちら</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection