@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection

@section('content')
<div class="category__alert">
  @if (session('message'))
  <div class="category__alert--success">
    {{ session('message') }}
  </div>
  @endif
  @if ($errors->any())
  <div class="category__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
</div>
<div class="category__content">
  <form class="create-form" action="{{ route('categories.store')}}"method="POST" class="update-form">
  @csrf
    <div class="create-form__item">
      <input class="create-form__item-input" type="text" name="name" placeholder="カテゴリ名を入力">
</div>
    <div class="create-form__button">
      <button class="create-form__button-submit" type="submit">作成</button>
    </div>
  </form>
{{-- カテゴリ一覧 --}}
  <div class="category-table">
    <table class="category-table__inner">
      <tr class="category-table__row">
        <th class="category-table__header">category</th>
      </tr>
      @foreach ($categories as $category)
      <tr class="category-table__row">
        <td class="category-table__item">
{{-- 更新フォーム --}}
     <form action="{{ route('categories.update', $category->id) }}" method="POST" class="update-form">
            @csrf
            @method('PUT')
             <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="name" value="{{ $category->name }}">
            </div>
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </form>
        </td>
        <td class="category-table__item">
{{-- 削除フォーム --}}
          <form action="{{route('categories.destroy', $category->id) }}" method="POST" class="delete-form">
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
