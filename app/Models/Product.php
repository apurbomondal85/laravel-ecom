<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Vite;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "short_description",
        "description",
        "price",
        "sale_price",
        "SKU",
        "stock",
        "quantity",
        "category_id",
        "brand_id",
        "featured",
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class,"attachable");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function getThumbnailAttribute()
    {
        return $this->morphOne(Attachment::class, "attachable")->where("for", Enum::ATTACHMENT_TYPE_THUMBNAIL)->first()?->attachment;
    }

    public function getGalleryImagesAttribute()
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('for', Enum::ATTACHMENT_TYPE_GALLERY)->get();
    }

    public function getThumbnailImage(): string
    {
        $path = public_path($this->getThumbnailAttribute() ?? '');

        if ($this->getThumbnailAttribute() && is_file($path) && file_exists($path)) {
            return asset($this->thumbnail);
        }

        return Vite::asset(Enum::NO_IMAGE_PATH);
    }

    // scope
    public function scopeFeatured($query)
    {
        return $query->where("featured", true);
    }
}
