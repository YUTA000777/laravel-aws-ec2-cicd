<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
   
    protected function redirectTo($request)
    {
        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (! $request->expectsJson()) {
            return route('login');
        }elseif (Route::is('admin.*')) {
            return route($this->admin_route);
        }
        
    }
}
