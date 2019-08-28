<?php

namespace App\Http\Controllers;

use App\BlogPost;
use App\Events\CommentPosted as AppCommentPosted;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUsersPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostedMarkdown;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request)
    {
        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        event(new AppCommentPosted($comment));

        // Mail::to($post->user)->send(
        //     new CommentPostedMarkdown($comment)
        // );
        // $when = now()->addMinutes(1);

        // Mail::to($post->user)->queue(
        //     new CommentPostedMarkdown($comment)
        // );

        // Mail::to($post->user)->later(
        //     $when,
        //     new CommentPostedMarkdown($comment)
        // );

        return redirect()->back()->withStatus('Comment was created!');
    }
}
