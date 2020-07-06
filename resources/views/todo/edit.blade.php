@extends ('layouts.app')
@section ('content')

<h2 class="mb-3">ToDo編集</h2>
<!-- PUT : 何度行っても同じ結果になる処理 -->
<!-- Form の HTML を PHP で生成しているため、エスケープしない -->
{!! Form::open(['route' => ['todo.update', $todo->id], 'method' => 'PUT']) !!} <!-- 変更 -->
  <div class="form-group">
    <!-- <form > -->
        <!-- <input type="text" class="form-control" placeholder="ToDo内容"> -->
        <!-- (type, name, value, [ 属性 ]) -->
        <!-- <button type="submit" class="btn btn-success float-right">更新</button> -->
    <!-- </form> -->
    {!! Form::input('text', 'title', $todo->title, ['required', 'class' => 'form-control']) !!}
  </div>
  {!! Form::submit('更新', ['class' => 'btn btn-success float-right']) !!} <!-- 変更 -->
{!! Form::close() !!} <!-- 変更 -->

@endsection