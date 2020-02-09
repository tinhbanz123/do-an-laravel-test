<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5 ; $i++) {
            $dataInsert = [
                'first_name' => 'Nguyễn',
                'last_name' => 'Văn A ' . $i,
                'address' => 'Street ' . $i,
                'phone' => '123456789' . $i,
                'email' => 'nguyenvana' . $i . '@gmail.com',
                'password' => bcrypt('123456'),
                'pass_no_hash' => '123456',
//                    'role_id' => $role->id
            ];
            DB::table('customers')->insert($dataInsert);
        }
    }
}
