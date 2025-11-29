<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with(['user', 'category'])->latest()->get();
        return view('admin.pages.manage-news', compact('news'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.pages.create-news', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::id()
        ];

        // Handle image upload
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('news-images', 'public');
            $data['image_path'] = $imagePath;
        }

        News::create($data);

        return redirect()->route('admin.manage-news')->with('success', 'News created successfully');
    }

    public function edit(News $news)
    {
        $categories = Category::all();
        return view('admin.pages.edit-news', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'nullable|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id
        ];

        // Handle image upload
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }

            $imagePath = $request->file('image_path')->store('news-images', 'public');
            $data['image_path'] = $imagePath;
        }

        $news->update($data);

        return redirect()->route('admin.manage-news')->with('success', 'News updated successfully');
    }

    public function destroy(News $news)
    {
        // Delete image if exists
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();
        return redirect()->route('admin.manage-news')->with('success', 'News deleted successfully');
    }
}
