@extends('layout.general')
@section('title')
    Create Category
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="{{route('categories.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                @error('name')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label"><b>Profile Photo</b></label>
                <div class="col-10 d-flex justify-content-center flex-column">
                    <p>Accepted file type .png. Less than 1MB </p>
                    <input type='file' id="image" name="image">
                </div>
                @error('image')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>
            @if(count($categories) > 0 )
                <div class="mb-3">
                    <label for="parent_id" class="form-label">Parent Category</label>
                    <select name="parent_id" id="parent_id" class="form-control" value="{{old('parent_id')}}">
                        <option value="{{null}}">------</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('parent_id')
                    <div class="text-danger mt-3"> {{$message}} </div>
                    @enderror
                </div>
            @endif


            <button type="submit" class="btn btn-primary">Add Category</button>
        </form>
    </div>
@endsection
