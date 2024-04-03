<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public const ADMIN = 1;
    public const CLIENT = 2;

    use HasFactory;

    protected $fillable = [
        "name",
    ];
}
