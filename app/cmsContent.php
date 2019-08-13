<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cmsContent extends Model
{
    protected $fillable = ['page_title','cms_photo','content','meta_title','meta_keywords','meta_description','cms_photo'];
}
