<?php

namespace App\Mail;

use App\Models\Member;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MemberApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Member $member
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat! Pendaftaran APPTASI Anda Disetujui',
        );
    }

    public function content(): Content
    {
        return new Content(
            html: 'emails.member_approved',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('members.card_pdf', ['member' => $this->member])
            ->setPaper('A4');

        $filename = 'Kartu_Anggota_' . str_replace(' ', '_', $this->member->nama_lengkap) . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
