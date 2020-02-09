@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Booking Edit</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('booking.update',$booking->id)}}" method='post'>
            @csrf
            <div class='form-group'>
                <label>Time from *</label>
                <input type="date" class="form-control" name="time_from"  value="{{ old('time_from',$booking->time_from) }}">
            </div>

            <div class='form-group'>
                <label>Time to *</label>
                <input type="date" class='form-control' name='time_to' value="{{ old('time_to',$booking->time_to) }}">
            </div>

            <div class='form-group'>
                <label>Room Number</label>
                @if($room)
                    <select name="number" class="form-control">
                        <option value=""></option>
                        @foreach($room as $key => $value)
                            <option value="{{ $key }}" {{ $booking->room_id  == $key ? 'selected' : ''}} >
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>

{{--                    @foreach($room as $key => $value)--}}
{{--                        @if($booking->room_id  == $key)--}}
{{--                        <input type="text" name="number" value="{{$value}}" class='form-control'>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                @endif

            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Update</button>
            </div>
        </form>
    </div>
@endsection
