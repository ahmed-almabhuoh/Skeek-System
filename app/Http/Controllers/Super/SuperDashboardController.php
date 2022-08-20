<?php

namespace App\Http\Controllers\Super;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperDashboardController extends Controller
{
    //
    public function showSuperDashboard()
    {
        // Store Logs
        $this->storeSuperLogs('Display Super Dashboard');
        
        return response()->view('back-end.supers.dashboard');
    }
}
