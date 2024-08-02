<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static where(string $string, $dorm_id)
 */
class Machine extends Model
{
    use HasFactory;

    public const FREE_STATUS = 0;
    public const WASHING_STATUS = 1;

    protected $fillable = ['dorm_id','code','status'];

    public function reserves(): HasMany
    {
        return $this->hasMany(Reserve::class);
    }

    public function dorm(): BelongsTo
    {
        return $this->belongsTo(Dorm::class);
    }
}
