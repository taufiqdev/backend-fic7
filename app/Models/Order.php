<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    /* protected $fillable =['user_id', 'seller_id', 'number', 'total_price', 'payment_status','snap_url', 'delivery_address', 'shipping_cost', 'courier_name']; */
    protected $fillable =['user_id', 'seller_id', 'number', 'total_price', 'payment_status','payment_url', 'delivery_address'];

    public function user(){

        return $this->belongsTo(User::class);

    }

    public function orderItems():HasMany{

        return $this->hasMany(OrderItem::class);

    }



}
