<?php

namespace App\Http\Controllers\Super\Super;

use App\Http\Controllers\Controller;
use App\Models\Super;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteSuperController extends Controller
{
    //

    public function delete(Super $super)
    {

        // Check Ability
        $this->checkUserAbility('Delete-Super');

        if (auth('super')->user()->email == $super->email)
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed !',
                'text' => 'Failed to delete super',
            ], Response::HTTP_BAD_REQUEST);
        if ($super->delete()) {
            return response()->json([
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Super deleted successfully',
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'icon' => 'error',
                'title' => 'Failed !',
                'text' => 'Failed to delete super',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
