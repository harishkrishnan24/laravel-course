@extends('layout')

@section('content')
<h1>{{ __('messages.welcome') }}</h1>
{{-- <h1>@lang('messages.welcome')</h1> --}}

<p>{{ __('messages.example_with_value', ['name' => 'John']) }}</p>

<p>{{ trans_choice('messages.plural', 0, ['a' => 1]) }}</p>
<p>{{ trans_choice('messages.plural', 1, ['a' => 1]) }}</p>
<p>{{ trans_choice('messages.plural', 2, ['a' => 1]) }}</p>

<p>{{ __('Welcome to Laravel') }}</p>
<p>{{ __('Hello :name', ['name' => 'John']) }}</p>

<p>This is the content of the main page!</p>
@endsection
