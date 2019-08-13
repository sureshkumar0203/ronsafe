<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'price_id', 'size', 'color', 'unit_price', 'qty', 'total_price'];

   
	
	public function productPrice() {
        return $this->belongsTo('App\productPrice','price_id');
    }
}
