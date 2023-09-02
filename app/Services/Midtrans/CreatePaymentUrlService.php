<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CreatePaymentUrlService extends Midtrans
{
    protected $order;

    public function __construct()
    {
        parent::__construct();
        //$this->order=$order;

    }

    public function getPaymentUrl($order)
    {
        $item_details= new Collection();

        foreach ($order->orderItems as $item){
            $product=Product::find($item->product_id);
               $item_details->push([
                    'id' =>$product->id,
                    'price' => $product->price,
                    'quantity' => $item->quantity,
                    'name' => $product->name,
                ]
               );

        }

        $params = [
            'transaction_details' => [
                'order_id' => $order->number,
                'gross_amount' => $order->total_price,
            ],
           /*  'item_details' => [
                [
                    'id' => 1,
                    'price' => '150000',
                    'quantity' => 1,
                    'name' => 'Flashdisk Toshiba 32GB',
                ],
                [
                    'id' => 2,
                    'price' => '60000',
                    'quantity' => 2,
                    'name' => 'Memory Card VGEN 4GB',
                ],
            ], */
            'item_details' => $item_details,
            'customer_details' => [
                //'first_name' => 'Martin Mulyo Syahidin',
                //'email' => 'mulyosyahidin95@gmail.com',
                'first_name' => $order->user->name,
                'email' => $order->user->email,
                'phone' => '081234567890',
            ]
        ];

        $paymentUrl = Snap::createTransaction($params)->redirect_url;

        return $paymentUrl;
    }
}
