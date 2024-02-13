<?php

namespace App\Observers;

use App\Models\Application;
use Illuminate\Support\Facades\Mail;

class ApplicationObserver
{
    /**
     * Handle the Application "updating" event.
     *
     * @param  \App\Models\Application  $application
     * @return void
     */
    public function updating(Application $application)
    {
        // Check if is_approved is updated to 4 and user_id is 313
        if ($application->is_approved == 4 
            && $application->getOriginal('is_approved') == 0
            && $application->user_id == 313
        ) {
            // Send email when is_approved changes from 0 to 4 for user_id 313
            $recipientEmail = "jamesmwakalinga558@gmail.com";
            $subject = "Application Approved Notification";
            $message = "The application with ID {$application->id} has been approved for user_id 313.";

            Mail::to($recipientEmail)->send(new \App\Mail\ApplicationApprovedNotification($subject, $message));
        }
    }
}
