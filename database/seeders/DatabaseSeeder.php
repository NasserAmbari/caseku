<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PhoneBrandSeeder::class);
        $this->call(PhoneTypeSeeder::class);
        $this->call(CaseTypeSeeder::class);
        $this->call(ListStockSeeder::class);
        $this->call(OrderSourceSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(ShippingMethodSeeder::class);
        // $this->call(ManualOrderSeeder::class);
        // $this->call(OrderProductSeeder::class);
    }
}
