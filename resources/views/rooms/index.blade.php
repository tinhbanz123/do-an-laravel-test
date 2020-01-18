@extends('layouts.content')

@section('content')
    <div class="container">
        <h1>Room List</h1>

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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('room.create') }}" class="btn btn-success">Create Room</a>
        @if(empty($rooms))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>Room Number</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th colspan="3">Action</th>
                </tr>
                @foreach($rooms as $value)
                    <tr>
                        <td>{{ $value->id}}</td>
                        <td>{{ $value->room_number }}</td>
                        <td>{{ $value->description }}</td>
                        <td>{{ ($value->status == 0) ? 'còn phòng' : 'hết phòng' }}</td>
                        <td>{{ $value->price . ' / ngày' }}</td>
                        <td><a href="{{ route('room.show', $value->id) }}" class="btn btn-success">Detail</a></td>
                        <td><a href="{{ route('room.edit', $value->id) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('room.destroy', $value->id) }}" method="post">
                                @csrf
                                 <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

{{--            paginate--}}

            <div class="text-center">
                {{ $rooms->appends(request()->all())->links() }}
            </div>
        @endif
    </div>

    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/room.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('assets/room.js') }}"></script>
    @endpush
