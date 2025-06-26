<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisiteNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $visiteur;
    public $locataire;

    
   public function __construct($visiteur, $locataire)
    {
        $this->visiteur = $visiteur;
        $this->locataire = $locataire;
    }


     public function build()
    {
        return $this->subject('Nouvelle demande de visite')
                    ->view('emails.visite_notification');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visite Notification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
