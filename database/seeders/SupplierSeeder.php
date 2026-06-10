<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::insert([
            ['name'=>'PT Sumber Makmur','phone'=>'08123456789','address'=>'Jakarta','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'CV Berkah Jaya','phone'=>null,'address'=>'Bandung','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
