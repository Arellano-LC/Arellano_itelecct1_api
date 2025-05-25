<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Userinfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        Log::info('Login attempt: ', $request->all());

        $user = Userinfo::where('username', $request->username)->first();

        if (!$user) {
            Log::info('User not found');
        } else {
            Log::info('User found: ' . $user->username);
            Log::info('Hash check result: ' . (Hash::check($request->password, $user->password) ? 'true' : 'false'));
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        return response()->json([
            'user' => $user,
            'message' => 'Login successful'
        ]);
    }
}
