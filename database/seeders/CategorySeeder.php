<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name'=>'Sembako','description'=>'Barang kebutuhan pokok','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Minuman','description'=>null,'created_at'=>now(),'updated_at'=>now()],
            ['name'=>'Snack','description'=>null,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
