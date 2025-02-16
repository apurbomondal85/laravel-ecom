<?php

namespace App\Library;

enum Enum
{
    public const NO_IMAGE_PATH = 'resources/images/noimage.jpg';
    public const BRAND_THUMBNAIL_IMAGE_DIR = 'storage/brand';
    public const CATEGORY_THUMBNAIL_IMAGE_DIR = 'storage/category';
    public const PRODUCT_THUMBNAIL_IMAGE_DIR = 'storage/product';
    public const PRODUCT_GALLERY_IMAGE_DIR = 'storage/gallery';
    
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

    // Category Status
    public const CATEGORY_STATUS_ACTIVE = 'active';
    public const CATEGORY_STATUS_INACTIVE = 'inactive';

    public static function getCategoryStatus(string $status = null)
    {
        $types = [
            self::CATEGORY_STATUS_ACTIVE   => "Active",
            self::CATEGORY_STATUS_INACTIVE => "Inactive",
        ];

        return $status ? $types[$status] : $types;
    }

    //Order Status Type
    public const ORDER_STATUS_TYPE_PENDING = 'pending';
    public const ORDER_STATUS_TYPE_CANCELED = 'canceled';
    public const ORDER_STATUS_TYPE_PROCESSING = 'processing';
    public const ORDER_STATUS_TYPE_SHIPPED = 'shipped';
    public const ORDER_STATUS_TYPE_DELIVERED = 'delivered';
    public const ORDER_STATUS_TYPE_NOT_RECEIVED = 'not_received';
    public const ORDER_STATUS_TYPE_INCOMPLETE = 'incomplete';

    public static function getOrderStatusType(string $type = null)
    {
        $types = [
            self::ORDER_STATUS_TYPE_PENDING      => 'Pending',
            self::ORDER_STATUS_TYPE_CANCELED     => 'Canceled',
            self::ORDER_STATUS_TYPE_PROCESSING   => 'Processing',
            self::ORDER_STATUS_TYPE_SHIPPED      => 'Shipped',
            self::ORDER_STATUS_TYPE_DELIVERED    => 'Delivered',
            self::ORDER_STATUS_TYPE_NOT_RECEIVED => 'Not Received',
            self::ORDER_STATUS_TYPE_INCOMPLETE   => 'Incomplete',
        ];

        return $type ? $types[$type] : $types;
    }

    //Order Payment Status Type
    public const ORDER_PAYMENT_STATUS_UNPAID = 'unpaid';
    public const ORDER_PAYMENT_STATUS_PARTIAL = 'partial';
    public const ORDER_PAYMENT_STATUS_PAID = 'paid';
    public const ORDER_PAYMENT_STATUS_REFUNDED = 'refunded';

    public static function getPaymentStatusType(string $type = null)
    {
        $types = [
            self::ORDER_PAYMENT_STATUS_UNPAID   => 'Unpaid',
            self::ORDER_PAYMENT_STATUS_PARTIAL  => 'Partial',
            self::ORDER_PAYMENT_STATUS_PAID     => 'Paid',
            self::ORDER_PAYMENT_STATUS_REFUNDED => 'Refunded',
        ];

        return $type ? $types[$type] : $types;
    }

    //Order Payment Status Type
    public const ORDER_PAYMENT_TYPE_COD = 'COD';
    public const ORDER_PAYMENT_TYPE_DIGITAL = 'Digital';

    public static function getOrderPaymentType(string $type = null)
    {
        $types = [
            self::ORDER_PAYMENT_TYPE_COD     => 'COD',
            self::ORDER_PAYMENT_TYPE_DIGITAL => 'Digital',
        ];

        return $type ? $types[$type] : $types;
    }

    // Discount Type
    public const DISCOUNT_TYPE_FLAT = 'flat';
    public const DISCOUNT_TYPE_PERCENTAGE = 'percentage';

    public static function getDiscountType(string $type = null)
    {
        $types = [
            self::DISCOUNT_TYPE_FLAT       => 'Flat',
            self::DISCOUNT_TYPE_PERCENTAGE => 'Percentage',
        ];

        return $type ? $types[$type] : $types;
    }
}
