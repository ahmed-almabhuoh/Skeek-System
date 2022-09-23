<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AdminSetLocale
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
        if (auth('admin')->check()) {
            $adminSettings = auth('admin')->user()->settings;

            if (!empty($adminSettings)) {
                $lang = $lang_key[$adminSettings->lang];
                App::setlocale($lang);
            }
        }
        return $next($request);
    }
}
