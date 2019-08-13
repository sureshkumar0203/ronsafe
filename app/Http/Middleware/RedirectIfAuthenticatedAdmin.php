<?php
namespace App\Http\Middleware;
use Closure;
use DB;
use Session;

class RedirectIfAuthenticatedAdmin {
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
		if(Session::get('admin_id') != ""){
			 return redirect('administrator/dashboard');
		}else{
            return $next($request);
		}
    }
}
