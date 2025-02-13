<?php

namespace App\Library;

use Illuminate\Support\Facades\Log;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManager;

enum Helper
{
    public static function log($error)
    {
        Log::error($error);
    }
    
    public static function uploadImage($image, $path, $w = null, $h = null)
    {
        $file_name = time() . rand(111, 999) . '.' . $image->getClientOriginalExtension();
        $destination_path = public_path($path);

        if (!is_dir($destination_path)) {
            mkdir($destination_path, 0777, true);
        }

        $manager = new ImageManager(new Driver());

        $image_file = $manager->read($image->getRealPath());

        // if ($w && $h) {
        //     $image_file->resize($w, $h, function ($constraint) {
        //         $constraint->aspectRatio();
        //     });
        // }

        if ($w && $h) {
            $image_file->resize($w, $h);
        }

        $image_file->save($destination_path . '/' . $file_name);

        return $path . '/' . $file_name;
    }
}
