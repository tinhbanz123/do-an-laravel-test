@extends('layouts.content');
@section('content')
{{--    <div class='container'>--}}
{{--        <h1>Room Details</h1>--}}
{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        @if(empty($room))--}}
{{--            <p>Not found data</p>--}}
{{--        @else--}}
{{--            <table class="table table-bordered table-striped">--}}
{{--                <tr>--}}
{{--                    <th>ID</th>--}}
{{--                    <th>Room Number</th>--}}
{{--                    <th>Description</th>--}}
{{--                    <th>Status</th>--}}
{{--                    <th>Price</th>--}}
{{--                </tr>--}}
{{--                <tr>--}}
{{--                    <td>{{ $room->id}}</td>--}}
{{--                    <td>{{ $room->room_number }}</td>--}}
{{--                    <td>{{ $room->description }}</td>--}}
{{--                    <td>{{ ($room->status == 0) ? 'còn phòng' : 'hết phòng' }}</td>--}}
{{--                    <td>{{ number_format($room->price) . ' / ngày' }}</td>--}}
{{--                </tr>--}}
{{--            </table>--}}
{{--        @endif--}}

{{--        <a href="{{ route('search-room.find_rooms',['time_from' => $date['time_from'],'time_to' => $date['time_to']]) }}" class="btn btn-success">Back</a>--}}
{{--        <a href="{{ route('booking.create',['room_id' => $date['id'],'time_from' => $date['time_from'],'time_to' => $date['time_to']])}}" class="btn btn-primary">Book Room</a>--}}

{{--    </div>--}}

    <div class="container">
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

        <div class="row">
            <div class="col-lg-4">
                <div class="thumbnail">
                    <img src="{{ asset('/image_room/' . $room->image)}}" alt="{{$room->image}}" width="300px" height="300px">
                </div>
            </div>

            <div class="col-lg-8">
                <div class="caption">
                    <ul>
                        <li><h3>{{ $room->room_number }}</h3></li>
                        <li> <b>Description</b> : {{ $room->description }} </li>
                        <li>
                            <b style="color:red;">
                                Price : {{ number_format($room->price) . ' / ngày' }}
                            </b>
                        </li>
                    </ul>

                    <p>
                        <a href="{{ route('search-room.find_rooms',['time_from' => $date['time_from'],'time_to' => $date['time_to']]) }}" class="btn btn-success">Back</a>
                    </p>

                    <p>
                        <a href="{{ route('booking.create',['room_id' => $date['id'],'time_from' => $date['time_from'],'time_to' => $date['time_to']])}}" class="btn btn-primary">Book Room</a>
                    </p>
                </div>
            </div>
        </div>


        @if(!empty(count($slide)))
            <div class="slider-container">
                <div class="slider">
                    @foreach($slide as $key => $value)
                        <img src="{{ asset('/slide_room/' . $value->filename)}}" alt="{{$value->filename}}" title="Image room {{ $key + 1}} ">
                    @endforeach
                    <button type="button" onclick="getPrevImage()" class="btn" id="btnPrev">&lt;</button>
                    <button type="button" onclick="getNextImage()" class="btn" id="btnNext">&gt;</button>
                    <h1 id="titleSlider">Slide Title 1</h1>
                </div>
            </div>
        @endif
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/room.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/slide/css/slider.css') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/room.js') }}"></script>
    <script src="{{ asset('assets/slide/js/slider.js') }}"></script>
    <script>
        var indexCurrent = 0;      // Chỉ số hình đầu tiên hiển thị ở slide
        var loop = true;  // Bật hoặc tắt lặp lại slide
        var showbutton = true;  // Hiện 2 button điều hướng
        var duration = 12000;   // Thời gian chờ chuyển hình (tính theo đơn vị milisecond)
        initSlider();
    </script>
@endpush
