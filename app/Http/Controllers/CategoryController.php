<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
// 一覧表示
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // 新規作成フォーム
    public function create()
    {
        return view('categories.create');
    }

    // データ保存
    public function store(CategoryRequest $request)
    {
        $request->validate(['name' => 'required|max:50']);
        Category::create($request->only('name')); // DBに追加
        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    // 編集フォーム
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // 更新処理
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    // 削除処理
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
  }
}
