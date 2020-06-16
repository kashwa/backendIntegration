<?php

namespace App\Http\Controllers;

use App\Helpers\RestApi;
use App\Helpers\UploaderHelper;
use App\Repository\ArticleRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    use RestApi, UploaderHelper;

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
        // Validate request
        $validator = $this->validateArticleData($request->all(), $this->rule);
        if($validator->fails()){
            return $this->sendError($validator->messages(), 400);
        }

        $article_data = $request->only(['title', 'description', 'user_id']);
        $article_data['user_id'] = auth()->user()->id;

        # Handle to image saving.
        if (is_file($request['image'])) {
            $article_data['image'] = $this->articleRepository->handleImage($request['image']);
        }


        $article = $this->articleRepository->create($article_data);
        return $this->sendJson(['message' => 'Article Created Successfully!', 'article' => $article], 200);
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
        $validator = $this->validateArticleData($request->all(), [
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);
        if($validator->fails()){
            return $this->sendError($validator->messages(), 400);
        }

        $article_data = $request->only(['title', 'description', 'user_id']);

        # Handle image saving & old deleting.
        if ($request->has('image') && is_file($request['image'])) {

            // TODO: TEST WHILE IN VUEJS or LEARN HOW TO UPLOAD IMAGE IN PUT REQUEST.

            $article_data['image'] = $this->articleRepository->handleImage($request['image'], $id);
        }

        $article_updated = $this->articleRepository->update($id, $article_data);
        if ($article_updated) {
            return $this->sendJson(['message' => 'Article Updated Successfully!', 'article' => $this->articleRepository->find($id)], 200);
        }
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

    /**
     * Validate Article data.
     * using Validator::make()
     *
     * @param $data
     * @param $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateArticleData($data, $rules)
    {
        return Validator::make($data, $rules);
    }
}
