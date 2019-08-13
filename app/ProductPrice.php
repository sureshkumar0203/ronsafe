<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
	protected $fillable = ['prd_id', 'size_id', 'color_id', 'prd_price'];
	
	public function product() {
        return $this->belongsTo('App\Product','prd_id');
    }
	
	public function size() {
        return $this->belongsTo('App\Size','size_id');
    }
	public function color() {
        return $this->belongsTo('App\Color','color_id');
    }
}
