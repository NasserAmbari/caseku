<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_method = [
            'BNI',
            'BCA',
            'BRI',
            'MANDIRI',
            'Dana',
            'Link Aja',
            'Gopay',
            'Ovo'
        ];

        for($i=0; $i < count($payment_method); $i++){
            PaymentMethod::create([
                'payment_method' => $payment_method[$i]
            ]);
        }
    }
}
