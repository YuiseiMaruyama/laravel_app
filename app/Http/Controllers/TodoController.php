<?php
// ファイルの居場所を示す
namespace App\Http\Controllers;

// 中で使うクラスを宣言する
use Illuminate\Http\Request;
use App\Todo;  // 追記
use Auth;  // 追記

class TodoController extends Controller
{
    // 同じクラスの中でのみアクセス可能
    // 他のクラスで使用できないようにする -> 副作用をなくすため
    private $todo;

    // Modelの処理を記述
    // 引数のTodoは App\Todo.phpの Todoクラスのインスタンス化
    // クラスからインスタンスを生成するときに最初に呼び出されるメソッド
    // ステートレスな関数
    public function __construct(Todo $instanceClass)
    {
        // dd($instanceClass);
        // $thisはclass自体 -> TodoControllerクラス
        // TodoControllerクラス -> private $todo;にアクセスし、インスタンス化したTodoクラスを格納
        // private $todo に格納する理由は、create()やupdate()でユーザから入力された情報を周りからアクセスさせないようにするため

        $this->middleware('auth'); // ログインしていない場合は、Todo の一覧が表示されないようにする
        // dd($this->middleware('auth')); -> Illuminate\Routing\ControllerMiddlewareOptions { #options: & [] }
        $this->todo = $instanceClass;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ログインしているユーザーを Auth::id() という形で取得可能にする
        $todos = $this->todo->getByUserId(Auth::id());

        // $this->todo は Model(DBのデータを操作する)のClassインスタンス
        // $todosには、なんのデータ型が入っているのか？ インスタンス化されたクラスの役割を確認する
        // $todos = $this->todo->all();  // -> SELECT * FROM todos; と同意義

        // $todos ->  #items: array:6 [ 0 => App\Todo, 1 => App\Todo, ... ] -> オブジェクト

        // view('指定したView', '配列') : view関数の第２引数に配列を渡すことで、viewに変数を渡すことができる -> compact()を使用
        // 第1引数は、viewディレクトリ配下のファイル
        // 第2引数は、受け渡す値(配列)
        // compact() : 変数から配列を作成する
        // dd(compact('todos')); -> 配列を一つにまとめる
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create.blade.phpなのか、create.php　なのかこの時点では判断しない
        // bladeがあった場合、優先的に実行される
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    
    // Request $request -> ブラウザを通してユーザーから送られる情報をすべて含んでいるオブジェクト
    public function store(Request $request)
    {
        // $request->all() : 全ての入力値を「配列」として受け取る
        // dd($input); -> _token と title が入った連想配列
        $input = $request->all();

        // fill() : プロパティを設定できるかどうかを確認 -> 複数代入の危険性 
        // -> ブラウザに表示されるのはtitleのフィールドだけだが、ブラウザをいじれば他の項目も更新出来てしまう問題がある
        // -> Modelインスタンスによって、title以外の項目を変更できないようにする

        $input['user_id'] = Auth::id(); // userIDの保存

        // save() : DBへ保存
        // SQL文のINSERTに当たる
        $this->todo->fill($input)->save();
        // to('URI')
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id); -> $todo->id
        // パラメータで渡ってきた値を元にDBへ検索
        // SELECT * FROM todos WHERE id = $id;
        $todo = $this->todo->find($id);
        \Debugbar::info($todo);
        // compact() -> view側で変数を使用することが可能
        return view('todo.edit', compact('todo'));  // 追記
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // $request : POSTされたデータ
        // $request->all() : 全ての入力値を「配列」として受け取る
        // dd($input); -> _token と title が入った連想配列
        // fill() : プロパティを設定できるかどうかを確認 -> title以外の属性を持っていないことを確認
        $input = $request->all();
        // UPDATE todos SET title = ポストされたtitle WHERE id = $id;
        // dd($this->todo->find($id)->fill($input)); -> Todoモデル
        // dd(redirect()); -> boolean
        $this->todo->find($id)->fill($input)->save();
        return redirect()->route('todo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // DELETE FROM todos WHERE id = $id ;
        $this->todo->find($id)->delete();
        return redirect()->route('todo.index');
    }
}
