<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
   
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function guestLogin(Request $request)
    {
        //簡単ログイン。attempt関数でnav.blade.phpのhiddenで受け取った値を認証して認証した場合はtrueを返して今回であれば一般ユーザーのログイン後と同じ操作を可能としている。
        if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){

            $articles = Article::latest()->paginate(5);
            return view('articles.index', ['articles' => $articles]);

        }
            return redirect()->back();
            
    }

}
