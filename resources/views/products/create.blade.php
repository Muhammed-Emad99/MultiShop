@extends('layout.general')
@section('title')
    Create Product
@endsection

@section('content')
    <div class="container-fluid p-5">
        <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                @error('name')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description"
                       value="{{old('description')}}">
                @error('description')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="{{old('price')}}">
                @error('price')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}">
                @error('quantity')
                <div class="text-danger mt-3"> {{$message}} </div>
                @enderror
            </div>
            <div class="mb-3 d-flex">
                <div class="col-6 d-flex p-0">
                    <div class="col-2 p-0">
                        <label for="featured" class="form-label">Featured</label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="yes" name="featured" value="1">
                        <label for="yes" class="form-label">Yes</label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="no" name="featured" value="0" checked>
                        <label for="no" class="form-label">No</label>
                    </div>
                </div>
                <div class="col-6 d-flex p-0">
                    <div class="col-2">
                        <label for="recent" class="form-label">Recent</label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="yes" name="recent" value="1">
                        <label for="yes" class="form-label">Yes</label>
                    </div>
                    <div class="col-4">
                        <input type="radio" class="form-check-input" id="no" name="recent" value="0" checked>
                        <label for="no" class="form-label">No</label>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category ID</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
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

            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
@endsection
