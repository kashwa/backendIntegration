<?php


namespace App\Repository;


use App\Article;

class ArticleRepository
{
    function findAll()
    {
        return Article::all();
    }

    function find($id)
    {
        return Article::find($id);
    }

    function create($data)
    {
        return Article::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],
        ]);
    }

    function update($id, $data)
    {
        $article = $this->find($id);

        return $article->update($data);
    }

    function delete($id)
    {
        if ($this->find($id)){
            return Article::destroy($id);
        }
        return ['error' => 'Article Not Found'];
    }
}