<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApiTokenRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApiTokenController extends Controller
{
    public function createToken(ApiTokenRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'error'=>'user not found'
            ], 401);
        }
        $token = $user->createToken($request->name);
        return ['token' => $token->plainTextToken];
    }
}
