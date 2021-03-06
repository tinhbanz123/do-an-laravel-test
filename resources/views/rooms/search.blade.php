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


        <div class='form-group'>
            <form action="{{ route('search-room.find_rooms')}}" method='get'>
{{--                method = get --> đưa giá trị lên thanh địa chỉ--}}
    {{--            @csrf--}}
                <div class='form-group'>
                    <label>Time from *</label>
                    <input type="date" class="form-control" name="time_from" required
                           value="{{ old('time_from',$time_from) }}">
                </div>

                <div class='form-group'>
                    <label>Time to *</label>
                    <input type="date" class='form-control' name='time_to'  required
                           value="{{ old('time_to',$time_to) }}">
                </div>

                <div class='form-group'>
                    <button type='submit' class='btn btn-primary'>Search</button>
                </div>
            </form>
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
                            <td>{{ number_format($value->price) . ' / ngày' }}</td>
                            <td><a href="{{ route('room.show',['id' => $value->id,'time_from' => $time_from, 'time_to' => $time_to])}}" class="btn btn-success">Detail Room</a></td>
                            <td><a href="{{ route('booking.create',['room_id' => $value->id,'time_from' => $time_from, 'time_to' => $time_to])}}" class="btn btn-primary">Book Room</a></td>
                        </tr>
                    @endforeach
                </table>
            @endif
        </div>


    </div>
@endsection
