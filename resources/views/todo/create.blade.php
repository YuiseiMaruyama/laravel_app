@extends ('layouts.app')

@section ('content')

<h2 class="mb-3">ToDo作成</h2>

<!-- {!! Form::open() !!} は、何を生成しているのか？-->
    <!-- <form> -->
    <!-- <input name="_token" type="hidden" value="Hlom5rUNQQeL9KtTdQFGhHb65D1d8S9lPFgGmODQ"> -->
    <!-- <input type="text" class="form-control" placeholder="ToDo内容"> -->
    <!-- <button type="submit" class="btn btn-success float-right">追加</button> -->
    <!-- </form> -->

<!-- Form の HTML を PHP で生成しているため、エスケープしない -->
<!-- ['route' => 'ルートネームの指定'] -->
{!! Form::open(['route' => 'todo.store']) !!}
  <div class="form-group">
    <!-- (type, name, value, [ 属性 ]) -->
    {!! Form::input('text', 'title', null, ['required', 'class' => 'form-control', 'placeholder' => 'ToDo内容']) !!} <!-- 変更 -->
  </div>
  {!! Form::submit('追加', ['class' => 'btn btn-success float-right']) !!} <!-- 変更 -->
{!! Form::close() !!} <!-- 変更 -->


@endsection