<?php

Auth::routes();

//Topページ
Route::get('/Top', 'HomeController@index')->name('Top');

//一覧画面のURLを'/'で統一させる
//新規登録後ログイン後はこちらのルートを使用
Route::get('/', 'ArticleController@index')->name('articles.index');

//投稿のルーティング
Route::resource('/articles', 'ArticleController')->except(['index', 'show'])->middleware('auth');
Route::resource('/articles', 'ArticleController')->only(['show']);

//非同期処理のルーティング
Route::prefix('articles')->name('articles.')->group(function () {
    Route::put('/{article}/like', 'ArticleController@like')->name('like')->middleware('auth');
    Route::delete('/{article}/like', 'ArticleController@unlike')->name('unlike')->middleware('auth');
});

//コメントに関するルーティング
Route::resource('/comments', 'CommentsController');

// 管理者
Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        // TOPページ
        Route::resource('home', 'HomeController', ['only' => 'index']);

        //ユーザー一覧
        Route::get('/user_list', 'Auth\ManageUserController@showUserList');
        //ユーザー詳細
        Route::get('/user/{id}', 'Auth\ManageUserController@showUserDetail');
        //ユーザー削除
        Route::POST('/user/delete/{id}', 'Auth\ManageUserController@delete')->name('delete');

    });
    
});

//ゲストログイン
Route::post('login/guest', 'Auth\LoginController@guestLogin')->name('login.guest');

// 管理者ログイン
Route::post('admin/guest', 'Admin\Auth\LoginController@geustLogin')->name('admin.guest');


