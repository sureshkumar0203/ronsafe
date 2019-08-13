<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;


use Helpers;
use View;
use App\Seo;
use App\Admin;
use App\SeoPageSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $seo_info  = Seo::first();
		$admin_dtls = Admin::first();
		$pr_info = Helpers::minMaxPriceRange();
		
		View::share(['seo_info'=>$seo_info,'admin_dtls'=>$admin_dtls,'pr_info'=>$pr_info]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
