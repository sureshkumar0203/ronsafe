<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempCart extends Model
{
    protected $fillable = ['user_id', 'session_id','price_id','size','color','unit_price','qty', 'total_price'];
  
	public function productPrice() {
        return $this->belongsTo('App\productPrice','price_id');
    }
}
