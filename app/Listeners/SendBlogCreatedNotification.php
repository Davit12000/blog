<?php

namespace App\Listeners;

use App\Events\BlogCreated;
use App\Jobs\BlogEmailSendJob;
use App\Mail\BlogCreatedEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBlogCreatedNotification
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {

    }

    /** 
     * Handle the event.
     * Creating a job,
     * wich schould send an email message
     */
    public function handle(BlogCreated $event): void
    {
        dispatch(new BlogEmailSendJob($event->user, $event->blog));
    }
}
