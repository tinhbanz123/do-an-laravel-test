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
        <a href="{{ route('booking.show',$room->id) }}" class="btn btn-success">Back</a>
    </div>
@endsection
