<?php
namespace App\Http\Middleware;
use Closure;
use DB;
use Session;

class checkUserLogin {
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
		if(Session::get('user_id') == ""){
			 return redirect('user-login');
		}else{
            return $next($request);
		}
    }
}
