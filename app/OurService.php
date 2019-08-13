<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurService extends Model
{
    protected $fillable = ['service_title', 'service_photo','service_details'];
}
