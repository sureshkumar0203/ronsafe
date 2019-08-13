<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOptionalImage extends Model
{
    protected $fillable = ['prd_id', 'opt_images'];
}
