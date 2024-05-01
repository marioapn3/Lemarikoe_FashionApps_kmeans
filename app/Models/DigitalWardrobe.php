<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalWardrobe extends Model
{
    use HasFactory;
    protected $table = 'digital_wardrobes';

    protected $fillable = [
        'user_id', 'cloudFilePath', 'category', 'wardrobeTag', 'style_preference', 'color', 'occasion', 'fashionStyle', 'wardrobeTag'
    ];
}
