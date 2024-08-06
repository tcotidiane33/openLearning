<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');
        $tag = $request->input('tag');

        $courses = Course::query()
            ->where('is_published', true)
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'like', "%{$query}%")
                         ->orWhere('description', 'like', "%{$query}%");
            })
            ->when($category, function ($q) use ($category) {
                return $q->where('category_id', $category);
            })
            ->when($tag, function ($q) use ($tag) {
                return $q->whereHas('tags', function ($q) use ($tag) {
                    $q->where('tags.id', $tag);
                });
            })
            ->paginate(12);

        return view('search.results', compact('courses', 'query', 'category', 'tag'));
    }
}
