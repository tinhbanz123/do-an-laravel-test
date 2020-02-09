@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Room Search</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('search-room.show_rooms')}}" method='get'>
{{--            @csrf--}}
            <div class='form-group'>
                <label>Time from *</label>
                <input type="date" class="form-control" name="time_from"  value="{{ old('time_from',$time_from) }}">
            </div>

            <div class='form-group'>
                <label>Time to *</label>
                <input type="date" class='form-control' name='time_to' value="{{ old('time_to',$time_to) }}">
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Search</button>
            </div>

            <div class='form-group'>
                @if (!empty($room))
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>ID</th>
                            <th>Room Number</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th colspan='2'>Action</th>
                        </tr>
                        @foreach($room as $value)
                            <tr>
                                <td>{{ $value->id}}</td>
                                <td>{{ $value->room_number }}</td>
                                <td>{{ $value->description }}</td>
                                <td>{{ $value->price . ' / ngày' }}</td>
                                <td><a href="{{ route('room.show',$value->id)}}" class="btn btn-success">Detail</a></td>
                                <td><a href="{{ route('booking.create',['room_id' => $value->id,'time_from' => $time_from, 'time_to' => $time_to])}}" class="btn btn-primary">Book Room</a></td>
                            </tr>
                        @endforeach
                    </table>
                @endif
            </div>

        </form>
    </div>
@endsection
