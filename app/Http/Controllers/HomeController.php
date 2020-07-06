<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // ここで認証の制限をしている -> HomeControllerを経由して行われる処理はすべて認証によるアクセスの制限が行われる
        // middleware('auth') : app\Http\Kernel.php内の54行目に記述
        // 'auth' => \App\Http\Middleware\Authenticate::class,
        // -> \App\Http\Middleware\Authenticate を確認
        // middlewareではhandleメソッドが実行される
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
