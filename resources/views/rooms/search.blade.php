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
        <form action="{{ route('findroom.show_rooms')}}" method='get'>
            @csrf
            <div class='form-group'>
                <label>Time from *</label>
                <input type="date" class="form-control" name="time_from" required >
            </div>

            <div class='form-group'>
                <label>Time to *</label>
                <input type="date" class='form-control' name='time_to' required>
            </div>


            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Search</button>
            </div>
        </form>
    </div>
@endsection
