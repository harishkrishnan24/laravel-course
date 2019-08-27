<?php

namespace App\Observers;

use App\BlogPost;
use Illuminate\Support\Facades\Cache;

class BlogPostObserver
{

    public function updating(BlogPost $blogPost)
    {
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    public function deleting(BlogPost $blogPost)
    {
        $blogPost->comments()->delete();
        Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    }

    /**
     * Handle the blog post "restored" event.
     *
     * @param  \App\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        $blogPost->comments()->restore();
    }
}
