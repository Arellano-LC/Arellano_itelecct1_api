<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     * If 'all' param is set, returns all products without pagination.
     * Otherwise, returns paginated products.
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
     * Handles image upload and saves product details.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name; // Set product name
        $product->description = $request->description; // Set product description
        $product->price = $request->price; // Set product price
        $product->category_id = $request->category_id; // Set category
        $product->user_id = $request->user_id; // Set user who created the product

        // ✅ Correct image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); // Store image in 'products' directory
            $product->image_path = $path; // Save image path
        }

        $product->save(); // Save product to database

        return response()->json([
            'message' => "Product successfully saved",
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified product.
     * If not found by product id, tries to find products by user_id.
     */
    public function show(string $id)
    {
        
        $userProducts = Product::where('user_id', $id)->get();
        if ($userProducts->count() > 0) {
            return response()->json(['data' => $userProducts], 200);
        }
        return response()->json(['message' => 'Product(s) not found'], 404);
    }

    /**
     * Update the specified product in storage.
     * Handles updating product details and image replacement.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id); // Find product by id
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);

        $product->name = $request->name; // Update name
        $product->description = $request->description; // Update description
        $product->price = $request->price; // Update price
        $product->category_id = $request->category_id; // Update category

        // Handle image update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path); // Remove old image
            }
            $path = $request->file('image')->store('products', 'public'); // Store new image
            $product->image_path = $path; // Update image path
        }

        $product->save(); // Save changes

        return response()->json([
            'message' => 'Product successfully updated',
            'product' => $product
        ], 200);
    }

    /**
     * Remove the specified product from storage.
     * Deletes the product by id.
     */
    public function destroy(string $id)
    {
        //
        $product = Product::find($id); // Find product by id
        if (!$product)
            return response()->json(['message' => 'Product not found'], 404);

        $product->delete(); // Delete product
        return response()->json(['message' => 'Product deleted'], 200);

    }

    /**
     * Get all products for a specific user.
     */
    public function userProducts($user_id)
    {
        $products = Product::where('user_id', $user_id)->get(); // Find products by user_id
        return response()->json(['data' => $products], 200);
    }
}
