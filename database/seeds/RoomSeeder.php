<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
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
            'room_number' => 'ROOM NO.1',
            'description'  => 'phòng thoáng mát',
            'price' => 500000,
        ],
        [
            'room_number' => 'ROOM NO.2',
            'description'  => 'phòng đẹp',
            'price' => 1000000,
        ]
    ];

        DB::table('rooms')->insert($data);
    }
}
