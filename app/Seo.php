<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
	 //protected $table = 'seo';
	
     protected $fillable = [
        'meta_title', 'meta_keyword', 'meta_descr',
    ];
	
	
}
