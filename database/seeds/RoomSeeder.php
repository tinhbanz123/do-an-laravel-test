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
            'image' => '',
        ],
        [
            'room_number' => 'ROOM NO.2',
            'description'  => 'phòng đẹp',
            'price' => 1000000,
            'image' => '',
        ],
        [
            'room_number' => 'ROOM NO.3',
            'description'  => 'phòng VIP 01',
            'price' => 5000000,
            'image' => '',
        ],
        [
            'room_number' => 'ROOM NO.4',
            'description'  => 'phòng 02 NOTE',
            'price' => 1000000,
            'image' => '',
        ]
    ];

        DB::table('rooms')->insert($data);
    }
}
