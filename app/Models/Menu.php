<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Menu extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'date',
        'dish_id',
    ];

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class);
    }
}
