<?php

use App\Models\Order\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['name' => 'In progress'],
            ['name' => 'Completed'],
            ['name' => 'Canceled'],
            ['name' => 'Not found'],
        ];

        foreach ($statuses as $status) {
            factory(OrderStatus::class)->create($status);
        }

        factory(OrderStatus::class, 1)->create();
    }
}
