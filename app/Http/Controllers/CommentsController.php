<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Article;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $article = Article::find($request->article_id); 

        $comment = new Comment;             

        $comment-> body= $request->body;
        $comment-> user_id = Auth::id();
        $comment-> article_id = $request->article_id;

        $comment -> save();

        return view('articles.show', compact('article'));  //リターン先は該当の投稿詳細ページ
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Comment::find($id);

        //投稿したユーザーでなければ404エラーを返す。
        if(Auth::id() !== $article->user_id){
            return abort(404);
        }

        return view('comments.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->body = $request->body;
        $comment -> save();
        
        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Comment::find($id);

        // Cloudinary内で画像を削除。
        // if(isset($post->public_id)){
        //     Cloudder::destroyImage($post->public_id);
        // }
        
        $article -> delete();
        return redirect()->route('articles.index');
    }
}
