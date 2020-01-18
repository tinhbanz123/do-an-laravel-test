<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = DB::table('customers')->get();
//        $rooms = DB::table('rooms')->get();
        if(!empty($customers))
        {
            foreach ($customers as $key => $value)
            {
                try {
                    DB::beginTransaction();
                    $bookings = [
                        'time_from' => '2000-01-' . ($key + 1),
                        'time_to' => '2000-01-' . ($key + 1),
                        'customer_id' => $value->id,
                        'room_id' => $value->id ,
                    ];
                    DB::table('bookings')->insert($bookings);
                    DB::commit();
                }catch (\Exception $exception) {
                    DB::rollback();
                }
            }
        }
    }
}
