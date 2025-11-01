<?php
// このファイルはコントローラーを定義するためのもの
namespace App\Http\Controllers; // 名前空間。Laravelではコントローラーはこの場所に置く

use Illuminate\Http\Request; // HTTPリクエストを扱うためのクラスを読み込む
use App\Models\Todo; // Todoモデルを読み込む
use App\Http\Requests\TodoRequest; // TodoRequestクラスを使えるようにする
// フォームから送られたTodoデータのバリデーションを専用クラスでまとめて扱える
use App\Models\Category;
// Categoryモデルを使えるようにする
// データベースの categories テーブルに対応するモデルで、カテゴリ情報を取得・保存できる

// TodoControllerクラスの定義。Controllerを継承しているのでLaravelの便利な機能が使える
class TodoController extends Controller
{
     // 一覧表示
public function index(Request $request)
{
$keyword = $request->input('keyword');  // 検索キーワード
    $category_id = $request->input('category_id'); // 選択カテゴリ

    $query = Todo::query(); // Todoモデルのクエリビルダーを作成

    if ($keyword) {
        $query->where('content', 'LIKE', "%{$keyword}%"); // キーワード検索
    }

    if ($category_id) {
        $query->where('category_id', $category_id); // カテゴリ検索
    }

    $todos = $query->with('category')->get(); // categoryリレーションも読み込む
    $categories = Category::all(); // カテゴリ全件取得

    return view('todos.index', compact('todos', 'categories', 'keyword', 'category_id'));
} //return view(...) → 「この画面を表示してね」compact(...) → 「渡すデータをまとめてね」Blade 内では渡した変数をそのまま使える
     // 作成

public function store(TodoRequest $request)
{
// content と category_id を取得して保存
        $todo = $request->only(['content', 'category_id']);
        Todo::create($todo);//sql はEloquentモデルを作って、INSERT文を発行してDBに保存するワンステップ処理　insert into `todos` (`title`, `is_done`, `created_at`, `updated_at`)


        return redirect('/')->with('message', 'Todoを作成しました');
}
     // 削除
public function destroy($id)
{
    $todo = Todo::find($id);

    if ($todo) {
        // Todoが存在すれば削除
        $todo->delete(); //DELETE FROM todos WHERE id = 3;

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    return redirect('/')->with('message', 'Todoが見つかりません');
}

    // 更新
    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::findOrFail($id); //SELECT * FROM todos WHERE id = 3 LIMIT 1;
        $todo->update($request->only(['content']));

        return redirect('/')->with('message', 'Todoを更新しました');
    }
     // 編集フォーム
public function edit($id)
{
        $todo = Todo::findOrFail($id); //SELECT * FROM todos WHERE id = 3 LIMIT 1;
        return view('edit', compact('todo'));
    }
public function indexByCategory(Category $category)
{
    // 選択したカテゴリに紐づくTodoだけ取得
    $todos = $category->todos()->with('category')->get();

    // 全カテゴリも取得して表示用に渡す
    $categories = Category::all(); //SELECT * FROM categories;

    // 選択中のカテゴリIDも渡す
    $category_id = $category->id;

    return view('todos.index', compact('todos', 'categories', 'category_id'));
}

}
