<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->orderBy('id', 'desc')
            ->paginate(10);
        return response()->json(
            [
                'message' => 'List of products',
                'data' => $products
            ],
            200
        );
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Không có sản phẩm có ID=' . $id
                ],
                404
            );
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Product details for ID: ' . $id,
                'data' => $product
            ],
            200
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Dữ liệu nhập vào lỗi',
                    'errors' => $validate->errors()
                ],
                422
            );
        }

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
        }
        $data['image'] = $path_image ?? null;
        $product = Product::query()->create($data);

        return response()->json(
            [
                'success' => true,
                'message' => 'Product created successfully',
                'data' => $product
            ],
            201
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validate = Validator::make($data, [
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        if ($validate->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Dữ liệu nhập vào lỗi',
                    'errors' => $validate->errors()
                ],
                422
            );
        }
        // Find the product by ID
        $product = Product::find($id);
        if (!$product) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Không có sản phẩm có ID=' . $id
                ],
                404
            );
        }
        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $path_image = $request->file('image')->store('images');
            $data['image'] = $path_image;
        }

        // Update the product with the new data
        $product->update($data);
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật sản phẩm thành công cho ID: ' . $id,
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::find($id);
        if (!$product) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Không có sản phẩm có ID=' . $id
                ],
                404
            );
        }
        // Delete the product
        $product->delete();
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Xóa dữ liệu thành công cho ID: ' . $id
        ], 200);
    }
}
