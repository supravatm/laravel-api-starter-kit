<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class VerificationController extends Controller
{
    use ApiResponse;
    public function verify(Request $request)
        {
            $user = \App\Models\User::find($request->route('id'));
            if(!$user)
            {
                return $this->error('User not exits.', 400);
                
            }
            auth()->login($user);

            if (! hash_equals((string) $request->route('hash'), sha1($request->user()->getEmailForVerification()))) {
                return $this->error('The hashed do not match.', 400);
            }

            if ($request->user()->hasVerifiedEmail()) {
                return $this->success([],'Email already verified.', 200);
            }

            if ($request->user()->markEmailAsVerified()) {
                event(new \Illuminate\Auth\Events\Verified($request->user()));
            }
            return $this->success([], 'Email verified successfully', 200);
        }

        public function resend(Request $request)
        {
            if ($request->user()->hasVerifiedEmail()) {
                return $this->success([], 'Email already verified', 200);
            }

            $request->user()->sendEmailVerificationNotification();

            return $this->success([],'Verification email sent!', 200);
        }
}
