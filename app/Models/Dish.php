<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Dish extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'status',
    ];
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'price' => 'decimal:0',
        ];
    }
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
