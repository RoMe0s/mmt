<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

if(!function_exists("upload_file")) {

    /**
     * Upload file to the server.
     *
     * @param UploadedFile $file
     * @param string $folder
     * @param string $subfolder
     * @return string
     */
    function upload_file(UploadedFile $file, string $folder) {

        $url = "uploads/$folder";

        $path = public_path($url);

        if(!file_exists($path)) {

            File::makeDirectory($path, 0777, true);

        }

        $name = preg_replace("@\s+@", '_', $file->getClientOriginalName());

        $file->move($path, $name);

        return "$url/$name";

    }

                                                                               }

if(!function_exists("delete_file")) {

    /**
     * Delete file from server if file exists.
     *
     * @param string $path
     */
    function delete_file(string $path) {

        $path = public_path($path);

        if(file_exists($path)) {

            @unlink($path);

        }

    }

}

if(!function_exists("mb_ucfirst")) {

    function mb_ucfirst(string $str) {

        $fc = mb_strtoupper(
            mb_substr(
                $str,
                0,
                1
            )
        );

        return $fc.mb_substr($str, 1);

    }

}
