<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainingBooking extends Model
{
    protected $fillable = ['user_id','training_id', 'training_price','full_name','contact_no','email','address1','address2','city','post_code','state','country','transaction_id'];
	
	
	public function training() {
        return $this->belongsTo('App\Training','training_id');
    }
}
