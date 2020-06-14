<?php

namespace App\Http\Controllers;

use App\Helpers\RestApi;
use App\Repository\ArticleRepository;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    use RestApi;

    /**
     * @var ArticleRepository instance.
     */
    protected $articleRepository;

    protected $rule = [
        'title' => 'required|max:255',
        'description' => 'required',
        'user_id' => 'required'
    ];

    /**
     * ArticleController constructor.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Return List of App/Article.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->sendJson($this->articleRepository->findAll(), 200);
    }

    /**
     * Return Specific Article.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $article = $this->articleRepository->find($id);

        if ($article)
            return $this->sendJson($article, 200);
        else
            return $this->sendError(['message' => 'Article Not Found!'], 404);
    }

    /**
     * Create new Article.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Update Specific Article.
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Delete Specific Article.
     *
     * @param $article_id
     * @return mixed
     */
    public function destroy($article_id)
    {
        $article = $this->articleRepository->delete($article_id);
        if($article == 1 )
            return $this->sendMessage(['message' => 'Article Deleted Successfully'], 200);

        return $this->sendMessage(['message' => 'Article Not Found'], 404);
    }
}
