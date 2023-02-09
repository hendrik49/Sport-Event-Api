<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sportevent extends Model
{
    use HasFactory;

    protected $fillable = [
        'eventDate', 'eventType', 'eventName', 'organizerId', 'createdBy'
    ];

    protected $hidden = [
        'createdBy',
        'created_at',
        'updated_at'
    ];
}
