<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    use ApiResponse;
    public function resetPassword(Request $request, string $token): JsonResponse
    {
        // 1. Validate the incoming request data.
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        // 2. Find the token in the password_resets table.
        // It's crucial to use the provided email to narrow the search.
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        // 3. Check for the token's validity.
        // We use Hash::check to compare the unhashed token from the URL
        // with the hashed token stored in the database.
        if (!$passwordReset || !Hash::check($token, $passwordReset->token)) {
            return $this->error('This password reset token is invalid.', 422);
        }

        // 4. Find the user and update their password.
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return $this->error('User not found.', 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // 5. Delete the used token to prevent it from being used again.
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return $this->success([], 'Password has been successfully reset.', 200 );
    }
}
