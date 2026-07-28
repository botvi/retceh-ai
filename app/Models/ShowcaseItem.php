<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowcaseItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image_before',
        'image_after',
        'label_before',
        'label_after',
        'category_label'
    ];
}
