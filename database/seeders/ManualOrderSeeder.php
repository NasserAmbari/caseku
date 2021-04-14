<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use App\Models\ManualOrder;

class ManualOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'GBY',
            'DDE',
            'DZY'
        ];

        $name = [
            'Ayunda',
            'Melyna',
            'Lily',
            'Agus',
            'Nakal'
        ];

        $address = [
            'Jl. Kenangan Indah',
            'JL. Besok Kita Jalan Jalan',
            'Jl. Ke Hatimu',
            'Jl. Bacot',
            'Jl. Neraka'
        ];

        $contact = [
            '081254822336',
            '081248124143',
            '085176382984',
            '@nssr_mbr',
            '@nasser_ambari'
        ];

        $order_source = [
            '4','4','4','5','5'
        ];

        $note = [
            'Alda Kurang ajar dia lari',
            'Nasser Paling Ganteng',
            'Ood Kurus banget',
            'Vebby Marah2 Tiap Hari',
            'Bayu Terlalu Kalem'
        ];

        for($i=0; $i < count($name); $i++){
            $date = Carbon::now();
            $date->addDays($i);

            ManualOrder::create([
                'code_order' => $user[rand(0,2)].'-'.$date,
                'name' => $name[$i],
                'address' => $address[$i],
                'contact' => $contact[$i],
                'order_source_id' => $order_source[$i],
                'payment_method_id' => rand(1,4),
                'shipping_method_id' => rand(5,9),
                'date_create' => $date,
                'user_id' => rand(1,3),
                'note' => $note[$i]
            ]);
        }
    }
}
