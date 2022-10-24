<?php

namespace App\Http\Controllers;
use App\Http\Requests\Article\createRequest;
use App\Http\Requests\Article\updateRequest;
use App\Http\Resources\articleResource;
use App\Http\Resources\articleResourceCollection;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\returnArgument;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = Article::paginate(3);
//        dd($articles);
        $articles = new articleResourceCollection($articles);
//        $articles=articleResourceCollection::collection($articles);
        return $articles;
    }

    public function article(Request $request, $id)
    {
//        try {
//        $i=8/0;
        $article = Article::findOrFail($id);
//            dd($article->load('users'));
        $article = new articleResource($article->load('users'));
//            dd($article->whenLoaded());
//        dd($article->when);
//            $article=new articleResource($article);
        return $article;
//        } catch (\Exception $exception) {
//             response([
//                'message'=>'صفحه پیدا نشد',
//            ],404);
//        }
    }

    public function create(createRequest $request)
    {
        $data = $request->only(['title', 'body']);
        $user = User::findOrFail(15);
        $article = $user->articles()->create($data);
//        dd($article);
        return response($article, 201);
    }

    public function update(updateRequest $request, $articleId)
    {
        $article = Article::findOrFail($articleId);
        $data = $request->only(['title', 'body']);
        $article->update($data);
        return response($article, 202);
    }

    public function delete(Request $request, $articleId)
    {
        $article = Article::findOrFail($articleId);
        $article->delete();
        return response([null], 204);
    }
}
