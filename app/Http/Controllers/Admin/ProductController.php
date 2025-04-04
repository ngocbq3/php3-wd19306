<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Query builder
        // $products = DB::table('products')
        //     ->join('categories', 'categories.id', '=', 'products.category_id')
        //     ->select(['products.*', 'categories.name as cate_name'])
        //     ->orderBy('products.id', 'desc')
        //     ->paginate(10);

        //Eloquent ORM
        //Lấy tất cả sản phẩm
        $products = Product::all();
        //Phân trang và sắp xếp
        $products = Product::with('category')
            ->orderBy('id', 'DESC')
            ->paginate(10);
        // return $products;

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Query builder
        // $categories = DB::table('categories')->get();

        //Eloquent ORM
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // dd($request->all());
        // $data = $request->except('_token');//loại bỏ input _token

        $data = $request->all();

        //Xử lý ảnh
        if ($request->hasFile('image')) {

            $path_image = $request->file('image')->store('images');
        }
        $data['image'] = $path_image ?? '';

        // DB::table('products')->insert($data);//Query builder

        Product::query()->create($data); //Eloquent ORM

        return redirect()->route('products.index')->with('message', 'Thêm dữ liệu thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // DB::table('products')->delete($id);

        $product = Product::query()->find($id);

        if (Storage::fileExists($product->image)) {
            Storage::delete($product->image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('message', 'Xóa dữ liệu thành công');
    }
}
