<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Midtrans\CreatePaymentUrlService;

class OrderController extends Controller
{
    public function order(Request $request) {

        $order=Order::create([
            'user_id' => $request->user()->id,
            'seller_id' => $request->seller_id,
            'number' => time(),
            'total_price'=> $request->total_price,
            'payment_status'=>1,
            'delivery_address'=> $request->delivey_address,
            /* 'shipping_cost' => $request->shipping_cost,
            'courier_name' => $request->courier_name, */
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$item['id'],
                'quantity' => $item['qty']
            ]);
        }

        //manggil service midtrans utk dapat payment url
        $midtrans=new CreatePaymentUrlService();
        $paymentUrl=$midtrans->getPaymentUrl($order->load('user', 'orderItems'));
        //dd($payamentUrl);
        $order->update([
            'payment_url' => $paymentUrl
        ]);

        return response()->json([
            'data' => $order
        ]);
    }
}
