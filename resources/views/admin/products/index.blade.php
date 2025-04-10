@extends('admin.layout')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div>
        @session('message')
            <div class="alert text-success">
                {{ session('message') }}
            </div>
        @endsession
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category Name</th>
                    <th>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create</a>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <th>{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>
                            <img src="{{ Storage::URL($product->image) }}" width="90" alt="">
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>

                            <form class="d-inline" action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Bạn có chắc chắn xóa không?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links() }}
    </div>
@endsection
