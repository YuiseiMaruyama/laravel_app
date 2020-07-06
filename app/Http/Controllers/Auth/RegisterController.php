<?php

namespace App\Http\Controllers\Auth; // 同じクラスがあった場合、参照元がわかるように

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers; // traitについて

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // 登録フォームの表示内容である showRegistrationForm は、Illuminate\Foundation\Auth\RegistersUsersに記述

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    // ユーザーの登録処理を行うと、ToDo一覧画面に遷移
    protected $redirectTo = '/todo';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() // インスタンス化されたとき
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    // 登録条件
    // $data -> $request->all()
    protected function validator(array $data)
    {
        // Validatorクラスのmakeメソッドに、第一引数でPOST送信したデータ$request->all()を渡し、第二引数でバリデーションルールを渡す
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            // email : メール形式ではないとエラーになり、一度登録されているメールアドレスは再度登録できない
            // unique :  テーブル     :  DBに指定条件で重複するレコードが存在しなければ通す
            // usersテーブルの emailカラムと紐付け
            'email' => 'required|string|email|max:255|unique:users',
            // confirmed : passwordとconfirm passwordに入力した文字列が同一かどうかチェックを行う
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    // $data -> $request->all() = Postされたデータ
    protected function create(array $data)
    {
        // User : Illuminate\Foundation\Auth\User に記述
        // モデルクラス(User)からcreateメソッドを呼ぶことで
        // インスタンスの作成→属性の代入→データの保存を行う -> SQLのINSERT文
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            // Hash::make : パスワードをハッシュ化(悪意あるユーザ or 開発者)
            'password' => Hash::make($data['password']),
        ]);
    }
}
