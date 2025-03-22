<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-75">
        <ul>
            @foreach ($categories as $cate)
                <li>
                    <a href="{{ route('category.show', $cate->id) }}">
                        {{ $cate->name }}
                    </a>
                </li>
            @endforeach
        </ul>
        <h1>Danh sách sản phẩm</h1>
        <hr>
        @foreach ($products as $product)
            <div>
                <a href="{{ route('products.show', $product->id) }}">
                    <h3>{{ $product->name }}</h3>
                </a>
                <span>Category: {{ $product->cate_name }}</span>
            </div>
            <hr>
        @endforeach

        {{ $products->links() }}
    </div>
</body>

</html>
