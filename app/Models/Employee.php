<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static paginate(int $int)
 * @method static create(array $validated)
 * @method static latest()
 * @method static orderBy(string $string, string $string1)
 */
class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function scopeWhereDepartment($query, $department_id): void
    {
        $query->when(!is_null($department_id), function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
        });
    }
}
