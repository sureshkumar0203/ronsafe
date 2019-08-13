<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterOrder extends Model
{
    protected $fillable = ['user_id', 'full_name', 'email', 'contact_no', 'address1', 'address2', 'city', 'post_code', 'state', 'country', 'total_amount', 'shipping_amount', 'grand_total', 'transaction_id', 'payment_status', 'order_status', 'order_notes', 'ship_date', 'shipping_url', 'tracking_id'];
}
