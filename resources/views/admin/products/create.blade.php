@extends('admin.layout')

@section('title', 'Danh sách sản phẩm')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="b-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="b-3">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="" class="form-control">
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}">
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="b-3">
            <label for="" class="form-label">Price</label>
            <input type="number" name="price" step="0.1" value="{{ old('price') }}" class="form-control">
        </div>
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="b-3">
            <label for="" class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
        </div>
        @error('stock')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="b-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="image" id="" class="form-control">
        </div>
        @error('image')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="b-3">
            <label for="" class="form-label">Description</label>
            <textarea name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="b-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>

@endsection
