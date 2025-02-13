<?php

use App\Library\Helper;
use App\Models\Attachment;
use Illuminate\Support\Facades\File;

function attachmentStore($file, $model, $path = null, $attachment_for = null, $w = null, $h = null)
{
    $file_path = storeFile($file, $path, $w, $h);

    $attachment = new Attachment();
    $attachment->attachment = $file_path;
    $attachment->mime_type = $file->getClientOriginalExtension();
    $attachment->for = $attachment_for;

    return $model->attachments()->save($attachment);
}

function storeFile($file, $path, $w = null, $h = null)
{
    $file_extension = $file->getClientOriginalExtension();

    // if ($file_extension == 'pdf' || $file_extension == 'svg') {
    //     return Helper::uploadFile($file, $path);
    // }

    return Helper::uploadImage($file, $path, $w, $h);
}

function deleteFile($path)
{
    $paths = is_array($path) ? $path : [$path];

    foreach ($paths as $item) {
        if (File::exists(public_path($item))) {
            File::delete(public_path($item));
        }
    }
}