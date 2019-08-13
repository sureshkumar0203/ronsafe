<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillable = ['prd_cat_id','prd_name','prd_slug','prd_photo','prd_details','active_status','prd_cs_opt','prd_meta_title','prd_meta_keyword','prd_meta_description'];
	
	
	
	public function category() {
        return $this->belongsTo('App\Category','prd_cat_id');
    }
	
	public function productOptionalImages() {
        return $this->hasMany('App\ProductOptionalImage','prd_id');
    }
	
	public function productPrice() {
        return $this->hasMany('App\ProductPrice','prd_id');
    }
	
	/*public function size() {
        return $this->hasMany('App\Size','prd_id');
    }
	
	public function color() {
        return $this->hasMany('App\Color','prd_id');
    }*/
	
}
