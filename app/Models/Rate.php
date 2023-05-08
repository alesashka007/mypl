<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read Collection|Game $game
 */
class Rate extends Model
{
    use HasFactory;

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
    public function vds(): BelongsTo
    {
        return $this->belongsTo(Vds::class);
    }
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
