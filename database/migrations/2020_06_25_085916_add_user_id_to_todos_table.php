<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    // 新しいテーブル、カラム、インデックスをデータベースに追加するために使用
    public function up()
    {
        // Schema::table -> 既に存在するテーブルを更新
        // todos table に対して user_id というカラムを追加
        Schema::table('todos', function (Blueprint $table) {
            $table->integer('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

    // upメソッドが行った操作を元に戻す
    public function down()
    {
        Schema::table('todos', function (Blueprint $table) {
            // テーブルからカラムを削除
            $table->dropColumn('user_id');
        });
    }
}
