<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['banner_photo','cp_id'];
	
	public function cmsPageLink() {
        return $this->belongsTo('App\cmsContent','cp_id');
    }
}
