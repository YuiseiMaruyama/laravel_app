<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers; // class 内でAuthenticatesUsers を使用可能になる

    // ログイン失敗時のロック機能は、
    // AuthenticatesUsers -> ThrottlesLogins -> hasTooManyLoginAttempts() -> maxAttemptsにある
    protected $maxAttempts = 3; // ログイン試行回数（回）

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    // ユーザーのログイン処理を行うと、ToDo一覧画面に遷移
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // middleware('guest') : Http/Auth/Kernel.phpに定義
        // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        // middlewareでguestが設定されているため、一度ログインしたユーザはログイン画面に戻ることはない
        $this->middleware('guest')->except('logout');
    }

    // ログアウト後の動作
    protected function loggedOut(Request $request)
    {
        return redirect('/login');
    }
}
