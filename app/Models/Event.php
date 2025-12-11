<?php

namespace App\Models;
use App\Models\User;
use App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'event_date',
        'start_time',
        'end_time',
        'detail',
        'address',
        'latitude',
        'longitude',
        'service_type',
        'event_type_id',
        'status',
        'total_amount',
        'notes',
    ];
    
    protected $casts = [
        'event_date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function items()
    {
        return $this->hasMany(EventItem::class);
    }

    public function eventType()
    {
        return $this->belongsTo(EventType::class);
    }

    public function images()
    {
        return $this->hasMany(EventImage::class)->orderBy('order');
    }
}
