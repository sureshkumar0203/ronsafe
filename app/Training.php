<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = ['training_title', 'training_price','training_icon','training_details'];
}
