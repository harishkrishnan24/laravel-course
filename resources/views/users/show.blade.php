@extends('layout')

@section('content')
        <div class="row">
            <div class="col-4">
                <img class="img-thumbnail avatar" src="{{ $user->image ?$user->image->url(): '' }}" />
            </div>
            <div class="col-8">
                <h3>{{ $user->name }}</h3>

                @commentForm(['route' => route('users.comments.store', ['user' => $user->id])])
                @endcommentForm
                    @commentList(['comments' => $user->commentsOn])
                @endcommentList
            </div>
        </div>
@endsection
