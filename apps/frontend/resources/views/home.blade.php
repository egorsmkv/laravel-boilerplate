@extends('layouts.app')

@section('title', __('main.index'))

@section('content')

    <div class="mx-auto max-w-screen-sm text-center">
        <p class="mb-4 text-3xl tracking-tight font-bold text-gray-900 md:text-4xl dark:text-white">
            This is the index page
        </p>
        <p class="mb-4 text-lg font-light text-gray-500 dark:text-gray-400">
            RPC result: <b>{{ $currentDate }}</b> (from the Go service)
        </p>
    </div>

@endsection
