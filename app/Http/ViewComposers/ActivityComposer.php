<?php

namespace App\Http\ViewComposers;

use App\BlogPost;
use Illuminate\View\View;
use App\User;
use Illuminate\Support\Facades\Cache;

class ActivityComposer
{
    public function compose(View $view)
    {
        $mostCommented = Cache::tags(['blog-post'])->remember('blog-post-commented', 60, function () {
            return BlogPost::mostCommented()->take(5)->get();
        });
        $mostActive = Cache::tags(['blog-post'])->remember('users-most-active', 60, function () {
            return User::withMostBlogPost()->take(5)->get();
        });
        $mostActiveLastMonth = Cache::tags(['blog-post'])->remember('users-most-active-last-month', 60, function () {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActive', $mostActive);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
