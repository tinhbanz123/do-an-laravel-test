<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInsert = [
            [
                'name' => 'Test name 1',
                'email' => 'email01@gmail.com',
                'password' => bcrypt('123456'),
            ],
            [
                'name' => 'Test name 2',
                'email' => 'email02@gmail.com',
                'password' => bcrypt('123456'),
            ]
        ];

        DB::table('users')->insert($dataInsert);
    }
}
