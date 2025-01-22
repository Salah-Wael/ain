<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public static function storeImage($request, string $columnName, string $pathAfterPublic)
    {
        // Check if the file exists in the request
        if (!$request->hasFile($columnName)) {
            return null; // Handle this gracefully in your calling code
        }

        $image = $request->file($columnName);
        $imageName = uniqid() . $image->getClientOriginalName();
        $noSpacesString = str_replace(' ', '', $imageName);
        $image->move(public_path($pathAfterPublic), $noSpacesString);

        return $noSpacesString;
    }

    public static function storeImages($request, string $columnName, string $pathAfterPublic,)
    {
        // Check if the request has multiple images
        if (!$request->hasFile($columnName)) {
            return []; // Return an empty array if no files are provided
        }

        $imagePaths = [];

        // Check if the request has multiple images
        foreach ($request->file($columnName) as $imageFile) {
            // For each image, call the storeImage method

            $imageName = uniqid() . $imageFile->getClientOriginalName();
            $noSpacesString = str_replace(' ', '', $imageName);
            $imageFile->move(public_path($pathAfterPublic), $noSpacesString);

            // Append the image path to the array
            $imagePaths[] = $noSpacesString;
        }

        // Return an array of image paths, if needed
        return $imagePaths;
    }

    public static function deleteImage($imageName, string $pathAfterPublic)
    {
        $fullPath = public_path(trim($pathAfterPublic, '/')) . '/' . $imageName;

        if (File::exists($fullPath)) {
            File::delete($fullPath);
            return true; // Deletion successful
        }

        return false; // File not found
        // File::delete(public_path($pathAfterPublic) . $imageName);
    }

    public static function deleteImages(array $imageNames, string $pathAfterPublic)
    {
        $results = [];

        foreach ($imageNames as $imageName) {
            $fullPath = public_path(trim($pathAfterPublic, '/')) . '/' . $imageName;

            if (File::exists($fullPath)) {
                File::delete($fullPath);
                $results[$imageName] = true; // Deletion successful for this image
            } else {
                $results[$imageName] = false; // File not found for this image
            }
        }

        return $results; // Return an associative array with image names and their deletion statuses
    }
}
