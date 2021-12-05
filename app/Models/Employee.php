<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static paginate(int $int)
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
