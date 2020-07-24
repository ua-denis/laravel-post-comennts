@extends('pages/layouts/index')

@section('title', 'Post')


@section('content')
    @foreach($post as $post_item)
        <div class="post">
            <h4>
                {{ $post_item->title }}
            </h4>
            <div class="post-content">{{ $post_item->description }}</div>
        </div>
        <div id="post-comments-section" class="mt-5">
            <post-comments :post-id="{{$post_item->id}}" />
        </div>
    @endforeach
@endsection
