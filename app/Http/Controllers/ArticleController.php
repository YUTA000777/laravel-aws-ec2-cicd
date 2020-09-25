<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\CommentRequest;
use JD\Cloudder\Facades\Cloudder;


class ArticleController extends Controller
{
    //Policyを使用して各アクションメソッドを判定条件する
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    public function index()
    {
        $articles = Article::latest()->paginate(5);

        return view('articles.index', ['articles' => $articles]);
    }

    public function create()
    {
        return view('articles.create');    
    }

    public function store(ArticleRequest $request, Article $article)
    {
       
        $article->fill($request->all());
        $article->user_id = $request->user()->id;
        
        //画像投稿リクエストがあった場合
        if ($image = $request->file('image')) {
            $image_path = $image->getRealPath();
            Cloudder::upload($image_path, null);
            //直前にアップロードされた画像のpublicIdを取得する。
            $publicId = Cloudder::getPublicId();
            $logoUrl = Cloudder::secureShow($publicId, [
                'width'     => 400,
                'height'    => 400
            ]);
            $article->image_path = $logoUrl;
            $article->public_id  = $publicId;
        }
        $article->save();
        return redirect()->route('articles.index');
    }

    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);    
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $article->fill($request->all())->save();
        return redirect()->route('articles.index');
    }

    public function destroy(Request $request,Article $article)
    {
        
        $article->delete();

        //クラウドの画像を削除
        if(isset($post->public_id)){
            Cloudder::destroyImage($article->public_id);
        }

        return redirect()->route('articles.index');
    }

    public function show(Article $article)
    {
     
        $article->load('user', 'comments'); //Eagerロード

        return view('articles.show', ['article' => $article,]);
    }    

    public function like(Request $request, Article $article)
    {
        //削除(detach)してから新規登録(attach)をすることで二重いいねを防ぐ。仮にいいね済みでも結果としていいねがついたままになる
        $article->likes()->detach($request->user()->id);
        $article->likes()->attach($request->user()->id);

        return [
            'countLikes' => $article->count_likes,
        ];
    }

    public function unlike(Request $request, Article $article)
    {
        $article->likes()->detach($request->user()->id);

        return [
            'countLikes' => $article->count_likes,
        ];
    }
}