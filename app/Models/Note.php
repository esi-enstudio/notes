<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(mixed $validated)
 * @property mixed $id
 */
class Note extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected array $searchable = [
        'title',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'complete_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
