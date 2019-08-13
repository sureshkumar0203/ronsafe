<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRegistration extends Model
{
    protected $fillable = ['full_name','email','password','contact_no','address1','address2','city','post_code','state','country','active_status'];
}