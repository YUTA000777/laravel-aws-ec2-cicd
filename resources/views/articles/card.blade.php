<div class="card mt-3">
  <div class="card-body d-flex flex-row">
    <i class="far fa-smile fa-3x mr-1"></i>
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
    <h3 class="h4 card-title mt-3">
      <p class="text-dark" >
        <strong>タイトル</strong>&emsp;{{ $article->title }}<hr>
      </ｐ>
    </h3>
    <div class="h5 card-body">
    <!--e 関数でエスケープ処理後 改行 -->
    <h4><strong>成長記録</strong></h4><hr>{!! nl2br(e( $article->body )) !!}<hr>
      @if($article->image_path)
      <img src="{{ $article->image_path }}" alt="画像">
      @endif
    </div>
  </div>
    <div class="card-body pt-0 pb-2 pl-3">
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
       <button type="submit" class="text-dark btn btn-primary w-auto mt-3">
        <a class="text-dark" href="{{ route('articles.show', ['article' => $article]) }}">
          コメント、投稿詳細
        </a>
      </button> 
      
  </div>
</div>