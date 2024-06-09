<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    

    public function index()
    {
        return News::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required',
            'content' => 'required',
            'published_at' => 'nullable|date',
            'slug' => 'required|unique:news',
        ]);

        return News::create($request->all());
    }

    public function show($id)
    {
        return News::find($id);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        $validatedData = $request->validate([
            'category_id' => 'required|exists:news_categories,id',
            'title' => 'required',
            'content' => 'required',
            'published_at' => 'nullable|date',
            'slug' => 'required|unique:news,slug,' . $slug . ',slug',
        ]);

        $slug = Str::slug($request->input('title'));

               
        $news->update([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'slug' => $slug,
            
        ]);

       // $news->update($request->all());

        return $news;
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return response()->json(['message' => 'News deleted successfully']);
    }
};


