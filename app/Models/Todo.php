<?php

namespace App\Models; // このクラスが属する名前空間

use Illuminate\Database\Eloquent\Factories\HasFactory; // モデルのファクトリー機能を使うため
use Illuminate\Database\Eloquent\Model; // Eloquentの基本クラスを継承するため

    // Todoモデルを定義
    // EloquentのModelを継承しているので、DB操作の便利機能（create, update, deleteなど）が使える
class Todo extends Model
{
    use HasFactory; // ファクトリー機能をこのモデルで使えるようにする
    // このモデルに対して一括代入できるカラムを指定
    // create() や update() で 'content' と 'category_id' を直接渡せるようになる
    protected $fillable = ['content', 'category_id'];

     /**
     * Todo が属する Category（1対1の関係）を取得するメソッド
     * 例: $todo->category で紐付いたカテゴリを取得できる
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
        // Todo は1つのカテゴリに属している
        // Eloquent が自動で 'category_id' カラムを使って紐付ける
    }
}
