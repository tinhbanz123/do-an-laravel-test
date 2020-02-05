<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataInsert = [
            ['name' => 'admin'],
            ['name' => 'editor'],
            ['name' => 'user']
        ];
        DB::table('roles')->insert($dataInsert);
    }
}
