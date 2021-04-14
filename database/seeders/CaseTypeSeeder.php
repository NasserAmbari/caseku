<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CaseType;

class CaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeCase = ['3D Hardcase','2D Hardcase','2D Jelly','Acrylic Rubber', 'Rubber Premium'];
        $price = [70000,65000,70000,85000,85000];

        for($i=0; $i < 5; $i++){
            CaseType::create([
                'case_type' => $typeCase[$i],
                'price' => $price[$i],
                // 'stock' => 10
            ]);
        }
    }
}
