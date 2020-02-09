@extends('layouts.content')

@section('content')
    <div class="container">
        <h1>Customer List</h1>

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

        <a href="{{ route('customer.create') }}" class="btn btn-success">Create Customer</a>
        @if(empty($customers))
            <p>Not found data</p>
        @else
            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Mail</th>
                    <th>Password</th>
                    <th colspan="3">Action</th>
                </tr>
                @foreach($customers as $value)
                    <tr>
                        <td>{{ $value->id}}</td>
                        <td>{{ $value->first_name }}</td>
                        <td>{{ $value->last_name }}</td>
                        <td>{{ $value->address }}</td>
                        <td>{{ $value->phone }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->pass_no_hash }}</td>
                        <td><a href="{{ route('customer.show', $value->id) }}" class="btn btn-success">Detail</a></td>
                        <td><a href="{{ route('customer.edit', $value->id) }}" class="btn btn-primary">Edit</a></td>
                        <td>
                            <form action="{{ route('customer.destroy', $value->id) }}" method="post">
                                @csrf
                                <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            {{--            paginate--}}

                <div class="text-center">
                    {{ $customers->appends(request()->all())->links() }}
                </div>
        @endif
    </div>
@endsection
    @push('css')
        <link rel="stylesheet" href="{{ asset('assets/room.css') }}">
    @endpush

    @push('js')
        <script src="{{ asset('assets/room.js') }}"></script>
    @endpush
