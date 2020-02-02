<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Model\Customer;
use App\Model\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $customers = Customer::paginate(4);
        $data['customers'] = $customers;
        return view('customers.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $params = $request->all();
        $dataInsert = [
            'first_name' => $params['first'],
            'last_name' => $params['last'],
            'address' => $params['address'],
            'phone' => $params['phone'],
            'email' => $params['email'],
        ];
//        dd($dataInsert);
        try {
            DB::beginTransaction();

            Customer::insert($dataInsert);

            DB::commit();

            return redirect(route('customer.index'))->with('success', 'thêm mới thành công.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect(route('customer.index'))->with('error', 'thêm mới thất bại.');
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
        $customer = Customer::findOrFail($id);
        $data['customer'] = $customer;
        return view('customers.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $params = $request->all();
        $dataInsert = [
            'first_name' => $params['first'],
            'last_name' => $params['last'],
            'address' => $params['address'],
            'phone' => $params['phone'],
            'email' => $params['email'],
        ];

        try {
            DB::beginTransaction();
            Customer::where('id',$id)->update($dataInsert);
            DB::commit();
            return redirect()->route('customer.index')->with('success','Update successful.');
        }catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('customer.index')->with('error','Update fail.');
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
