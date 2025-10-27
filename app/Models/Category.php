<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name']; // 追加・更新可能なフィールド

    // このカテゴリに属するTodo一覧を取得
    public function todos()
    {
        return $this->hasMany(Todo::class);
    }
}
