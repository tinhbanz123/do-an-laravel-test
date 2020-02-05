@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Customer Edit</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('customer.update',$customer->id)}}" method='post'>
            @csrf
            <div class='form-group'>
                <label>First Name</label>
                <input type="text" class='form-control' name='first' value="{{ old('first_name',$customer->first_name) }}">
            </div>

            <div class='form-group'>
                <label>Last Name</label>
                <input type="text" class='form-control' name='last' value="{{ old('last_name',$customer->last_name) }}">
            </div>

            <div class='form-group'>
                <label>Address</label>
                <input type="text" class='form-control' name='address' value="{{ old('address',$customer->address) }}">
            </div>

            <div class='form-group'>
                <label>Phone</label>
                <input type="text" class='form-control' name='phone' value="{{ old('phone',$customer->phone) }}">
            </div>

            <div class='form-group'>
                <label>Email</label>
                <input type="email" class='form-control' name='email' value="{{ old('email',$customer->email) }}">
            </div>

            <div class='form-group'>
                <label>Password</label>
                <input type="text" class='form-control' name='pass' value="{{ old('email',$customer->password) }}">
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Update</button>
            </div>
        </form>
    </div>
@endsection
