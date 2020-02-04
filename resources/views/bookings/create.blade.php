@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Booking Room</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form action="{{ route('booking.store')}}" method='post'>
            @csrf

            <div class='form-group'>
                <label>Time from *</label>
                <input type="date" class="form-control" name="time_from" value={{$data_time['time_from']}} >
            </div>

            <div class='form-group'>
                <label>Time to *</label>
                <input type="date" class='form-control' name='time_to' value={{$data_time['time_to']}}>
            </div>

            <div class='form-group'>
                <label>Room Number</label>
{{--                @if($rooms)--}}
                    <select name="number" class="form-control">
                        <option value="{{$room_name->id}}">{{$room_name->room_number}}</option>
{{--                        @foreach($rooms as $key => $value)--}}
{{--                            <option value="{{ $key }}" >{{ $value }}</option>--}}
{{--                        @endforeach--}}
                    </select>
{{--                @endif--}}

            </div>

            <div class='form-group'>
                <label>Customer Name</label>
                @if($customers)
                    <select name="name" class="form-control">
                        <option value=""></option>
                        @foreach($customers as $key => $value)
                            <option value="{{ $key }}" >{{ $value }}</option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Booking</button>
            </div>
        </form>
    </div>
@endsection
