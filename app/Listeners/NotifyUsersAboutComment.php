<?php

namespace App\Listeners;

use App\Jobs\ThrottledMail;
use App\Events\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\NotifyUsersPostWasCommented;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyUsersAboutComment
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        ThrottledMail::dispatch(new CommentPostedMarkdown($event->comment), $event->comment->commentable->user)->onQueue('high');

        NotifyUsersPostWasCommented::dispatch($event->comment)->onQueue('low');
    }
}
