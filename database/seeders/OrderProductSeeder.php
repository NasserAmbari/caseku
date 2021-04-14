<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderProduct;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $status = [
            'udah jadi',
            'masih proses',
            'udah dikirim'
        ];

        for($i=0; $i < count($status); $i++){
            OrderProduct::create([
                'order_id' => rand(1,4),
                'list_stock_id' => rand(1,5),
                'status' => $status[rand(0,2)],
                'quantity' => rand(1,3)
            ]);
        }
    }
}
