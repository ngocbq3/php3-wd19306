@extends('admin.layout')

@section('title', 'Danh sách sản phẩm')

@section('content')

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="b-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control">
        </div>
        <div class="b-3">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}" @selected($cate->id == $product->category_id)>
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="b-3">
            <label for="" class="form-label">Price</label>
            <input type="number" name="price" value="{{ $product->price }}" step="0.1" class="form-control">
        </div>
        <div class="b-3">
            <label for="" class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control">
        </div>
        <div class="b-3">
            <label for="" class="form-label">Image</label> <br>
            <img src="{{ Storage::URL($product->image) }}" width="100" alt="">
            <input type="file" name="image" id="" class="form-control">
        </div>
        <div class="b-3">
            <label for="" class="form-label">Description</label>
            <textarea name="description" rows="10" class="form-control">{{ $product->description }}</textarea>
        </div>
        <div class="b-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

@endsection
