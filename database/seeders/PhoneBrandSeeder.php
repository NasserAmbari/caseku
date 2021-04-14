<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PhoneBrand;

class PhoneBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phone = [
            'Iphone',
            'Samsung',
            'Vivo',
            'Oppo',
            'Xiaomi',
            'Asus',
            'Sony',
            'LG',
            'Lenovo',
            'HTC',
            'Google'
        ];

        for($i=0; $i < count($phone); $i++){
            PhoneBrand::create([
                'phone_brand' => $phone[$i]
            ]);
        }
    }
}
