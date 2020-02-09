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
        $roles = DB::table('roles')->get();
        if (!empty($roles)){
            foreach ($roles as $key => $role) {
                $dataInsert = [
                    'name' => 'nguyen van a'. $key,
                    'email' => 'nguyenvana' . $key .'@gmail.com',
                    'password' => bcrypt('123456'),
                    'role_id' => $role->id
                ];
                DB::table('users')->insert($dataInsert);
            }
        }
    }

}
