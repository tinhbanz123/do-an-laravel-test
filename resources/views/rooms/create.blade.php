@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Room Create</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('room.store')}}" method='post'>
            @csrf
            <div class='form-group'>
                <label>Room Number</label>
                <input type="text" class='form-control' name='number'>
            </div>

            <div class='form-group'>
                <label>Description</label>
                <input type="text" class='form-control' name='description'>
            </div>

            <div class='form-group'>
                <label>Price</label>
                <input type="text" class='form-control' name='price'>
            </div>

            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Create</button>
            </div>
        </form>
    </div>
@endsection
