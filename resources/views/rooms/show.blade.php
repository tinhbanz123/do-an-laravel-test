@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Room Details</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(empty($room))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Price</th>
                </tr>
                <tr>
                    <td>{{ $room->id}}</td>
                    <td>{{ $room->room_number }}</td>
                    <td>{{ $room->description }}</td>
                    <td>{{ ($room->status == 0) ? 'còn phòng' : 'hết phòng' }}</td>
                    <td>{{ $room->price . ' / ngày' }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ route('search-room.find_rooms',['time_from' => $date['time_from'],'time_to' => $date['time_to']]) }}" class="btn btn-success">Back</a>
        <a href="{{ route('booking.create',['room_id' => $date['id'],'time_from' => $date['time_from'],'time_to' => $date['time_to']])}}" class="btn btn-primary">Book Room</a>
    </div>
@endsection
