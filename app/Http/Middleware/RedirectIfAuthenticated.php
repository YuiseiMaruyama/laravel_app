<?php
// もし認証が完了しているならばリダイレクトを行うファイル
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    // ルートからコントローラのメソッドが呼び出される前に、handle メソッドが呼び出される
    public function handle($request, Closure $next, $guard = null)
    {
        // Auth::guard : Illuminate\Auth\AuthManager.phpの 64行目に定義
        // Authの実体はIlluminate/Auth/AuthManagerでguard()メソッドを実行し、check()は SessionGuardに記述
        // Illuminate/Auth/SessionGuard.php の Illuminate\Auth\GuardHelpers.php に記述
        // dd($guard); -> null

        // 認証が完了しているかどうか判定
        if (Auth::guard($guard)->check()) {
            return redirect('/home'); // /todoにリダイレクト
        }
        // ログインしていない時は $next() コールバックを呼び出して処理を継続 -> actionメソッド
        return $next($request);
    }
}
