<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Logs\UserLogsController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
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

}
