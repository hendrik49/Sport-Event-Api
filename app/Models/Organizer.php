<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = [
        'organizerName', 'imageLocation', 'createdBy'
    ];

    protected $hidden = [
        'createdBy',
        'created_at',
        'updated_at'
    ];
}
