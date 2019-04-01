<?php
use App\Articles\ArticlesRepository;
use App\Problems\ProblemRepository;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('articles.index', [
        'articles' => App\Article::all(),
    ]);
});
Route::get('/search', function (ArticlesRepository $repository) {
    $articles = $repository->search((string) request('q'));

    return view('articles.index', [
        'articles' => $articles,
    ]);
});*/
Route::get('/get-problem', function (\App\Problems\ProblemRepository $repository) {
    if (request('q')) {
        $problem = $repository->search(request('q'));
    } else {
        $problem = \App\Problem::all();
    }
    return response()->json($problem);
});
Route::get('/', function (\App\Articles\ArticlesRepository $repository) {
    if (request('q')) {
        $articles = $repository->search(request('q'));
    } else {
        $articles = \App\Article::all();
    }
    // return view('articles.index', ['articles' => $articles]);
    return response()->json($articles);
});
Route::get('add-article', function (\App\Articles\ArticlesRepository $repository){
    $article = new \App\Article;
    $article->title = 'Contoh artikel 3';
    $article->body = 'Accusantium tenetur tempore voluptates tempore facilis nam id. Tenetur eveniet neque voluptate ipsa omnis vero. Eveniet fugiat modi minus vero praesentium. Quo nulla ad suscipit ipsa qui non.';
    $article->tags = array("ruby","javascript");
    $article->save();

    $articles = $repository->search('Contoh');
    return view('articles.index', ['articles' => $articles]);
});
Route::get('reindex', function(\Elasticsearch\Client $client, \App\Articles\ArticlesRepository $repository){
    $article = \App\Article::find(request('id'));
    // dd($article);
    //reindex elasticsearch data
    $client->index([
        'index' => $article->getSearchIndex(),
        'type' => $article->getSearchType(),
        'id' => $article->id,
        'body' => $article->toSearchArray(),
    ]);
    $articles = $repository->search($article->title);
    return view('articles.index', ['articles' => $articles]);
});
Route::get('users-sdtool', function(\App\UserSdtool $model){
    $data = $model::find('90001');
    dd($data);
});