<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review = $course->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('courses.show', $course)->with('success', 'Review submitted successfully.');
    }

    public function update(Request $request, Course $course, Review $review)
    {
        $this->authorize('update', $review);

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        $review->update($validated);

        return redirect()->route('courses.show', $course)->with('success', 'Review updated successfully.');
    }

    public function destroy(Course $course, Review $review)
    {
        $this->authorize('delete', $review);

        $review->delete();

        return redirect()->route('courses.show', $course)->with('success', 'Review deleted successfully.');
    }
}
