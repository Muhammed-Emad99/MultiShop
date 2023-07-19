@extends('layout.general')
@section('title')
    User Profile
@endsection
@section('content')
    <div class="container-fluid pt-5">
        <div class="wrapper bg-white mt-sm-5 p-5">
            <h4 class="pb-4 border-bottom">Account settings</h4>
            <form method="POST" action="{{route('auth.update',['user'=>$user])}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="image" class="form-label"><b>Profile Photo</b></label>
                    <div class="row">
                        <div class="col-2">
                            @if ($user->image)
                                <img id="uploadedImage" class="" height="200" src="{{asset('uploads/users/'.$user->image)}}">
                            @endif
                        </div>
                        <div class="col-10 d-flex justify-content-center flex-column">
                            <p>Accepted file type .png. Less than 1MB </p>
                            <input type='file' id="image" name="image">
                        </div>
                    </div>
                    @error('image')
                    <div class="text-danger mt-3"> {{$message}} </div>
                    @enderror
                </div>
                <div class="py-2">
                    <div class="row py-2">
                        <div class="col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="bg-light form-control" id="name" name="name"
                                   value="{{$user->name}}">
                            @error('name')
                            <div class="text-danger mt-3"> {{$message}} </div>
                            @enderror
                        </div>
                        <div class="col-md-6 pt-md-0 pt-3">
                            <label for="email">Email</label>
                            <input type="email" class="bg-light form-control" id="email" name="email"
                                   value="{{$user->email}}">
                            @error('email')
                            <div class="text-danger mt-3"> {{$message}} </div>
                            @enderror
                        </div>
                    </div>
                    <div class="py-3 pb-4 border-bottom">
                        <button class="btn btn-primary mr-3">Save Changes</button>
                        <a href="{{route('/')}}" class="btn border button">Cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection

