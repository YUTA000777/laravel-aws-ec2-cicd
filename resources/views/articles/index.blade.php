@extends('app')

@section('title', '記事一覧')

@section('content')
  @include('nav')
  <div class="container mb-5">
    @foreach($articles as $article)
    @include('articles.card')
    @endforeach
  {{$articles->links()}}
  </div>
@endsection