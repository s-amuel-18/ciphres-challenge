<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::insert([
            ["name" => "Dolar", "code" => "USD", "to_change" => 1],
            ["name" => "Euro", "code" => "EUR", "to_change" => 0.9],
            ["name" => "Bolivar", "code" => "VES", "to_change" => 36.2],
        ]);
    }
}
