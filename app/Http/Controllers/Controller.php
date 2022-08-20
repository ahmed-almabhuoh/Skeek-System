<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Logs\SuperLogsController;
use App\Http\Controllers\Logs\UserLogsController;
use App\Http\Controllers\Super\Super\Settings\FollowUpSuperController;
use App\Models\Super;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Jenssegers\Agent\Facades\Agent;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Logs
    // User
    public function storeUserLogs($action)
    {
        (new UserLogsController())->storeUserLog(request()->ip(), $action, Agent::device(), Agent::platform(), Agent::browser(), Agent::isDesktop(), Agent::isTablet(), Agent::isPhone(), Agent::isRobot(), Agent::version(Agent::browser()), Agent::version(Agent::platform()));
    }
    // End User
    // Super
    public function storeSuperLogs($action)
    {
        (new SuperLogsController())->insertSupeLogs(request()->ip(), $action, Agent::device(), Agent::platform(), Agent::browser(), Agent::isDesktop(), Agent::isTablet(), Agent::isPhone(), Agent::isRobot(), Agent::version(Agent::browser()), Agent::version(Agent::platform()));
    }
    // End Super
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
    public function checkSuperPolicyAZ($super_enc_id)
    {
        $super = Super::findOrFail(Crypt::decrypt($super_enc_id));
        if ($super->email == 'az54546@gmail.com' && auth('super')->user()->email != 'az54546@gmail.com')
            App::abort(403);
    }

    // Check Ability
    public function checkUserAbility($real_permission, $optional_permissions = [], $operator = '||')
    {
        $_is_access = true;
        if (Auth::user()->hasPermissionTo($real_permission)) {
            if (!empty($optional_permissions)) {
                foreach ($optional_permissions as $optional_permission) {
                    if ($operator == '||') {
                        $_is_access |= Auth::user()->hasPermissionTo($optional_permission);
                    } else if ($operator == '&&') {
                        $_is_access &= Auth::user()->hasPermissionTo($optional_permission);
                    }
                }
                return $_is_access ? true : App::abort(403);
            } else {
                return true;
            }
        } else {
            return App::abort(403);
        }
    }
}
