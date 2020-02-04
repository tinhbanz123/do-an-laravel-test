<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Room;
use Illuminate\Http\Request;

class FindRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rooms.search');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = [];
        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');
//        dd($time_from);
        $rooms = Room::with('Booking');

        //Wherehas : lấy ra tất cả (get) trong Model : Booking với điều kiện (where)
        //với 2 tham số truyền vào $time_from và $time_to

        //EX :
        // Nếu bạn cần nhiều hơn nữa, bạn có thể sử dụng các method whereHas và orWhereHas
        // đặt "where" trong điều kiện query của bạn.
        // Những method này cho phép bạn thêm các ràng buộc tùy chỉnh cho 1 relationship,
        // chẳng hạn như kiểm tra nội dung của 1 comment:
        //
        //// Retrieve all posts with at least one comment containing words like foo%
        //$posts = Post::whereHas('comments', function ($query) {
        //    $query->where('content', 'like', 'foo%');
        //})->get();

        $rooms = $rooms->whereHas('Booking', function ($q) use ($time_from, $time_to) {
//            $q->where(function ($q2) use ($time_from, $time_to) {
//                $q2->where('time_from', '>=', $time_to)
//                    ->orWhere('time_to', '<=', $time_from);
//            });
            $q->where('time_from', '>=', $time_to)
                ->orWhere('time_to', '<=', $time_from);
        })
            ->orWhereDoesntHave('Booking')->get(); // lấy ra phòng chưa có booking
//        dd($rooms);
        $data['room'] = $rooms;
        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
        return view('bookings.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
