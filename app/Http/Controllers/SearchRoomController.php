<?php

namespace App\Http\Controllers;

use App\Model\Booking;
use App\Model\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SearchRoomController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');
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

        if(!empty($time_from and $time_to))
        {
            $rooms = Room::with('Booking');
            $rooms = $rooms->whereHas('Booking', function ($temp) use ($time_from, $time_to) {
                $temp->where('time_from', '>=', $time_to)
                    ->orWhere('time_to', '<=', $time_from);
            })->orWhereDoesntHave('Booking')->get();// lấy ra phòng chưa có booking

            $data['room'] = $rooms;
//            dd($rooms);
        }

        $data['time_from'] = $time_from;
        $data['time_to'] = $time_to;
//        dd($data);
        return view('rooms.search',$data);
    }

}
