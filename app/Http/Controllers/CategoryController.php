<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function products($id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['message' => 'Category not found'], 404);

        return response()->json($category->products()->paginate(15), 200);

    }


    public function index()
    {
        return response()->json(Category::all(), 200);
    }
}
