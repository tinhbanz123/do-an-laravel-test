@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Create Slide Room</h1>

        {{--show message success--}}
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif

        {{--show message fail--}}
        @if(session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

{{--        kiểm tra lỗi không thỏa điều kiện validate--}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('slide.store')}}" method='post' enctype="multipart/form-data">
            @csrf
{{--            <div class='form-group'>--}}
{{--                <label>Room Number</label>--}}
{{--                <input type="text" class='form-control' name='number' value="{{ $room->room_number}}">--}}
{{--            </div>--}}

            <div class="form-group">
                <label>Room Number</label>
                @if(!empty($room))
                    <select name="room_id" class="form-control">
                        <option value="{{$room->id}}">{{$room->room_number}}</option>
                    </select>
                @endif
            </div>

            <div class='form-group'>
                <label>Image</label>
                <input type="file" class='form-control' name='images[]' multiple >
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Create</button>
            </div>
        </form>
    </div>
@endsection
