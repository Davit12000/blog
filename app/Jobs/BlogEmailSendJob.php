<?php

namespace App\Jobs;

use App\Mail\BlogCreatedEmail;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BlogEmailSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     */

    /**
     * Create a new message instance.
     * getting datas here.
     */
    protected $user;
    protected $blog;

    public function __construct($user, $blog)
    {
        $this->user = $user;
        $this->blog = $blog;
    }

    /**
     * Execute the job.
     * Sending email message.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)->send(new BlogCreatedEmail($this->user, $this->blog));
    }
}
