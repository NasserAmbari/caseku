<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShippingMethod;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shipping_method = [
            'J&T Express',
            'Si Cepat',
            'JNE',
            'Pos Indonesia',
            'Kurir BPP',
            'J&T Express',
            'JNE',
            'Pos Indo',
            'Si Cepat'
        ];

        $shipping_method_as = [
            'Market Place',
            'Market Place',
            'Market Place',
            'Market Place',
            'Manual',
            'Manual',
            'Manual',
            'Manual',
            'Manual',
        ];

        for($i=0; $i < count($shipping_method); $i++){
            ShippingMethod::create([
                'shipping_method' => $shipping_method[$i],
                'as' => $shipping_method_as[$i]
            ]);
        }
    }
}
