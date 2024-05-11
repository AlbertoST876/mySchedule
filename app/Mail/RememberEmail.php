<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class RememberEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Event $event;

    /**
     * Create a new message instance.
     * 
     * @param Event $event
     * @return void
     */
    public function __construct(Event $event)
    {
        $this -> event = $event;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this -> event -> name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: "emails.remember",
            with: [
                "name" => $this -> event -> name,
                "description" => $this -> event -> description,
                "date" => $this -> event -> date,
            ],
        );
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
