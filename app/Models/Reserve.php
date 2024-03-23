<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @method static where(string[] $array)
 * @method static create(array $array)
 */
class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['machine_id','student_id','receiptID','start_at', 'end_at', 'status'];

    public const WorkDuration = "60"; // Minutes
    public const RestDuration = "15"; // Minutes
    public const StartTime = "14:00";
    public const EndTime = "23:00";

    public const RSERVE_STATUS = 0;
    public const WASHING_STATUS = 1;
    public const FINISHED_STATUS = 2;



    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function machine(): BelongsTo
    {
        return $this->belongsTo(Machine::class);
    }
}
