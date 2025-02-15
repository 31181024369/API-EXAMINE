<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Member;

class MemberController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:member',
                'password' => 'required|string',
                'email' => 'required|string|email|max:255|unique:member',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status_code' => 400,
                    'errors' => $validator->errors()
                ], 400);
            }

            $member = Member::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ]);

            return response()->json([
                'status_code' => 201,
                'message' => 'Tạo tài khoản thành công.'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Lỗi tạo tài khoản.'
            ], 500);
        }
    }
}
