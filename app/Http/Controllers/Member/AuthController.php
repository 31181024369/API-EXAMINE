<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Member;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials = $request->only(['username', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $tokenResult = $user->createToken('authToken')->plainTextToken;

                return response()->json([
                    'status_code' => 200,
                    'access_token' => $tokenResult,
                    'token_type' => 'Bearer'
                ]);
            } else {
                return response()->json([
                    'status_code' => 401,
                    'message' => 'Tài khoản hoặc mật khẩu không chính xác.'
                ], 401);
            }

        } catch (\Exception $error) {
            Log::error($error);
            return response()->json([
                'status_code' => 500,
                'message' => 'Lỗi đăng nhập.',
                'error' => $error->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'success']);
    }
}
