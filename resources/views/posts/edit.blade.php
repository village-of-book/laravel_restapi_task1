@extends('layout')

@section('content')
<div class="container mt -5">
    <h2>投稿編集</h2>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="md-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" required>
        </div>
        <div class="md-3">
            <label for="content" class="form-label">内容</label>
            <textarea name="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">更新</button>
        <a href="{{route('posts.index')}}" class="btn btn-secondary">戻る</a>
</form>
@endsection