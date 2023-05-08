<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Game
 *
 * @property-read Collection|Rate[] $rates
 */
class Game extends Model
{
    use HasFactory;

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
}
