<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'base_price',
        'image',
        'svg_image',
        'show_in_web',
    ];

    protected $casts = [
        'show_in_web' => 'boolean',
    ];

    protected $appends = [
        'image_url',
        'svg_url',
    ];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return null;
    }

    public function getSvgUrlAttribute()
    {
        if ($this->svg_image) {
            return Storage::url($this->svg_image);
        }
        return null;
    }
}
