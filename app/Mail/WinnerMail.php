<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WinnerMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $winnerNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($winnerNumber)
    {
        $this->winnerNumber = $winnerNumber;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('winner')
            ->subject('¡Número Ganador!')
            ->with([
                'winnerNumber' => $this->winnerNumber,
            ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Winner Mail',
        );
    }
}
