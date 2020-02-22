@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Room Edit</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('room.update',$room->id)}}" method='post' enctype="multipart/form-data">
            @csrf
            <div class='form-group'>
                <label>Room Number</label>
                <input type="text" class='form-control' name='number' value="{{ old('room_number',$room->room_number) }}">
            </div>

            <div class='form-group'>
                <label>Description</label>
                <input type="text" class='form-control' name='description' value="{{ old('description',$room->description) }}">
            </div>

            <div class='form-group'>
                <label>Price</label>
                <input type="text" class='form-control' name='price' value="{{ old('price',$room->price) }}">
            </div>

            <div class='form-group'>
                <label>Image</label>
                <input type="file" class='form-control' name='image' >
                <input type="hidden" name="old_img" value="{{ old('image',$room->image) }}" >
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Update</button>
            </div>
        </form>
    </div>
@endsection
