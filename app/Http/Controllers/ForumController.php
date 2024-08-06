<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\ForumPost;
use App\Models\ForumThread;
use Illuminate\Http\Request;
use App\Notifications\NewForumPost;

class ForumController extends Controller
{
    public function index(Course $course)
    {
        $threads = $course->forumThreads()->paginate(15);
        return view('forum.index', compact('course', 'threads'));
    }

    public function show(Course $course, ForumThread $thread)
    {
        $posts = $thread->posts()->paginate(20);
        return view('forum.show', compact('course', 'thread', 'posts'));
    }

    public function storeThread(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $thread = $course->forumThreads()->create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('forum.show', [$course, $thread])
            ->with('success', 'Thread created successfully.');
    }

    public function storePost(Request $request, Course $course, ForumThread $thread)
{
    $validated = $request->validate([
        'content' => 'required|string',
    ]);

    $post = $thread->posts()->create([
        'user_id' => auth()->id(),
        'content' => $validated['content'],
    ]);

    // Notify all users following this thread
    foreach ($thread->followers as $follower) {
        $follower->notify(new NewForumPost($post));
    }

    return redirect()->route('forum.show', [$course, $thread])
        ->with('success', 'Reply posted successfully.');
}

    public function editPost(Course $course, ForumThread $thread, ForumPost $post)
    {
        $this->authorize('update', $post);
        return view('forum.edit-post', compact('course', 'thread', 'post'));
    }

    public function updatePost(Request $request, Course $course, ForumThread $thread, ForumPost $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('forum.show', [$course, $thread])
            ->with('success', 'Post updated successfully.');
    }

    public function destroyPost(Course $course, ForumThread $thread, ForumPost $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()->route('forum.show', [$course, $thread])
            ->with('success', 'Post deleted successfully.');
    }
}
