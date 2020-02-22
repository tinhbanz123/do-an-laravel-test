<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Model\Room;
use App\Model\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $rooms = Room::paginate(15);
        $data['rooms'] = $rooms;
//        dd($data['rooms']);
        return view('rooms.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
//        dd(111);
        $params = $request->all();
//        dd($params);

        $get_image = '';
        if($request->hasFile('image')){
            //Hàm kiểm tra dữ liệu
            $this->validate($request,
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Lưu hình ảnh vào thư mục public/image_room
            $img = $request->file('image');
//            $get_image = time().'_'.$img->getClientOriginalName();
            $get_image = $img->getClientOriginalName();
            $destinationPath = public_path('image_room');
//            dd($destinationPath);
            $img->move($destinationPath, $get_image);
        }

//        dd($get_image);
        $dataInsert = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
            'image' => $get_image,
        ];
        try {
            DB::beginTransaction();

            Room::insert($dataInsert);

            DB::commit();

            return redirect(route('room.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('room.index'))->with('error', 'thêm mới thất bại.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $params = $request->input();
        // dùng $params = $request->all(); đúng hơn
//        dd($params);
        $dataInsert = [
            'time_from' => $params['time_from'],
            'time_to' => $params['time_to'],
            'id' => $params['id'],
        ];
//        dd($dataInsert);
//        dd('111');
        $data = [];
        $room = Room::findOrFail($dataInsert['id']);
        $slide = Slide::select('filename')->where('room_id',$request->id)->get();
//        dd(count($slide));
//        dd($slide);
//        dd($room);
        $data['room'] = $room;
        $data['date'] = $dataInsert;
        $data['slide'] = $slide;
        return view('rooms.show',$data);
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
        $room = Room::findOrFail($id);
        $data['room'] = $room;
        return view('rooms.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        $params = $request->all();
//        dd($params);


        //Thực hiện lưu thay đổi hình thẻ khi có file
        if($request->hasFile('image')){
            $this->validate($request,
                [
                    'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],
                [
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ]
            );

            //Xóa file hình thẻ cũ
            $get_image = Room::select('image')->where('id',$request->id)->get();
//            dd($getHT[0]->image);
            if(!empty($get_image[0]->image) && file_exists(public_path('image_room/'.$get_image[0]->image)))
            {
                unlink(public_path('image_room/'.$get_image[0]->image));
            }

            //Lưu file hình thẻ mới
            $image = $request->file('image');
            $getImg = $image->getClientOriginalName();
            $destinationPath = public_path('image_room');
            $image->move($destinationPath, $getImg);
        }
        else
        {
            $getImg = $params['old_img'];
        }




        $dataUpdate = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
            'image' => $getImg,
        ];
        try {
            DB::beginTransaction();
            Room::where('id',$id)->update($dataUpdate);
            DB::commit();
            return redirect()->route('room.index')->with('success','Update successful.');
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('room.index')->with('error','Update fail.');
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
//        dd($id);
        try {
            DB::beginTransaction();
            Room::findOrFail($id)->delete();
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
