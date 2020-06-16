<?php


namespace App\Repository;


use App\Article;
use App\Helpers\UploaderHelper;
use Illuminate\Support\Facades\Storage;

class ArticleRepository
{
    use UploaderHelper;

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
        return Article::create($data);
    }

    function update($id, $data)
    {
        $article = $this->find($id);

        return $article->update($data);
    }

    function handleImage($image, $id=null)
    {
        # if its update.
        if (!is_null($id)){
            $old_img = $this->find($id)->image;

            if (!is_null($old_img)){
                $this->deleteFile('Images/'.$old_img);
            }
        }

        #create new one and return its name
        $extension = $image->extension();
        $file_name = $this->generateFileRandomName($extension);
        return $this->fileUpload('Images', $image, $file_name);
    }

    function delete($id)
    {
        if ($this->find($id)){
            return Article::destroy($id);
        }
        return ['error' => 'Article Not Found'];
    }
}