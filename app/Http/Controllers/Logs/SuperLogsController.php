<?php

namespace App\Http\Controllers\Logs;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperLogsController extends Controller
{
    // Store Super Logs
    public function insertSupeLogs($ip, $action, $device = null, $os = null, $browser = null, $isDesktop = false, $isTablet = false, $isPhone = false, $isRobot = false, $browser_version = null, $platform_version = null)
    {
        DB::table('super_logs')->insert([
            'ip' => $ip,
            'action' => $action,
            'device' => $device,
            'os' => $os,
            'browser' => $browser,
            'isDesktop' => $isDesktop,
            'isTablet' => $isTablet,
            'isPhone' => $isPhone,
            'isRobot' => $isRobot,
            'browser_version' => $browser_version,
            'platform_version' => $platform_version,
            'created_at' => Carbon::now()->toDateTimeString(),
            'super_id' => auth('super')->user()->id,
        ]);
    }
}
