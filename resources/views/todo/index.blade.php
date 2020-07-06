@extends ('layouts.app')
@section ('content')

<h1 class="page-header">ToDo一覧</h1>
<p class="text-right">
  <a class="btn btn-success" href="/todo/create">ToDoを追加</a>
</p>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th>やること</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($todos as $todo)
    {{Debugbar::info($todo)}}
      <tr>
        <!-- 自動的に htmlspecialchars でエスケープして表示 -->
        <td class="align-middle">{{ $todo->title }}</td>
        <td class="align-middle">{{ $todo->created_at }}</td>
        <td class="align-middle">{{ $todo->updated_at }}</td>
        <!-- route : View側でURLを指定するときに使用 -->
        <!-- todo/{todo}/edit  の {todo} を $todo->id で指定-->
        <!-- aタグを使用しているから -->
        <td><a class="btn btn-primary" href="{{ route('todo.edit', $todo->id) }}">編集</a></td>
        <td>
        <!-- ヘルパー関数([''=>''])を使用することでトークンが自動で生成されるためセキュリティ性が高くなる -->
        <!-- htmlspecialchars でエスケープしない -->
        <!-- Form の HTML を PHP で生成しているため、エスケープしない -->
        <!-- Route の Name から URIを取得、パラメータとして idを付与 -->
          {!! Form::open(['route' => ['todo.destroy', $todo->id], 'method' => 'DELETE']) !!}
            <!-- 
            <form method="POST" action="http://127.0.0.1:8000/todo/1" accept-charset="UTF-8">
                <input name="_method" type="hidden" value="DELETE">
                <input name="_token" type="hidden" value="Hlom5rUNQQeL9KtTdQFGhHb65D1d8S9lPFgGmODQ"> 
            -->
            <!-- input[type=submit]タグを生成 -->
            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- sectionの終わりを表記 -->
@endsection
