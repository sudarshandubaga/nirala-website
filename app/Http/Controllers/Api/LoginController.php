<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function send_otp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric|regex:/\d{10}$/',
        ]);

        $otp = rand(100000, 999999);

        $user = User::firstOrNew(['mobile' => $request->mobile]);
        $user->otp = Hash::make($otp);
        $user->save();

        return response()->json([
            'msg'   => 'Success! OTP sent to mobile no. XXXXXX' . substr($request->mobile, -4),
            'otp'   => $otp
        ]);
    }

    // Verify OTP
    public function verify_otp(Request $request)
    {
        $request->validate([
            'mobile' => 'required|numeric|regex:/\d{10}$/',
            'otp' => 'required|numeric|regex:/\d{6}$/',
        ]);

        $user = User::where('mobile', $request->mobile)->firstOrFail();

        if (password_verify($request->otp, $user->otp)) {
            $user->api_token = \Str::random(160);
            $user->save();

            return response()->json([
                'msg' => 'Success! OTP verified.',
                'user'  => $user
            ]);
        } else {
            return response()->json([
                'msg'   => 'Failed! OTP is not matched.'
            ], 401);
        }
    }
}
