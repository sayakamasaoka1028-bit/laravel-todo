@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
    @if(session('message'))
        <div class="todo__alert--success">
            {{ session('message') }}
        </div>
    @endif

    {{-- バリデーションエラー --}}
    @if ($errors->any())
        <div class="todo__alert--error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="todo__content">
    {{-- 作成フォーム --}}
    <form class="create-form" action="{{ route('todos.store') }}" method="post">
        @csrf
        <div class="create-form__item">
            <input class="create-form__item-input" type="text" name="content" value="{{ old('content') }}">
        </div>
        <div class="create-form__button">
            <button class="create-form__button-submit" type="submit">作成</button>
        </div>
    </form>

    {{-- Todo一覧 --}}
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                <th class="todo-table__header">Todo</th>
              <div class="update-form__button">
            @foreach($todos as $todo)
                <tr class="todo-table__row">
                    <td class="todo-table__item">
                        <form class="update-form" action="{{ route('todos.update', $todo->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="update-form__item">
                                <input class="update-form__item-input" type="text" name="content" value="{{ $todo->content }}">
                            </div>
                            <div class="update-form__button">
                                <button class="update-form__button-submit" type="submit">更新</button>
                            </div>
                        </form>
                    </td>
                    <td class="todo-table__item">
                        <form class="delete-form" action="{{ route('todos.destroy', $todo->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <div class="delete-form__button">
                                <button class="delete-form__button-submit" type="submit">削除</button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
