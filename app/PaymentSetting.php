<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
        protected $fillable = ['paypal_environment','paypal_email','shipping_cost'];

}
