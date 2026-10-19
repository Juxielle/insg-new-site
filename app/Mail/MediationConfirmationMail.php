<?php

namespace App\Mail;

use App\Models\MediationRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MediationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public MediationRequest $saisine
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmation de votre saisine — Médiation Financière CNEF Gabon ['.$this->saisine->reference.']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mediation-confirmation',
        );
    }
}
