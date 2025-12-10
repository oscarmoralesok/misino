<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'contact_name',
        'contact_relationship',
        'contact_phone',
        'instagram',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
