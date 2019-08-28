<?php

namespace App\Listeners;

use App\User;
use App\Events\BlogPostPosted;
use App\Jobs\ThrottledMail;
use App\Mail\BlogPostAdded;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminWhenBlogPostCreated
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(BlogPostPosted $event)
    {
        User::thatIsAnAdmin()->get()
        ->map(function(User $user){
            ThrottledMail::dispatch(new BlogPostAdded(), $user);
        });
    }
}
