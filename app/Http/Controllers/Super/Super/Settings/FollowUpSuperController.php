<?php

namespace App\Http\Controllers\Super\Super\Settings;

use App\Http\Controllers\Controller;
use App\Models\Super;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class FollowUpSuperController extends Controller
{
    //

    public function showSuperUserAction($id)
    {
        $super = Super::findOrFail(Crypt::decrypt($id));
        $super_logs = DB::table('super_logs')->where('super_id', $super->id)->latest()->get();
        return response()->view('back-end.supers.supers.follow-up', [
            'super' => $super,
            'super_logs' => $super_logs,
        ]);
    }
}
