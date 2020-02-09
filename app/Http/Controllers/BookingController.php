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
    public function create(Request $request)
    {
        $params = $request->input();
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'room_id' => $params['room_id'],
        ];
//        dd($params);
        $data = [];
//        $room = Room::where('status','!=',1)->pluck('room_number','id');
//        dd($room);
        $customer = Customer::pluck('last_name','id');
        $room_name = Room::findOrFail($params['room_id']);
//        dd($room_name);
//        dd($customer);
//        $data['rooms'] = $room;
        $data['customers'] = $customer;
//        $data['time_from'] = $params['time_from'];
//        $data['time_to'] = $params['time_to'];
        $data['room_name'] = $room_name;
        $data['data_time'] = $dataInsert;
//        dd( $data['data']);
//        dd($data['room_name']);
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
//        $dataRoom = ['status' => 1];
        try {
            DB::beginTransaction();

            Booking::insert($dataInsert);
            //chuyển status room sang trạng thái hết phòng
//            Room::where('id',$dataInsert['room_id'])->update($dataRoom);
            DB::commit();

            return redirect(route('booking.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('booking.index'))->with('error', 'thêm mới thất bại.');
//            return redirect(route('search-room.find_rooms',['time_from' => $dataInsert['time_from'],'time_to' => $dataInsert['time_to']]))->with('error', 'thêm mới thất bại.');
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
        $dataRoom = ['status' => 0];
        try {
            DB::beginTransaction();
            $booking = Booking::findOrFail($id);
            $update_book = $booking->delete();
            //chuyển status room sang trạng thái còn phòng
            Room::where('id',$booking->room_id)->update($dataRoom);
            DB::commit();

            return response()->json([
                'success' => 'Delete successful.'
            ]);

//            return redirect()->route('category.index')->with('seccess','Delete successful.');
        }catch (\Exception $exception){
            DB::rollBack();

            return response()->json([
                'error' => 'Delete fail.'
            ]);
//            return redirect()->route('category.index')->with('error','Delete fail.' .$exception->getMessage());
        }
    }
}
