<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'slug' => 'required|unique:news_categories',
        ]);

        return Category::create($request->all());
    }

    public function show($id)
    {
        return Category::find($id);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'slug' => 'required|unique:news_categories,slug,'.$id,
        ]);

        $category->update($request->all());

        return $category;
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
