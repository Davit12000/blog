<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class BlogCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $blog;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $blog
    )
    {
        $this->user = $user;
        $this->blog = $blog;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('laravel@example.com', 'Example Exampleyan'),
            replyTo: [
                new Address('taylor@example.com', 'Example Exampleyan'),
            ],
            subject: 'Blog Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.BlogCreated',
            with: [
                'name' => $this->user->name,
                'title' => $this->blog->title,
                'description' =>$this->blog->description,
            ],);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
