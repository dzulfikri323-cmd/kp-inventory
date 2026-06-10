<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Product, Category, Supplier};

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $catSembako = Category::where('name','Sembako')->first();
        $catMinum   = Category::where('name','Minuman')->first();
        $sup1 = Supplier::first();

        Product::create([
            'category_id'=>$catSembako->id,
            'supplier_id'=>$sup1->id,
            'code'=>'PRD-0001',
            'name'=>'Beras 5Kg',
            'unit'=>'kg',
            'buy_price'=>65000,
            'sell_price'=>75000,
            'stock'=>20,
            'min_stock'=>5,
        ]);

        Product::create([
            'category_id'=>$catMinum->id,
            'supplier_id'=>null,
            'code'=>'PRD-0002',
            'name'=>'Air Mineral 600ml',
            'unit'=>'pcs',
            'buy_price'=>2500,
            'sell_price'=>3500,
            'stock'=>100,
            'min_stock'=>20,
        ]);
    }
}
