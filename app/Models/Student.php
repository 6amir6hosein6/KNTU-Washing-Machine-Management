<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, array $keys)
 * @method static create(array $array)
 */
class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['studentID', 'password', 'dorm_id', 'name','wallet'];
    protected $hidden = ['password'];

    public function reserves(): HasMany
    {
        return $this->hasMany(Reserve::class);
    }

    public function dorm(): BelongsTo
    {
        return $this->belongsTo(Dorm::class);
    }

    /**
     * Accessor for the 'money' attribute.
     *
     * @param int $value
     * @return string
     */
    public function getWalletAttribute(int $value): string
    {
        return number_format($value);
    }
}
