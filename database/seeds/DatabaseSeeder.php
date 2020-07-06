<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // 作成したSeederを実行しデータの投入が可能になる
        $this->call(TodosTableSeeder::class); // 追加
    }
}
