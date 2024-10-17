@extends('layouts.app')

@section('content')
    <h1>Create Product</h1>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
@endsection

Luego Creamos el archivo edit.blade
@extends('layouts.app')

@section('content')
    <h1>Edit Product</h1>
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ $product->price }}" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" width="100">
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
