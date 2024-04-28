<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutfitHistory extends Model
{
    use HasFactory;
    protected $table = 'outfit_histories';
    protected $fillable = [
        'user_id', 'outfit_tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mixMatch()
    {
        return $this->hasMany(MixMatch::class);
    }
}
