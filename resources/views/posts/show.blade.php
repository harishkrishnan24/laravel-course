@extends('layout')

@section('content')
<div class="row">
    <div class="col-8">
        @if ($post->image)
        <div style="background-image: url('{{ $post->image->url() }}'); min-height: 500px; color: white; text-align:center; background-attachment: fixed;">
            <h1 style="padding-top: 100px;text-shadow: 1px 2px #000;">
        @else
            <h1>
        @endif
                {{ $post->title }}
        @badge(['show' =>now()->diffInMinutes($post->created_at) < 30])
            New!
        @endbadge
        @if ($post->image)
            </h1>
        </div>
        @else
            </h1>
        @endif
    <p>{{ $post->content }}</p>

    {{-- <img src="http://localhost:8000/storage/{{ $post->image->path }}"> --}}
    {{-- <img src="{{ asset($post->image->path )}}"> --}}
    {{-- <img src="{{ $post->image->url() }}" /> --}}

    @updated(['date' => $post->created_at, 'name' => $post->user->name])
    @endupdated
    @updated(['date' => $post->updated_at])
    Updated
    @endupdated

    @tags(['tags' => $post->tags])@endtags

    <p>{{ trans_choice('messages.people.reading', $counter) }}</p>

    <h4>Comments</h4>
    @commentForm(['route' => route('posts.comments.store', ['post' => $post->id])])
    @endcommentForm
    @commentList(['comments' => $post->comments])
    @endcommentList
    </div>
    <div class="col-4">
        @include('posts._activity')
    </div>
</div>
@endsection('content')
