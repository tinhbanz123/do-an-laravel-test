@extends('layouts.content');
@section('content')
    <div class='container'>
        <h1>Customer Create</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('customer.store')}}" method='post'>
            @csrf
            <div class='form-group'>
                <label>First Name</label>
                <input type="text" class='form-control' name='first'>
            </div>

            <div class='form-group'>
                <label>Last Name</label>
                <input type="text" class='form-control' name='last'>
            </div>

            <div class='form-group'>
                <label>Address</label>
                <input type="text" class='form-control' name='address'>
            </div>

            <div class='form-group'>
                <label>Phone</label>
                <input type="text" class='form-control' name='phone'>
            </div>

            <div class='form-group'>
                <label>Email</label>
                <input type="email" class='form-control' name='email'>
            </div>


            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Create</button>
            </div>
        </form>
    </div>
@endsection
