<?php

use Illuminate\Database\Seeder;

class OrderDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_deliveries')->insert([
           ['name' => 'Доставка'],
           ['name' => 'Самовывоз'],
        ]);
    }
}
