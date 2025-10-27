<?php
// このファイルはコントローラーを定義するためのもの
namespace App\Http\Controllers; // 名前空間。Laravelではコントローラーはこの場所に置く

use Illuminate\Http\Request; // HTTPリクエストを扱うためのクラスを読み込む
use App\Models\Todo; // Todoモデルを読み込む
use App\Http\Requests\TodoRequest;

// TodoControllerクラスの定義。Controllerを継承しているのでLaravelの便利な機能が使える
class TodoController extends Controller
{
     // 一覧表示
public function index()
{
    $todos = Todo::all(); // テーブルの全レコードを取得するEloquentメソッド select * from `todos`;

    return view('index', compact('todos')); // Bladeに渡す
}
     // 作成
public function store(TodoRequest $request)
{
// TodoRequest でバリデーション済み
        $todo = $request->only(['content']);
        Todo::create($todo);//sql はEloquentモデルを作って、INSERT文を発行してDBに保存するワンステップ処理　insert into `todos` (`title`, `is_done`, `created_at`, `updated_at`)


        return redirect('/')->with('message', 'Todoを作成しました');
}
     // 削除
public function destroy($id)
{
    $todo = Todo::find($id);

    if ($todo) {
        $todo->delete();
        return redirect('/')->with('message', 'Todoを削除しました');
    }

    return redirect('/')->with('message', 'Todoが見つかりません');
}

    // 更新
    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::findOrFail($id);
        $todo->update($request->only(['content']));

        return redirect('/')->with('message', 'Todoを更新しました');
    }
     // 編集フォーム
public function edit($id)
{
        $todo = Todo::findOrFail($id);
        return view('edit', compact('todo'));
    }
}
