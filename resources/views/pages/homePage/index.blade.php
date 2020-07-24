@extends('pages/layouts/index')

@section('title', 'Home')


@section('content')
    @foreach($posts as $post)
        <div class="post">
            <h4>
                <a href="{{ url(route('postPage', ['post_slug' => $post->slug])) }}" class="post-link text-decoration-none">{{ $post->title }}</a>
            </h4>
        </div>

    @endforeach
@endsection
