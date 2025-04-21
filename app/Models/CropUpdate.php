<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CropUpdate extends Model
{
    protected $fillable = [
        'crop_id',
        'height',
        'image_path',
        'notes'
    ];

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function crop()
    {
        return $this->belongsTo(Crop::class);
    }
}