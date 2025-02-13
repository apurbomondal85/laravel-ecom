<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'attachment',
        'attachable_id',
        'attachable_type',
        'mime_type',
        'for',
        'operator_id',
    ];
}
