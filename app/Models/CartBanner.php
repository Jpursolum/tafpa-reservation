<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartBanner extends Model
{
// App\Models\CartBanner.php
protected $fillable = [
    'title',
    'subtitle',
    'description',
    'discount_text',
    'image',
    'countdown_until',
];


    protected $casts = [
        'countdown_end' => 'datetime',
    ];
}
