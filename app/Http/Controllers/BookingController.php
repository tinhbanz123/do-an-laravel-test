<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Customer;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
//        $room = Booking::with('Room')->get();
//        $name = Booking::with('Customer')->get();
//        $data['room'] = $room;
//        $data['name'] = $name;
        $booking = Booking::all();
        $data['booking'] = $booking;
        return view('bookings.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
//        $room = Room::pluck('room_number','id');
        $room = Room::where('status','!=',1)->pluck('room_number','id');
//        dd($room);
        $customer = Customer::pluck('first_name','id');
//        dd($customer);
        $data['rooms'] = $room;
        $data['customers'] = $customer;
        return view('bookings.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->all();
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'room_id' => $params['number'],
            'customer_id' => $params['name'],
        ];
//        dd($dataInsert);
        $dataRoom = ['status' => 1];
        try {
            DB::beginTransaction();

            Booking::insert($dataInsert);
            //chuyển status room sang trạng thái hết phòng
            Room::where('id',$dataInsert['room_id'])->update($dataRoom);
            DB::commit();

            return redirect(route('booking.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('booking.index'))->with('error', 'thêm mới thất bại.');
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        $booking = Booking::findOrFail($id);
//        dd($booking);
        $room = Room::pluck('room_number','id');
        $data['booking'] = $booking;
        $data['room'] = $room;
        return view('bookings.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $params = $request->all();
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'room_id' => $params['number'],
        ];

        try {
            DB::beginTransaction();
            Booking::where('id',$id)->update($dataInsert);
            DB::commit();
            return redirect()->route('booking.index')->with('success','Update successful.');
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('booking.index')->with('error','Update fail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
