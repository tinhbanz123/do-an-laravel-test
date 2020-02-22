<?php

namespace App\Http\Controllers;

use App\Model\Room;
use App\Model\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SlideController extends Controller
{

    public function create($id)
    {
        $data = [];
        $room = Room::findOrFail($id);
        $data['room'] = $room;
        return view('slides.create',$data);
    }

    public function store(Request $request)
    {
//        dd($request->image[0]->getClientOriginalName());
        $data = [];
        if($request->hasFile('images')){
            $img = $request->file('images');
            foreach ($img as $key => $value)
            {
                $img_name = $value->getClientOriginalName();
//                dd($img_name);
                $destinationPath = public_path('slide_room');
//                dd($destinationPath);
                $move = $value->move($destinationPath, $img_name);
                if($move)
                {
                    $data[] = [
                        'filename' =>   $img_name,
                        'url' => $destinationPath,
                        'room_id' => $request->room_id,
                    ];
                }
            }
        }
//        dd($data);


//        $dataInsert = [
//            'filename' => $data['filename'],
//            'url' => $data['url'],
//            'room_id' => $request->room_id,
//        ];
        try {
            DB::beginTransaction();

            Slide::insert($data);
            DB::commit();

            return redirect(route('room.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('room.index'))->with('error', 'thêm mới thất bại.' . $exception->getMessage());
        }
    }
}
