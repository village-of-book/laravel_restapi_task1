@extends('layout')

@section('content')
<div class="container mt -5">
    <h2>新規投稿</h2>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="md-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="md-3">
            <label for="content" class="form-label">内容</label>
            <textarea name="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">投稿</button>
    </form>
    <div class="mt-3">
        <a href="{{route('posts.index')}}" class="btn btn-secondary">戻る</a>
    </div>

@endsection