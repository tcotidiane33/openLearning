<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\ForumPost;

class NewForumPost extends Notification
{
    use Queueable;

    protected $forumPost;

    public function __construct(ForumPost $forumPost)
    {
        $this->forumPost = $forumPost;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('A new post has been added to a forum thread you\'re following.')
                    ->action('View Post', url('/forum/threads/' . $this->forumPost->thread_id))
                    ->line('Thank you for using our application!');
    }

    public function toArray($notifiable)
    {
        return [
            'post_id' => $this->forumPost->id,
            'thread_id' => $this->forumPost->thread_id,
            'user_id' => $this->forumPost->user_id,
            'message' => 'New post in forum thread: ' . $this->forumPost->thread->title,
        ];
    }
}
