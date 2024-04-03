<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleReport extends Model
{
    use HasFactory;
    protected $fillable = [
        "fk_user_id",
        "title",
        "begin_date",
        "end_date",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "fk_user_id");
    }
}
