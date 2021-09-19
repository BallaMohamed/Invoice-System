<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
     
        if(config('locale.status'))
        {
           
              if(Session::has('locale') && array_key_exists(Session::get('locale'), config('locale.languages'))){
                    App::setlocale(Session::get('locale'));
              }else{
                  $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                  foreach ($userLanguages as $langauge) {
                      if (array_key_exists($langauge, config('locale.languages'))) {
                          App::setlocale($langauge) ;
                          setlocale(LC_TIME, config('locale.languages')[$langauge][2]);
                          Carbon::setlocale(config('locale.languages')[$langauge][0]);
                          if(config('locale.languages')[$langauge][2]){
                            \session(['lang-rtl' => true]);
                          }else{
                            Session::forget('lang-rtl');
                          }

                          break;

                      }
                  }
              }
        }

 
        return $next($request);
    }
}
