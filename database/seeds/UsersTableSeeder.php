<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('users')->insert([
            ['over_name' => '北谷',
             'under_name' => '隆一',
             'over_name_kana' => 'キタヤ',
             'under_name_kana' => 'リュウイチ',
             'mail_address' => 'kitaya@gmail.com',
             'sex' => '1',
             'birth_day' => '1995/6/6',
             'role' => '4',
             'password' => 'ryuichi0606'],
        ]);
    }
}