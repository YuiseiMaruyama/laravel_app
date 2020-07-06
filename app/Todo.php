<?php

namespace App;
// Eloquent : データベースの操作を直感的に行える
use Illuminate\Database\Eloquent\Model;

// extends : 親の持つ機能を子が使用すること
class Todo extends Model
{
    // protected : そのクラス自身と継承クラスからアクセス可能
    // $fillable : 指定したカラム(title, user_id)のみ、create()やfill()、update()で値が代入可能 -> created_at や updated_atは持たない
    protected $fillable = [
        'title',
        'user_id'  // 保存対象としてuser_idも許可する
    ];

    // ユーザーに紐づいたデータ取得のための記述
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
