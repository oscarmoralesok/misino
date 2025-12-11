<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'contact_name',
        'contact_relationship',
        'contact_phone',
        'instagram',
    ];
}
