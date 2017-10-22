<?php

namespace App\Listeners;

use App\Events\RegisteredFromLandingPage;
use App\Mail\YourPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendUserPassword
{
    /**
     * Handle the event.
     *
     * @param  RegisteredFromLandingPage  $event
     * @return void
     */
    public function handle(RegisteredFromLandingPage $event)
    {
        Mail::to($event->user)->send(new YourPassword($event->password));
    }
}
