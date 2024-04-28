<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MixMatch extends Model
{
    use HasFactory;
    protected $fillable = [
        'digital_wardrobes_id', 'outfit_history_id',
    ];

    /**
     * Get the user that owns the MixMatch
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function digitalWardrobe(): BelongsTo
    {
        return $this->belongsTo(DigitalWardrobe::class, 'digital_wardrobes_id', 'id');
    }
}
