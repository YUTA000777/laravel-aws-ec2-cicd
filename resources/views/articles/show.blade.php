@extends('app')

@section('title', '記事詳細')

@section('content')
  @include('nav')
  <div class="container">
   <div class="card mt-3">
    <div class="card-body d-flex flex-row">
    <i class="fas fa-user-circle fa-3x mr-1"></i>
    <div>
      <div class="font-weight-bold">{{ $article->user->name }}</div>
      <div class="font-weight-lighter">{{ $article->created_at->format('Y/m/d H:i') }}</div>
    </div>

    @if( Auth::id() === $article->user_id )
      <div class="ml-auto card-text">
        <a  href="{{ route('articles.edit', ['article' => $article]) }}">
            <i class="fas fa-pen mr-1"></i>記事を更新する
        </a>
         <div class="dropdown-divider"></div>
         <a data-toggle="modal" data-target="#modal-delete-{{ $article->id }}">
            <i class="fas fa-trash-alt mr-1"></i>記事を削除する
         </a>
       </div>

      <!-- modal -->
      <div id="modal-delete-{{ $article->id }}" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('articles.destroy', ['article' => $article]) }}">
              @csrf
              @method('DELETE')
              <div class="modal-body">
                {{ $article->title }}を削除します。よろしいですか？
              </div>
              <div class="modal-footer justify-content-between">
                <a class="btn btn-outline-grey" data-dismiss="modal">キャンセル</a>
                <button type="submit" class="btn btn-danger">削除する</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- modal -->
    @endif
  </div>

  <div class="card-body pt-0">
    <h3 class="h4 card-title">
      <p class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
        {{ $article->title }}
      </ｐ>
    </h3>
    <div class="h5 card-body ">
      {!! nl2br(e( $article->body )) !!}
    </div>
    @if($article->image_path)
      <img src="{{ $article->image_path }}" alt="画像">
    @endif
  </div>
    <div class="card-body pt-0 pb-4 pl-4">
    <!-- JSONを使うことで結果を文字列ではなく値でcomponentに返す -->
    <!-- 未ログインのユーザーがいいねしようとした時の制御をVue側で行う -->
    <!-- endpointは文字列を返すためv-bindしない -->
      <article-like
        :initial-is-liked-by='@json($article->isLikedBy(Auth::user()))'
        :initial-count-likes='@json($article->count_likes)'
        :authorized='@json(Auth::check())'
        endpoint="{{ route('articles.like', ['article' => $article]) }}"
      >
      </article-like>
    </div>
 </div>

<div class="row justify-content-center mt-5">
        <div class="col-md-9">
            <form action="{{ route('comments.store') }}" method="POST">
            @csrf
	            <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="form-group">
                    <label>コメント</label>
                    <textarea class="form-control w-100" 
                     placeholder="内容" rows="5" name="body">{{old('body')}}</textarea>
                </div>
                @auth
                <button type="submit" class="btn btn-primary">コメントする</button>
                @endauth
            </form>
        </div>
    </div>
    @include('error_card_list')
    <div class="row justify-content-center mt-5">
        <div class="col-md-9">
            <!-- リレーションで投稿に紐づくコメントをループで表示 -->
            @foreach ($article->comments as $comment)
            <div class="card mt-3">
                <h5 class="card-header">投稿者：{{ $comment->user->name }}</h5>
                  <div class="card-body">
                    <p class="card-title">投稿日時：{{ $comment->created_at }}</p>
                    <h5 class="card-body pt-2 pb-2 pl-0">コメント内容：{{ $comment->body }}</h5>
                    @if(Auth::id()===$comment->user_id)
                        <a href="{{ route('comments.edit', $comment->id) }}"  class="text-dark btn btn-primary pt-2 pb-2">編集する</a>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method='post'>
                            @csrf
                            @method('DELETE')
                            <input type='submit' value='削除する' class="btn btn-danger pt-2 pb-2" onclick='return confirm("削除しますか？");'>
                        </form>
                    @endif
                 </div>
            </div>
            @endforeach
        </div>
    </div>
  </div>
@endsection