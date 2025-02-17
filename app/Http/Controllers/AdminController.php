<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Admission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function dashboard()
    {
        $stats = [
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::where('is_published', true)->count(),
            'draft_blogs' => Blog::where('is_published', false)->count(),
            'total_admissions' => Admission::count(),
            'pending_admissions' => Admission::where('status', 'pending')->count(),
            'approved_admissions' => Admission::where('status', 'approved')->count(),
            'rejected_admissions' => Admission::where('status', 'rejected')->count(),
        ];

        $recent_blogs = Blog::latest()->take(5)->get();
        $recent_admissions = Admission::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_blogs', 'recent_admissions'));
    }
}
