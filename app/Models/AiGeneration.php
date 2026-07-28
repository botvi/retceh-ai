<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiGeneration extends Model
{
    protected $fillable = [
        'user_id',
        'original_image_path',
        'generated_image_url',
        'category',
        'prompt',
        'task_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
