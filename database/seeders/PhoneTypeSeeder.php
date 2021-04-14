<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhoneType;

class PhoneTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'XR','X','11',
            'Galaxyy 10','Galaxy 11','Tab S6',
            'V20','V20 SE','Y51',
            'A15','Reno5','Reno4',
            'Mi 11','Mi 10i 5G','Redmi Note 9T 5G',
            'ROG Phone 1','ROG Phone 2','ROG Phone 3',
            'Sony Xperia 1','Sony Xperia 10','Sony Xperia 5',
            'WING','K10','V20',
            'K12','Legion Pro','Legion Duel',
            'Desire','U','Desire Pro',
            'Pixel 2','Pixel 3','Pixel 4'
        ];
        $lit=0;
        for ($i=0; $i < count($type); $i++) { 
            PhoneType::create([
                'phone_type' => $type[$i],
                'phone_brand_id' => $lit+1
            ]);
            
            if($i % 3 == 2){
                $lit++;
            }
        }
    }
}
