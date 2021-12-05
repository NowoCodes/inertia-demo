<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static paginate(int $int)
 * @method static create(array $validated)
 * @method static latest()
 */
class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function department():  BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
