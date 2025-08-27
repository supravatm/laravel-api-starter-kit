<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Mail\WelcomeEmail;

class SendConfirmationEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Verified $event): void
    {
        //
        $user = $event->user;
        
        if ($event->user instanceof MustVerifyEmail && $event->user->hasVerifiedEmail()) {
            Mail::to($user->email)->send(new WelcomeEmail($user->name));
        }
    }
}
