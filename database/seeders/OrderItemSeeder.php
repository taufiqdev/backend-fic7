<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //OrderItem::
        $order=Order::find(1);
        $products=Product::all();

        for ($i=0; $i<5; $i++) {
            OrderItem::factory()->create([
                'order_id'=>$order->id,
                'product_id' => $products->random()->id,
                ]
            );
        }
    }
}
