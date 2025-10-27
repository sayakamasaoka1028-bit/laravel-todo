<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryIdToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('todos', function (Blueprint $table) {
             $table->foreignId('category_id')
                  ->nullable()               // 必須じゃない場合
                  ->after('id')              // idの後に追加
                  ->constrained('categories')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
         $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
}
