@extends('layout.general')
@section('title')
    Register
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form method="post" action="{{route('auth.store')}}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                @error('name')
                <div class="text-danger mt-2"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp">
                @error('email')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}">
                @error('password')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection
