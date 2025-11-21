<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\Students\StudentField;
class Student extends Model
{
    use HasFactory ,SoftDeletes;

    protected $fillable = [
        'user_id',
        'level_id',
        'first_name',
        'last_name',
        'national_code',
        'status',
        'field',
        'birth_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
            'field' => StudentField::class,
        ];
    }
}
