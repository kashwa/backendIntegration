<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\File;

trait UploaderHelper {

    /**
     * Generate file random name.
     *
     * @param $extension
     * @return String
     */
    public function generateFileRandomName($extension){
        $time = time();
        $str_random = str_random(8);
        return "{$time}_{$str_random}.{$extension}";
    }

    /**
     * Upload file.
     *
     * @param $folder_name , $file, $file_name
     * @param path (string)
     * @return mixed
     */
    public function fileUpload($folder_name, $file, $file_name) {
        $uploaded_image = $file->move(public_path($folder_name),$file_name);
        return $file_name;
    }

    /**
     * Upload file to Amazon S3.
     *
     * @param $folder_name
     * @param $file
     * @param $file_name
     * @return mixed
     */
    public function fileUpload2($folder_name, $file, $file_name) {
        $filePath = $folder_name.'/' . $file_name;
        //Upload File to s3
        //Storage::disk('s3')->put($filePath, file_get_contents($file));
        Storage::disk('s3')->put($filePath, fopen($file, 'r+'));
        return Storage::disk('s3')->url($filePath);
        //$uploaded_image = $file->move(public_path($folder_name),$file_name);
        //return public_path($folder_name).'/'.$file_name;
    }

    /**
     * Check if allowed file extensions.
     *
     * @param $extensions
     * @param $file_extension
     * @return void
     */
    public function isAllowedFileExtensions($extensions,$file_extension){
        $allowed_extensions = explode(',',$extensions);
        if(!in_array($file_extension, $allowed_extensions)){
            throw new NotAllowedFileExtensionException;
        }
    }

    /**
     * Get file full path.
     *
     * @param file_path
     * @return string
     */
    public function getFileFullPath($file_name,$folder = null){
        $file_path = Storage::disk('public')->url($file_name);
        return $file_path;
    }

    /**
     * Delete file.
     *
     * @param file_path
     * @return boolean
     */
    public function deleteFile($file_path){
//		$root_directory = app(\Hyn\Tenancy\Website\Directory::class)->path();
//		$path_components = explode($root_directory, $file_path);
//		if(isset($path_components[1])){

//        file_exists(public_path());
        $arr = explode('/images/',$file_path);
        $file_name = array_last($arr);
        Storage::disk('s3')->delete('uploads/images/'.$file_name);
        return true;
//			return Storage::delete('public/'.$file_name);
        if(\File::exists(public_path('uploads/images/'.$file_name))){
            return \File::delete(public_path('uploads/images/'.$file_name));
        }
//		}
//		return false;
    }
}