<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
       'admin_name', 'email', 'alt_email', 'password', 'active_status','contact_no','mobile_no','address','facebook_url','twitter_url','instagram_url',
    ];
}
