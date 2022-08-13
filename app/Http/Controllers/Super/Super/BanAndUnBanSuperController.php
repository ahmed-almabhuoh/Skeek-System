<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Models\Super;
use Illuminate\Http\Request;

class BanAndUnBanSuperController extends Controller
{
    //

    public function banAndUnBanSuper($super_id)
    {
        $super = Super::findOrFail($super_id);

        $super->active = !$super->active;
        $isSaved = $super->save();

        if ($isSaved) {
            return redirect()->route('super.super_index')->with([
                'status' => 'Changes updated successfully',
                'code' => 200,
            ]);
        } else {
            return redirect()->route('super.super_index')->with([
                'status' => 'Failed to updated changes, re-try again please.',
                'code' => 500,
            ]);
        }
    }
}
