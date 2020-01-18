<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomRequest;
use App\Model\Room;
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
        $rooms = Room::paginate(3);
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
        $dataInsert = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
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
        $dataUpdate = [
            'room_number' => $params['number'],
            'description' => $params['description'],
            'price' => $params['price'],
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
