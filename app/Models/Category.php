<?php

namespace App\Models;

use App\Library\Enum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Vite;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "status"
    ];

    public function attachments(): MorphMany
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getThumbnailAttribute()
    {
        return $this->morphOne(Attachment::class, 'attachable')->where('for', Enum::ATTACHMENT_TYPE_THUMBNAIL)->first()?->attachment;
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
    public function scopeActive($query)
    {
        return $this->where('status', Enum::CATEGORY_STATUS_ACTIVE);
    }
}
