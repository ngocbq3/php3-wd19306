<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function show($id)
    {
        $products = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select(['products.*', 'categories.name as cate_name'])
            ->where('products.category_id', $id)
            ->orderBy('products.id', 'desc')
            ->paginate(10);

        $categories = DB::table('categories')->get();
        return view('products.index', compact('products', 'categories'));
    }
}
