<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static orderBy(string $string)
 */
class Department extends Model
{
    use HasFactory;

    protected $guarded = [];
}
