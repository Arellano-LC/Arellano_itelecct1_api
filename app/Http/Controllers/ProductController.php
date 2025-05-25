<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // If 'all' param is set, return all products (no pagination)
        if ($request->has('all')) {
            return response()->json(['data' => $query->get()], 200);
        }

        // Default: paginated
        return response()->json($query->paginate(15), 200);
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->user_id = $request->user_id;

        // ✅ Correct image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return response()->json([
            'message' => "Product successfully saved",
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        // Try to find as a product first
        $product = Product::find($id);
        if ($product) {
            return response()->json($product, 200);
        }

        // If not found as a product, try as a user_id
        $userProducts = Product::where('user_id', $id)->get();
        if ($userProducts->count() > 0) {
            return response()->json(['data' => $userProducts], 200);
        }

        return response()->json(['message' => 'Product(s) not found'], 404);
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $path = $request->file('image')->store('products', 'public');
            $product->image_path = $path;
        }

        $product->save();

        return response()->json([
            'message' => 'Product successfully updated',
            'product' => $product
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id);
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);

        $product->delete();
        return response()->json(['message' => 'Product deleted'], 200);

    }
}
