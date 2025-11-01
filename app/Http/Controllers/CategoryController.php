<?php

namespace App\Http\Controllers;// このファイルが所属する名前空間を指定

use Illuminate\Http\Request; //Requestクラスを使えるようにする

use App\Models\Category;// Categoryモデルを使えるようにする

use App\Http\Requests\CategoryRequest;// CategoryRequestクラスを使えるようにする

class CategoryController extends Controller
{
// 一覧表示
    public function index()
    {
        $categories = Category::all();//SELECT * FROM categories;

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
        Category::create($request->only('name')); //INSERT INTO categories (name, created_at, updated_at)
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
        $category->update($request->all());//UPDATE categories
            //SET name = '新しいカテゴリ名', updated_at = NOW()
            //WHERE id = 3;
        return redirect()->route('categories.index');
    }

    // 削除処理
    public function destroy(Category $category)
    {
        $category->delete();//DELETE FROM categories
        //WHERE id = 3;

        return redirect()->route('categories.index');
}
}
