<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */

    // もし認証されていない場合・・・
    protected function redirectTo($request)
    {
        // loginにリダイレクト
        return route('login');
    }
}
