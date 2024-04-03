<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSale extends Model
{
    use HasFactory;

    protected $fillable = [
        "fk_user_id",
        "fk_product_id",
        "price",
        "cost",
        "tax",
        "currency_price",
        "currency_code",
        "quantity",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "fk_user_id");
    }

    public function product()
    {
        return $this->belongsTo(Product::class, "fk_product_id");
    }
}
