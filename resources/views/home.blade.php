@extends('layouts.content')

@section('content')
    <a href="{{ route('search-room.find_rooms') }}" class="btn btn-success" style="margin: 10px;">Search Room</a>
{{--    {{ dd(session('customer')) }}--}}
{{--    <a href="{{ route('room.index') }}" class="btn btn-success" style="margin: 10px;">Room</a>--}}
@endsection
