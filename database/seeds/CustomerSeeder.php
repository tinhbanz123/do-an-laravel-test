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
        $data = [
            [
                'first_name' => 'First Name 01',
                'last_name'  => 'Last Name 01',
                'address' => 'address 01',
                'phone' => '09080703',
                'email' => 'email01@gmail.com',
            ],
            [
                'first_name' => 'First Name 02',
                'last_name'  => 'Last Name 02',
                'address' => 'address 02',
                'phone' => '09080702',
                'email' => 'email02@gmail.com',
            ]
        ];

        DB::table('customers')->insert($data);
    }
}
