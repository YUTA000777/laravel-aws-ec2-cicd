@extends('app')

@section('content')
@include('nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('comments.update', $article->id) }}" method="POST">
            @csrf
            @method('PATCH')
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" rows="10" name="body">{{ $article->body }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">更新する</button>
            </form>
        </div>
    </div>
</div>
@endsection