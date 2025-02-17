<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $category = request('category');
        $query = Blog::where('is_published', true);

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        $blogs = $query->orderBy('created_at', 'desc')->paginate(12);

        // Get unique categories for the filter
        $categories = Blog::where('is_published', true)
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        return view('blogs.index', compact('blogs', 'categories', 'category'));
    }

    public function adminIndex()
    {
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'youtube_link' => 'nullable|url',
            'gallery_images.*' => 'nullable|image|max:2048',
            'category' => 'required',
            'tags' => 'nullable|array',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);
        $validated['user_id'] = auth()->id();

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('blogs/gallery', 'public');
            }
            $validated['gallery_images'] = $gallery;
        }

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully.');
    }

    public function show(Blog $blog)
    {
        if (!$blog->is_published && !auth()->user()?->is_admin) {
            abort(404);
        }

        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'youtube_link' => 'nullable|url',
            'gallery_images.*' => 'nullable|image|max:2048',
            'category' => 'required',
            'tags' => 'nullable|array',
            'is_published' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('blogs/featured', 'public');
        }

        if ($request->hasFile('gallery_images')) {
            if ($blog->gallery_images) {
                foreach ($blog->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $gallery = [];
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('blogs/gallery', 'public');
            }
            $validated['gallery_images'] = $gallery;
        }

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        if ($blog->gallery_images) {
            foreach ($blog->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
