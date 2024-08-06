<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function getThreads(Course $course)
    {
        $threads = $course->forumThreads()->with('user')->paginate(15);
        return response()->json($threads);
    }

    public function createThread(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required'
        ]);

        $thread = $course->forumThreads()->create([
            'user_id' => $request->user()->id,
            'title' => $validatedData['title'],
            'content' => $validatedData['content']
        ]);

        return response()->json($thread, 201);
    }

    public function getThread(ForumThread $thread)
    {
        $thread->load(['user', 'posts.user']);
        return response()->json($thread);
    }

    public function createPost(Request $request, ForumThread $thread)
    {
        $validatedData = $request->validate([
            'content' => 'required'
        ]);

        $post = $thread->posts()->create([
            'user_id' => $request->user()->id,
            'content' => $validatedData['content']
        ]);

        return response()->json($post, 201);
    }
}
