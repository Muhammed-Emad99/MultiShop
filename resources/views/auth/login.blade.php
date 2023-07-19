@extends('layout.general')
@section('title')
    Login
@endsection

@section('content')
    <div class="container-fluid p-5">

        <form action="{{route('auth.login')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" aria-describedby="emailHelp">
                @error('email')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
                @error('userNotFound')
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

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection
