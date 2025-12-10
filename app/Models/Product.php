<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'base_price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
