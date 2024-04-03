<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductSaleContrller extends Controller
{
    public function sale(Product $product, Request $request)
    {
        $body = $request->validate([
            "quantity" => "required|integer|min:1",
            "currency" => "required|integer|exists:currencies,id"
        ]);


        $currency = Currency::where("id", $body["currency"])->first();
        $sale = Auth::user()->purchases()->create([
            "fk_product_id" => $product->id,
            "price" => $product->price * $body["quantity"],
            "cost" => $product->cost * $body["quantity"],
            "tax" => $product->tax * $body["quantity"],
            "currency_price" => ($currency->to_change * $product->price) * $body["quantity"],
            "currency_code" => $currency->code,
            "quantity" => $body["quantity"],
        ]);

        return redirect(route('product.show', ["product" => $product->id], absolute: false));
    }
}
