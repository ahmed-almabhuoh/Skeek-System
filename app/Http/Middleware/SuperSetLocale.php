<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SuperSetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $lang_key = [
            'Arabic' => 'ar',
            'English' => 'en',
        ];

        $lang = 'en';
        if (auth('super')->check()) {
            $superSettings = auth('super')->user()->settings;

            if (!empty($superSettings)) {
                $lang = $lang_key[$superSettings->lang];
                App::setlocale($lang);
            }
        }
        return $next($request);
    }
}
