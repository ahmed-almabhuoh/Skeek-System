<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendNotVerifyedUserEmail;
use App\Jobs\SendRememberSheekSysteNotitfacation;
use App\Jobs\SendToVerifyEmail;
use App\Models\Admin;
use Illuminate\Http\Request;

class UnCompleteEmailController extends Controller
{
    //
    public function sendUnVerifyedAdmin () {
    }

    public function sendOfferForAdmins () {
    }
}
