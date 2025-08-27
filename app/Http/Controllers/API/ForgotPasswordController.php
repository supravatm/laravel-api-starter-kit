<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    use ApiResponse;
    
    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLink(Request $request): JsonResponse
    {
        // 1. Validate the incoming request. We only need the email.
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Return a generic message to prevent revealing if an email exists
            return $this->success([], 'Password reset link sent (if email exists).', 200);
        }

        $token = Str::random(60);
        // Hash the token for secure storage in the database
        $hashedToken = Hash::make($token);
        DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => $hashedToken,
            'created_at' => Carbon::now()
        ]);
        return $this->success(['token' => $token], 'Password reset link successfully generated.', 200);

    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request): JsonResponse
    {
        // 1. Validate the incoming request. We only need the email.
        $request->validate(['email' => 'required|email']);

        // 2. Use the Password broker to send the reset link.
        // The `sendResetLink` method will handle sending the email.
        $response = Password::broker()->sendResetLink(
            $request->only('email')
        );
        // 3. Check the response from the broker.
        // The `Password::RESET_LINK_SENT` is a success constant.
        if ($response === Password::RESET_LINK_SENT) {
            return $this->success([], __($response), 201);
        }
        // 4. Handle any errors, typically if the email is not found.
        throw ValidationException::withMessages([
            'email' => [__($response)],
        ]);
    }
}
