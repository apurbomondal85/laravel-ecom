<?php

namespace App\Library;

enum Enum
{
    public const NO_IMAGE_PATH = 'resources/images/noimage.jpg';
    public const BRAND_THUMBNAIL_IMAGE_DIR = 'storage/brand';
    
    // Attachment For Type
    public const ATTACHMENT_TYPE_THUMBNAIL = 'thumbnail';
    public const ATTACHMENT_TYPE_ICON = 'icon';
    public const ATTACHMENT_TYPE_GALLERY = 'gallery';
    public const ATTACHMENT_TYPE_DESCRIPTION = 'description';
    public const ATTACHMENT_TYPE_VARIANT = 'variant';
    public const ATTACHMENT_TYPE_META = 'meta';
    public const ATTACHMENT_TYPE_BANNER = 'banner';
    public const ATTACHMENT_TYPE_BACKGROUND = 'background';
    public const ATTACHMENT_TYPE_ATTACHMENT = 'attachment';

    public static function getAttachmentType(string $type = null)
    {
        $types = [
            self::ATTACHMENT_TYPE_THUMBNAIL   => "Thumbnail",
            self::ATTACHMENT_TYPE_ICON        => "Icon",
            self::ATTACHMENT_TYPE_GALLERY     => "Gallery",
            self::ATTACHMENT_TYPE_DESCRIPTION => "Description",
            self::ATTACHMENT_TYPE_VARIANT     => "Variant",
            self::ATTACHMENT_TYPE_META        => "Meta",
            self::ATTACHMENT_TYPE_BANNER      => "Banner",
            self::ATTACHMENT_TYPE_BACKGROUND  => "Background",
            self::ATTACHMENT_TYPE_ATTACHMENT  => "Attachment",
        ];

        return $type ? $types[$type] : $types;
    }
}
