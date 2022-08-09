<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Logs\UserLogsController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Jenssegers\Agent\Facades\Agent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Logs
    public function storeUserLogs($action)
    {
        (new UserLogsController())->storeUserLog(request()->ip(), $action, Agent::device(), Agent::platform(), Agent::browser(), Agent::isDesktop(), Agent::isTablet(), Agent::isPhone(), Agent::isRobot(), Agent::version(Agent::browser()), Agent::version(Agent::platform()));
    }
    // -- Logs -- 

    // Generate A Random String Function
    public function generateNewPassword($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+/*-+}{:!@#$%^&*()_+/*-+}{:';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    // Check Policy For Super User az54546@gmail.com
    public function checkSuperPolicyAZ($super)
    {
        if ($super->email == 'az54546@gmail.com' && auth('super')->user()->email != '54546@gmail.com')
            App::abort(403);
    }
}
