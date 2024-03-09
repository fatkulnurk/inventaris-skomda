<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function account(Request $request)
    {
        return response()->json([
            'message' => 'Success get profile.',
            'data' => $request->user(),
        ]);
    }
}
