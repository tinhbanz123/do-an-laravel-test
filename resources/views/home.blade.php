@extends('layouts.content')

@section('content')
    <a href="{{ route('room.find_rooms') }}" class="btn btn-success" style="margin: 10px;">Search Room</a>
    <a href="{{ route('room.index') }}" class="btn btn-success" style="margin: 10px;">Room</a>
@endsection
