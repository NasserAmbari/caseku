<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListStock;

class ListStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone_type = [1,3,5,7,10];
        $case_type = [3,4,5,2,1];
        $stock = [10,10,2,3,8];

        for($i=0; $i < 5; $i++){
            ListStock::create([
                'phone_type_id' => $phone_type[$i],
                'case_type_id' => $case_type[$i],
                'stock' => $stock[$i]
            ]);
        }
    }
}
