<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UsersController extends Controller
{
    //
    public function attest(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, true)) {
            $token = $request->user()->createToken('token-name');

            $user = $request->user();
            logger()->debug($user);

            return response()->json(['api_token' => $token->plainTextToken], 200);
        }

        return response()->json(['message' => '認証に失敗しました。'], 401);
    }

    public function get(Request $request) {
        return response()->json($request->user(), 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return response()->json(['message' => 'ログアウトしました。'], 200);
    }
}
