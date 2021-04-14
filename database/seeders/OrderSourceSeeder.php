<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderSource;

class OrderSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = [
            'Shopee',
            'Tokopedia',
            'Lazada',
            'Whatsapp',
            'IG'
        ];

        $as_order = [
            'Market Place',
            'Market Place',
            'Market Place',
            'Manual',
            'Manual'
        ];

        for($i=0; $i < count($order); $i++){
            OrderSource::create([
                'order_source' => $order[$i],
                'as' => $as_order[$i]
            ]);
        }
    }
}
