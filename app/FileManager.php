<?php

namespace App;

use Illuminate\Support\Facades\File;

trait FileManager
{
    public function uploadFile($file, $foldersAfterPublic)
    {
        if (!$file) {
            return null; // Return an empty array if no files are provided
        }

        $fileName = uniqid() . $file->getClientOriginalName();
        $path = str_replace(' ', '', $fileName);
        $file->move(public_path($foldersAfterPublic), $path);

        return $path;
    }

    public static function deleteFile($fullPathAfterPublic)
    {
        $fullPath = public_path($fullPathAfterPublic);

        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return true; // Deletion successful
        }

        return false; // File not found
    }
}
