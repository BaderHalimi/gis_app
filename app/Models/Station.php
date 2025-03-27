<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'type', 'lat', 'lng','prices','images','description','address'];
    // app/Models/Station.php
    protected $casts = [
        'prices' => 'array',
        'images' => 'array',
    ];
}
