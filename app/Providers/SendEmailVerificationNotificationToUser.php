<?php

namespace App\Providers;

use App\Providers\RegisteredUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailVerificationNotificationToUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Providers\RegisteredUser  $event
     * @return void
     */
    public function handle(RegisteredUser $event)
    {

        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {

            $data = array('name'=>"Virat Gandhi",'email' => 'fminja87@gmail.com');

            Mail::send(['text'=>'mail'], $data, function($message) use ($data) {
                $message->to($data['email'], 'Tutorials Point')->subject
                ('Please verify your email please');
                $message->from(env('MAIL_FROM_ADDRESS'),env('APP_NAME'));
                $message->setBody('Please verify your email please');
            });
//            $event->user->sendEmailVerificationNotification();
        }

    }
}
