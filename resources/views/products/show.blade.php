<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container w-75">
        <h2>{{ $product->name }}</h2>
        <div>
            Category: {{ $product->cate_name }}
        </div>
        <img src="{{ $product->image }}" width="150" alt="">
        <div>
            Price: {{ $product->price }}
        </div>
        <p>
            {{ $product->description }}
        </p>
    </div>
</body>

</html>
